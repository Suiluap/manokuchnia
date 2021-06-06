<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::latest()->with(['ingredients', 'steps', 'comments'])->paginate(9);
        return view('recipes.list', [
            'recipes' => $recipes
        ]);
    }

    public function categoryIndex(Category $category)
    {
        $recipes = $category->recipes()->latest()->with(['ingredients', 'steps', 'comments'])->paginate(9);
        return view('recipes.list', [
            'recipes' => $recipes,
            'category' => $category->name
        ]);
    }

    public function userRecipesIndex()
    {
        $recipes = Auth::user()->recipes()->latest()->with(['ingredients', 'steps', 'comments'])->paginate(9);
        return view('recipes.list', [
            'recipes' => $recipes,
            'isUserList' => true
        ]);
    }

    public function recipeIndex(Recipe $recipe)
    {
        $comments = $recipe->comments()->latest()->paginate(5);
        return view('recipes.view', [
            'recipe' => $recipe,
            'comments' => $comments
        ]);
    }

    public function newRecipeIndex(){
        return view('recipes.new');
    }

    public function editRecipeIndex(Recipe $recipe)
    {
        if ($recipe->ownedBy(Auth::user()) || Auth::user()->isAdmin()){
            return view('recipes.edit', [
                'recipe' => $recipe
            ]);
        }
        else{
            abort(403);
        }
    }

    //Ar tikrai gerai veikia nuotraukos validacija?
    public function newRecipe(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'required|image|max:2048',
            'description' => 'required|max:9999',
            'portions' => 'required|integer|between:1,999',
            'category' => 'required|exists:categories,id',
            'ingredient' => 'required|array|between:1,99',
            'quantity' => 'required|array|between:1,99',
            'measurement' => 'required|array|between:1,99',
            'step' => 'required|array|between:1,99',
            'ingredient.*' => 'required|max:255',
            'quantity.*' => 'required|numeric|between:0,9999.9999',
            'measurement.*' => 'required|max:255',
            'step.*' => 'required',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/pictures/'.Auth::id(), $imageName);

        $recipeId = Recipe::create([
            'name' => $request->name,
            'image' => $imageName,
            'description' => $request->description,
            'portions' => $request->portions,
            'category_id' => $request->category,
            'user_id' => Auth::id()
        ])->id;

        for ($i = 0; $i < count($request->ingredient); $i++){
            Ingredient::create([
                'name' => $request->ingredient[$i],
                'quantity' => $request->quantity[$i],
                'measurement' => $request->measurement[$i],
                'recipe_id' => $recipeId
            ]);
        }

        for ($i = 0; $i < count($request->step); $i++){
            Step::create([
                'instructions' => $request->step[$i],
                'recipe_id' => $recipeId
            ]);
        }

        return redirect()->route('index')->with('status','Receptas įkeltas sėkmingai!');
    }

    public function editRecipe(Request $request, Recipe $recipe)
    {
        if ($recipe->ownedBy(Auth::user()) || Auth::user()->isAdmin()){
            $this->validate($request, [
                'name' => 'required|max:255',
                'image' => 'image|max:2048',
                'description' => 'required|max:9999',
                'portions' => 'required|integer|between:1,999',
                'category' => 'required|exists:categories,id',
                'ingredient' => 'required|array|between:1,99',
                'quantity' => 'required|array|between:1,99',
                'measurement' => 'required|array|between:1,99',
                'step' => 'required|array|between:1,99',
                'ingredient.*' => 'required|max:255',
                'quantity.*' => 'required|numeric|between:0,9999.9999',
                'measurement.*' => 'required|max:255',
                'step.*' => 'required',
            ]);

            if($request->image != null) {
                $request->image->storeAs('public/pictures/'.Auth::id(), $recipe->image);
            };

            $recipe->update([
                'name' => $request->name,
                'description' => $request->description,
                'portions' => $request->portions,
                'category_id' => $request->category
            ]);

            Ingredient::where('recipe_id', $recipe->id)->delete();
            Step::where('recipe_id', $recipe->id)->delete();

            for ($i = 0; $i < count($request->ingredient); $i++){
                Ingredient::create([
                    'name' => $request->ingredient[$i],
                    'quantity' => $request->quantity[$i],
                    'measurement' => $request->measurement[$i],
                    'recipe_id' => $recipe->id
                ]);
            }

            for ($i = 0; $i < count($request->step); $i++){
                Step::create([
                    'instructions' => $request->step[$i],
                    'recipe_id' => $recipe->id
                ]);
            }

            return redirect()->route('recipe', $recipe)->with('status','Receptas atnaujintas sėkmingai!');
        }
        else{
            abort(403);
        }
    }

    public function deleteRecipe(Recipe $recipe)
    {
        //Vietoj šito patikrinimo reikėtų naudoti policy.
        if ($recipe->ownedBy(Auth::user()) || Auth::user()->isAdmin()){
            $imagePath = storage_path("app\public\pictures\\".$recipe->user_id."\\".$recipe->image);
            File::delete($imagePath);

            //dėl cascade taisyklių, išsitrina ir ingredientai bei žingniai
            $recipe->delete();

            return redirect()->route('index')->with('status','Receptas pašalintas sėkmingai!');
        }
        else{
            abort(403);
        }
    }

    public function comment(Recipe $recipe, Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|max:999'
        ]);

        Comment::create([
            'text' => $request->comment,
            'user_id' => Auth::user()->id,
            'recipe_id' => $recipe->id
        ]);

        return back()->with('status', 'Komentaras įrašytas sėkmingai!');
    }

    public function deleteComment(Comment $comment)
    {
        //Vietoj šito patikrinimo reikėtų naudoti policy.
        if ($comment->ownedBy(Auth::user()) || Auth::user()->isAdmin()){

            $comment->delete();

            return back()->with('status','Komentaras pašalintas sėkmingai!');
        }
        else{
            abort(403);
        }
    }
}
