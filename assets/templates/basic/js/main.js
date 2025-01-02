(function ($) {
  "use strict";

  // ============== Header Hide Click On Body Js Start ========
  $(".header-button").on("click", function () {
    $(".body-overlay").toggleClass("show");
  });
  $(".body-overlay").on("click", function () {
    $(".header-button").trigger("click");
    $(this).removeClass("show");
  });
  // =============== Header Hide Click On Body Js End =========

  // ==========================================
  //      Start Document Ready function
  // ==========================================
  $(document).ready(function () {
    // ========================== Header Hide Scroll Bar Js Start =====================
    $(".navbar-toggler.header-button").on("click", function () {
      $("body").toggleClass("scroll-hide-sm");
      $(".header").toggleClass("bg--black");
    });
    $(".body-overlay").on("click", function () {
      $("body").removeClass("scroll-hide-sm");
      $(".header").removeClass("bg--black");
    });
    // ========================== Header Hide Scroll Bar Js End =====================

    // ========================== Add Attribute For Bg Image Js Start =====================
    $(".bg-img").css("background", function () {
      var bg = "url(" + $(this).data("background-image") + ")";
      return bg;
    });
    // ========================== Add Attribute For Bg Image Js End =====================

    // ================== Password Show Hide Js Start ==========
    $(".toggle-password").on("click", function () {
      $(this).toggleClass(" fa-eye-slash");
      var input = $($(this).attr("id"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    // =============== Password Show Hide Js End =================
    $('.custom--dropdown > .custom--dropdown__selected').on('click', function () {
      $(this).parent().toggleClass('open');
    });

    $('.custom--dropdown > .dropdown-list > .dropdown-list__item').on('click', function () {
      $('.custom--dropdown > .dropdown-list > .dropdown-list__item').removeClass('selected');
      $(this).addClass('selected').parent().parent().removeClass('open').children('.custom--dropdown__selected').html($(this).html());
    });

    $(document).on('keyup', function (evt) {
      if ((evt.keyCode || evt.which) === 27) {
        $('.custom--dropdown').removeClass('open');
      }
    });

    $(document).on('click', function (evt) {
      if ($(evt.target).closest(".custom--dropdown > .custom--dropdown__selected").length === 0) {
        $('.custom--dropdown').removeClass('open');
      }
    });

  });
  // ==========================================
  //      End Document Ready function
  // ==========================================

  // ========================= Preloader Js Start =====================
  $(window).on("load", function () {
    $(".preloader").fadeOut();
  });
  // ========================= Preloader Js End=====================

  // ========================= Header Sticky Js Start ==============
  $(window).on("scroll", function () {
    if ($(window).scrollTop() >= 300) {
      $(".header").addClass("fixed-header");
    } else {
      $(".header").removeClass("fixed-header");
    }
  });
  // ========================= Header Sticky Js End===================

  //============================ Scroll To Top Icon Js Start =========
  var btn = $(".scroll-top");

  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });

  btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "300");
  });
  //========================= Scroll To Top Icon Js End ======================

  let elements = document.querySelectorAll("[s-break]");
  Array.from(elements).forEach((element) => {
    let html = element.innerHTML;
    if (typeof html != "string") {
      return false;
    }
    let breakLength = parseInt(element.getAttribute("s-break"));
    html = html.split(" ");
    var colorText = [];
    if (breakLength < 0) {
      colorText = html.slice(breakLength);
    } else {
      colorText = html.slice(0, breakLength);
    }
    let solidText = [];
    html.filter((ele) => {
      if (!colorText.includes(ele)) {
        solidText.push(ele);
      }
    });
    var color = element.getAttribute("s-color") || "text--gradient";
    colorText = `<span class="${color}">${colorText
      .toString()
      .replaceAll(",", " ")}</span>`;
    solidText = solidText.toString().replaceAll(",", " ");
    breakLength < 0
      ? (element.innerHTML = `${solidText} ${colorText}`)
      : (element.innerHTML = `${colorText} ${solidText}`);
  });


})(jQuery);
