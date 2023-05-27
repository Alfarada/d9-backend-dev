// (($) => {
//   'use strict';
//   $(document).ready(() => {
//     $(".fadeout").delay(200).fadeOut(300);
//     $(".paragraph_1").css("color", "red");
//   });
//
//   // vs vanilla
//   let d = document;
//   d.addEventListener('DOMContentLoaded', (e) => {
//     d.querySelector('.paragraph_2').style.setProperty('color', 'blue');
//   });
// })(jQuery);

(function ($) {
  $.fn.myAjaxCallbackCustom = function (argument) {
    console.log('myAjaxCallback is called.');
    $('input#edit-output').attr('value', argument);
  }
})(jQuery);

