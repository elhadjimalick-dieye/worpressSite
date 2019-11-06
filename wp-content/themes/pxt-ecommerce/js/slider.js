jQuery(function($){

  if($('.ht-sticky-header').length > 0){
    $(window).scroll(function(){
      if($(window).scrollTop() > 200 ){
        $('#ht-masthead').addClass('ht-sticky');
      }else{
        $('#ht-masthead').removeClass('ht-sticky');
      }
    });
  }

  if($('#ht-bx-slider .ht-slide').length > 0){
    $('#ht-bx-slider').bxSlider({
        'pager':false,
        'auto' : true,
        'mode' : 'fade',
        'pause' : 5000,
    });
  }
} 