var products = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.whitespace,
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
            wildcard: '%QUERY',
            url: 'http://ishop2.loc/search/typeahead?query=%QUERY'
      }
});

products.initialize();

$("#typeahead").typeahead({
      // hint: false,
      highlight: true
},{
      name: 'products',
      display: 'title',
      limit: 9,
      source: products
});

$('#typeahead').bind('typeahead:select', function(ev, suggestion) {

      // console.log(suggestion);
      window.location = '/search/?s=' + encodeURIComponent(suggestion.title);
});



function showCart(cart){

      $(".modal-body").html(cart);
      $('#cart').modal();
      if ("<h3>Корзина пуста</h3>" == $.trim(cart)){
            $(".btn-primary").css("display","none");
            $(".btn-danger").css("display","none");
            $(".simpleCart_total").html("Cart is empty")
      }else{
            $(".btn-primary").css("display","inline-block");
            $(".btn-danger").css("display","inline-block");
            var data = $("#cart-sum-my").text();
            $(".simpleCart_total").html(data);
      }
      // $(simpleCart_total).html


};

function getCart(){

      $.ajax({
            type: 'GET',
            url: '/cart/show',
            success: function(resp) {
                  showCart(resp);
            },
            error: function() {
                  console.log("Product not exist");
            }
      })
}

$('#clearSession').on('click',function () {

      $.ajax({
            type: 'GET',
            url: '/cart/clear',
            success: function(resp) {
                  showCart(resp);
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
            quantity: 1 ,
            mod: 0
      };

      $.ajax({
            type: 'GET',
            url: '/cart/add',
            data: {mod:data},
            success: function(resp) {
                  showCart(resp);
            },
            error: function() {
                  console.log('product not exist');
            }
      })
})

$('body').on('click',"#productAdd",function (e) {
      e.preventDefault();
      var data = {
            id: this.dataset.id,
            quantity: $(".quantity input")[0].value ,
            mod:  $('.available select').find("option").filter(":selected").length ?
                $('.available select').find("option").filter(":selected")[0].value : 0
      };


      $.ajax({
            type: 'GET',
            url: '/cart/add',
            data: {mod:data},
            success: function(resp) {
                  showCart(resp);
            },
            error: function() {
                  console.log("product not exist");
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

$("#cart").on('click','.del-item', function (e) {
      var data = $(e.target).data('id');
      e.preventDefault();
      $.ajax({
            type: 'GET',
            url: '/cart/delete',
            data: {deleteFromCart:data},
            success: function(resp) {
                  // console.dir(resp);
                  showCart(resp);
            },
            error: function() {
                  console.log("Product not exist");
            }
      })
})
$(".cart-order").on('click','.del-item', function (e) {
      var data = $(e.target).data('id');
      e.preventDefault();
      $.ajax({
            type: 'GET',
            url: '/cart/delete',
            data: {deleteFromCart:data},
            success: function(resp) {
                  $(".table-responsive").html(resp);



                  if(resp.trim() == "<h3>Корзина пуста</h3>"){
                        console.log('resp');
                        $(".cart-note").remove();
                  }

            },
            error: function() {
                  console.log("Product not exist");
            }
      })
})

$("body").on('change', '.w_sidebar input', function (e) {

      let arrCheckedInput  = $('.w_sidebar input:checked');
      let data = '';
      arrCheckedInput.each(function () {
            data += this.value + ",";
      });

      if(data){
            $.ajax({
                  type: 'GET',
                  url: location.href,
                  data: {filter:data},
                  beforeSend:function(){
                        $(".preloader").fadeIn(300,function () {
                              $('.product-one').hide();

                        });
                  },
                  success: function(resp) {
                        $(".preloader").fadeOut(500,function () {
                              history.pushState(resp,1);
                              $('.product-one').html(resp).fadeIn();
                              let str = location.search.replace(/f(.+?)($|&)/g,'');
                              console.log(str);
                        });
                  },
                  error: function() {
                        console.log("Product not exist");
                  }
            });


      }else {

            window.location =  window.location.pathname;
      }
})














