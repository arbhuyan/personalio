/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function($) {

  // Create the dropdown base
  $("<select />").appendTo(".main-navigation");

  // Create default option "Menu"
  $("<option />", {
	 "selected": "selected",
	 "value"   : "#",
	 "text"    : "Menu"
  }).appendTo(".main-navigation select");

  // Populate dropdown with menu items
  $(".main-navigation a").each(function() {
   var el = $(this);
   $("<option />", {
	   "value"   : el.attr("href"),
	   "text"    : el.text()
   }).appendTo(".main-navigation select");
  });

   // To make dropdown actually work
   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
  $(".main-navigation select").change(function() {
	window.location = $(this).find("option:selected").val();
  });
})(jQuery);