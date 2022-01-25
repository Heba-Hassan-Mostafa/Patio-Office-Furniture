$(document).ready(function () {
    initQuantity();
    function initQuantity() {
        // Handle product quantity input
        if ($('.product_quantity').length) {
            var input = $('#quantity_input');
            var incButton = $('#quantity_inc_button');
            var decButton = $('#quantity_dec_button');

            var originalVal;
            var endVal;

            incButton.on('click', function () {
                originalVal = input.val();
                endVal = parseFloat(originalVal) + 1;
                input.val(endVal);
            });

            decButton.on('click', function () {
                originalVal = input.val();
                if (originalVal > 1) {
                    endVal = parseFloat(originalVal) - 1;
                    input.val(endVal);
                }
            });
        }
    }


    // like icon in modal

    $(".like-modal i").click(function(){
		$(this).toggleClass("like");
	})

})