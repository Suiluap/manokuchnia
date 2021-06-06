function add (type) {
   if(type == 'ingredient'){
        var html = '';
        html += '<div id="inputFormRow" class="input-group mb-1">';
        html += '<label for="ingredient" class="sr-only">Ingredientas</label>';
        html += '<input id="ingredient" name="ingredient[]" type="text" class="form-control rounded-left" placeholder="Ingredientas">';
        html += '<label for="quantity" class="sr-only">Kiekis</label>';
        html += '<input id="quantity" name="quantity[]" type="text" class="form-control" placeholder="Kiekis">';
        html += '<label for="measurement" class="sr-only">Matavimo vienetas</label>';
        html += '<input id="measurement" name="measurement[]" type="text" class="form-control" placeholder="Matavimo vienetas">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
        html += '</div>';
        html += '</div>';

        $('#newIgredients').append(html);
   }
   if (type == 'step'){
        var html = '';
        html += '<div id="inputFormRow" class="input-group mb-1">';
        html += '<label for="step" class="sr-only">Žingsnis</label>';
        html += '<input id="step" name="step[]" type="text" class="form-control rounded-left" placeholder="Žingsnis">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
        html += '</div>';
        html += '</div>';

        $('#newSteps').append(html);
   }
};

function remove (document) {
    $(document).closest('#inputFormRow').remove();
};

function calculateIngredients(){

    var previousValue = parseFloat($("#oldPortions").val());
    var newValue = parseFloat($(event.target).val());
    if (previousValue >= 1 && newValue >= 1 && previousValue <= 99 && newValue <= 99) {
        $('.ingredient').each(function(index, elem) {
            var ingredientNow = $('.quantity', elem);
            var oldIngredientQuantity = ingredientNow.text();
            var newIngredientQuantity = oldIngredientQuantity * newValue / previousValue;
            ingredientNow.text(Math.round(newIngredientQuantity*100)/100);
        });
        $('#oldPortions').val(newValue);
    }
}
