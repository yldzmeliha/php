'use strict';



$.validator.addMethod(
  'letterswithbasicpunc',
  function (value, element) {
    return this.optional(element) || /^[a-zäöüß\-.,()'"\s]+$/i.test(value);
  },
  'Nur Buchstaben und Interpunktion erlaubt! addMethod'
);

var settings = {
  /* default Werte müssen nicht angegeben werden. Die Eigenschaft einfach nicht notieren! */
  // debug: true, // default: false
  // errorElement: 'label', // default: 'label'
  errorClass: 'error_required', // default: 'error'
  // validClass: 'valid', // default : valid
  normalizer: function (value) {
    return $.trim(value);
  },

  errorPlacement: function ($errorElement, $element) {
    // default:  $element.after($errorElement);
    if ($element.prop('type') === 'radio' ) {
      $element.parent().prev().after($errorElement);
    } else {
      $element.before($errorElement);
    }
  } /* Positionierung der errorClass und validClass am Feld ändern.  */,
  highlight: function (element, errorClass, validClass) {
    $(element).addClass(errorClass).removeClass(validClass); //=> default
    /* css dient nur als Beispiel. Hier sollte besser ein zusätzliche Klasse verwendet werden. $(element).after().addClass('error') */
    $(element).after().css('border', '2px solid red');
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).addClass(validClass).removeClass(errorClass); //=> default
    /* css dient nur als Beispiel. Hier sollte besser ein zusätzliche Klasse verwendet werden. $(element).after().addClass('error') */
    $(element).after().css('border', '');
  },
  rules: {
    vorname: {
      // required: true // durch HTML required überflüssig
      pattern: /^[a-zäöüß\-.,()'"\s]+$/i, // additional-methods
    },
    nachname: {
      letterswithbasicpunc: true,
    },
    message: {
      minlength: 2,
      maxlength: 10,
    },
  },
  messages: {
    vorname: {
      pattern: 'Nur Buchstaben und Interpunktion erlaubt.',
    },
  },
};

$(function ($) {

  if (!$form.checkValidity || $form.checkValidity()) {
    //     /* submit the form */
   $('form').eq(0).validate(settings);
}
  // $('form').eq(0).validate(settings);
   
});

