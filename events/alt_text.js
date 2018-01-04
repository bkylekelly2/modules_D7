$( document ).ready(function() {
 
	(function ($) {

/**
 * Custom behavior to generate image style derivatives on S3 when an image is
 * inserted into the WYSWIYG editor.
 */
Drupal.behaviors.generateDerivative = {
  attach: function(context, settings) {
    $(document).bind('insertIntoActiveEditor', function(event, data) {
      var test = 'a';
		alert("kyle");
    })
  }
}
})(jQuery);
	
});