/**
* @requires jQuery
*/

Event.addBehavior({
  '.groupon_form': function() {
    $(this).validate({
      invalidHandler: function(form, validator) {
        $(this).addClass('invalid-form');
      },
      messages: {
        'subscription[zipcode]': 'Please enter a valid zip code.',
        'subscription[email_address]': 'Please enter a valid email address.'
      },
      ignoreTitle: true
    });

    $(this).bind('invalid-form', function(e) {
      $('.prevent_double-clicking').removeClass('prevent_double-clicking');
    });
  }
});
