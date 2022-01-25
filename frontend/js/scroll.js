$(document).ready(function () {
  // scrollUp
  $(window).scroll(function () {
    var scrollup = $(".scrollup");
    if ($(window).scrollTop() > 700) {
      scrollup.fadeIn();
    } else {
      scrollup.fadeOut();
    }
  });

  $(".scrollup").on("click", function (e) {
    e.preventDefault();
    $("html , body").animate(
      {
        scrollTop: 0,
      },
      1000
    );
  });

  // function for limited text
  $(function(){
      $(".count-limit").keyup(function(){
          $(".counting").text($(this).val().length);
          let x = $(this).val().length;
          if( x >= 260){
              $(this).css("border","1px solid red");
              $(".error-msg").show();
          }else{
            $(".error-msg").hide();
            $(this).css("border","none");
          }
      })
  })
});
