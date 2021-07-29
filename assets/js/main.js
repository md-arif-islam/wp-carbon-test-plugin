;(function ($) {
   $('.accordion-container .body').hide();
   $('.accordion-container .body').first().show();
   $('.accordion-container .title').on('click',function () {
       //$('.accordion-container .body').hide();
       $(this).parent('.accordion-container').find('.body').hide();
       $(this).next('.body').show();
   })

})(jQuery);