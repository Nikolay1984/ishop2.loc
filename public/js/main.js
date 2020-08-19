$('#clearSession').on('click',function () {

      $.ajax({
            type: 'GET',
            url: '/cart/clear',
            success: function(resp) {
                  console.dir("OK clear");
            },
            error: function() {
                  console.log("false clear");
            }
      })
})

$('body').on('click',".add-to-cart-link",function (e) {

      e.preventDefault();
      var data = {
            id: this.dataset.id,
            quantity: $(".quantity input")[0] ? $(".quantity input")[0].value:1 ,
            mod: $('.available select').find("option").filter(":selected")[0]
                ? $('.available select').find("option").filter(":selected")[0].value : 0
      };
      $.ajax({
            type: 'GET',
            url: '/cart/add',
            data: {mod:data},
            success: function(resp) {
                  console.dir(resp);
            },
            error: function() {
                  console.log("Product not exist");
            }
      })
})


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
