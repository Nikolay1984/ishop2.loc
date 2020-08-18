
$('#currency').change(function () {

      window.location ="currency/change?curr=" + $(this).val();
});

$('.available select').on('change', function () {
      var outputPrice = $("#base-price");

      var price = $(this).find("option").filter(":selected").data('price') ;
      var basePrice = outputPrice.data("base");


      if(price){
            outputPrice.text(symbolLeft + price + symbolRight);
      }else{
            outputPrice.text(symbolLeft + basePrice + symbolRight);

      }


})
