$(document).ready(function() {
  
  // On click hide and show.
  $("#register").click(function() {
    $(".form-view__login").slideUp('slow', function() {
      $(".form-view__register").slideDown('slow');
    });
  });

  // On click hide and show.
  $("#login").click(function() {
    $(".form-view__register").slideUp('slow', function() {
      $(".form-view__login").slideDown('slow');
    });
  });

});