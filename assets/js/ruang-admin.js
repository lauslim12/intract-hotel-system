(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict

// Modal Javascript

$(document).ready(function () {
  $("#myBtn").click(function () {
    $('.modal').modal('show');
  });

  $("#modalLong").click(function () {
    $('.modal').modal('show');
  });

  $("#modalScroll").click(function () {
    $('.modal').modal('show');
  });

  $('#modalCenter').click(function () {
    $('.modal').modal('show');
  });

  // Added JavaScript
  function replaceFakePath(fileName) {
    return fileName.replace(/C:\\fakepath\\/i, '');
  }

  $("#deleteNicholas").click(function() {
    alert("You cannot delete Nicholas Dwiarto from this website.");
  });

  $('#hotel_thumbnail, #hotel_headline_1, #hotel_headline_2, #hotel_headline_3').change(function() {
    let fileName = replaceFakePath($(this).val());
    $(this).next('.custom-file-label').html(fileName);
  });

  $('.exampleModalEdit').on('show.bs.modal', function(e) {
    let hotel_id = $(e.relatedTarget).data('hotel_id');
    let room_id = $(e.relatedTarget).data('room_id');
    let room_name = $(e.relatedTarget).data('room_name');
    let room_count = $(e.relatedTarget).data('room_count');
    let price = $(e.relatedTarget).data('price');
    room_name = room_name.replace(/_/g, ' ');

    $(e.currentTarget).find('input[name="hotel_id"]').val(hotel_id);
    $(e.currentTarget).find('input[name="room_id"]').val(room_id);
    $(e.currentTarget).find('input[name="room_name"]').val(room_name);
    $(e.currentTarget).find('input[name="room_count"]').val(room_count);
    $(e.currentTarget).find('input[name="room_price"]').val(price);
  });

  $('#modalDeleteRoom').on('show.bs.modal', function(e) {
    let room_id = $(e.relatedTarget).data('room_id');
    $(e.currentTarget).find('input[name="room_id"]').val(room_id);
  });

  $('#modalNewRoom').on('show.bs.modal', function(e) {
    let hotel_id = $(e.relatedTarget).data('room_id');
    $(e.currentTarget).find('input[name="hotel_id"]').val(hotel_id);
  });

  $('#modalDeleteUser').on('show.bs.modal', function(e) {
    let user_id = $(e.relatedTarget).data('user_id');
    $(e.currentTarget).find('input[name="user_id"]').val(user_id);
  })

  $('.modal').on('show.bs.modal', function(e) {
    let hotel_id = $(e.relatedTarget).data('hotel_id');
    $(e.currentTarget).find('input[name="hotel_id"]').val(hotel_id);
  });
  // End of added JavaScript

});

// Popover Javascript

$(function () {
  $('[data-toggle="popover"]').popover()
});
$('.popover-dismiss').popover({
  trigger: 'focus'
});