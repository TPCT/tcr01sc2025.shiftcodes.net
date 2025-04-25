$(document).ready(function () {
  $(window).on("scroll", function () {
    let scrollValue = $(this).scrollTop();
    let scrolledValueWithoutDecimal = scrollValue.toFixed(0);
    let firstNavigationHight = $("div.main-navigation--container").height();
    if ($(window).innerWidth() > 1199) {
      if (scrolledValueWithoutDecimal > firstNavigationHight) {
        $("div.navigation-container").css("top", `-${firstNavigationHight}px`);
        // $("div.main-navigation--container").css(
        //   "top",
        //   `-${firstNavigationHight}px`
        // );
      } else {
        $("div.navigation-container").css(
          "top",
          scrolledValueWithoutDecimal * -1
        );
      }
    }

    // console.log("Scroll position:", scrollValue);
  });

  // Cached Selectors
  const $window = $(window);
  const $targetElement = $(".main-navigation--container");
  const $targetElement2 = $(".top-logo");
  const $targetElement3 = $(".navigation-container");
  const $menuButton = $("#menu-button");
  const $searchContainer = $(".main-navigation-search-container");
  const $cssMenu = $("#cssmenu");
  let isScrolled = false;

  // Initialize the CSS Menu Plugin
  $cssMenu.menumaker({
    title: "",
    format: "multitoggle",
  });

  // Update opacity based on scroll position
  function updateOpacity() {
    if ($window.scrollTop() > 0) {
      $targetElement.addClass("navigation-scrolled");
      $targetElement2.addClass("navigation-scrolled");
      $targetElement3.addClass("navigation-scrolled");
      isScrolled = true;
    } else if (
      $(window).scrollTop() === 0 &&
      $("#menu-button").hasClass("menu-opened")
    ) {
      isScrolled = true;
      $targetElement.hasClass("navigation-scrolled");
      $targetElement2.hasClass("navigation-scrolled");
      $targetElement3.hasClass("navigation-scrolled")
        ? null
        : $targetElement.addClass("navigation-scrolled");
      $targetElement2.addClass("navigation-scrolled");
      $targetElement3.addClass("navigation-scrolled");
    } else if (isScrolled) {
      $targetElement.removeClass("navigation-scrolled");
      $targetElement2.removeClass("navigation-scrolled");
      $targetElement3.removeClass("navigation-scrolled");
      isScrolled = false;
    }
  }

  // Initial opacity update on page load and scroll event
  updateOpacity();
  $window.scroll(updateOpacity);

  // Toggle navigation-scrolled on #menu-button click

  // Hover effect for submenu items

  // if ($(window).innerWidth() > 1199) {
  //   // Add hover events
  //   $cssMenu
  //     .find("li")
  //     .add($targetElement.find("a"))
  //     .hover(
  //       function () {
  //         // Hover in
  //         $targetElement.addClass("navigation-scrolled");
  //         $targetElement2.addClass("navigation-scrolled");
  //         $targetElement3.addClass("navigation-scrolled");
  //       },
  //       function () {
  //         // Hover out
  //         if ($(window).scrollTop() === 0) {
  //           $targetElement.removeClass("navigation-scrolled");
  //           $targetElement2.removeClass("navigation-scrolled");
  //           $targetElement3.removeClass("navigation-scrolled");
  //         }
  //       }
  //     );
  // }

  // Search bar toggle
  $searchContainer.on("click", ".navigation-search", () => {
    $(".searchBarOpen").addClass("search-active");
    $("html").addClass("no-scroll");
  });
  $(".searchBarOpen--closeBtn").on("click", () => {
    $(".searchBarOpen").removeClass("search-active");
    $("html").removeClass("no-scroll");
  });

  // Dropdown handling
  $(".dropdown.signin-btn > .dropdown-toggle").click(function () {
    $menuButton.removeClass("menu-opened");
    $cssMenu.find("ul, .cssmenu2 ul").removeClass("open").css("display", "");
  });

  // Footer toggle button
  $(".toggleButton").click(function () {
    if ($window.width() <= 991) {
      const $ul = $(this).closest("div").next("ul");
      $ul.toggleClass("show");
      $(this).find(".fa-plus").toggle(!$ul.hasClass("show"));
      $(this).find(".fa-minus").toggle($ul.hasClass("show"));
    }
  });

  // Back to top button
  $(".backtotop-box").click(function () {
    $("html, body").animate({ scrollTop: 0 }, "fast");
  });

  // Navbar active link
  $(".nav-link").click(function () {
    $(".nav-link").removeClass("active");
    $(this).addClass("active");
  });

  // Navbar search toggle
  $(".search-icon").click(function () {
    $(".nav-search, .navbar-search-bar-container").addClass("active");
  });
  $(".close-icon").click(function () {
    $(".nav-search, .navbar-search-bar-container").removeClass("active");
  });

  // Submenu toggle in the navigation
  $(".has-sub").click(function () {
    // const $submenu = $(this).find("ul");
    // const isOpen = $submenu.hasClass("open");
    // $("li.has-sub > span.submenu-button").removeClass("submenu-opened");
    // $("li.has-sub > ul").removeClass("open").css("display", "");

    if (!isOpen) {
      $submenu.addClass("open").css("display", "grid");
      $(this).find("span.submenu-button").addClass("submenu-opened");
    }
  });
});
$(document).ready(function () {
  const $donationBox = $(".floationg-quick-donation");

  // Function to get the appropriate closed position
  function getClosedPosition() {
    return window.matchMedia("(max-width: 474.8888888px)").matches
      ? "-290px"
      : "-400px";
  }

  // Set the initial position of the donation box
  $donationBox.css("inset-inline-end", getClosedPosition());

  $(".floationg-quick-donation-toggle").click(function () {
    const $icon = $(this).find("i");

    // Check if the box is visible
    const isVisible = $donationBox.css("inset-inline-end") === "0px";

    // Toggle position
    $donationBox.css(
      "inset-inline-end",
      isVisible ? getClosedPosition() : "0px"
    );

    // Toggle icon class
    $icon.toggleClass("fa-heart fa-xmark");

    // Remove or add spans dynamically
    if (isVisible) {
      // Add spans back when closing
      if ($(this).find("span").length === 0) {
        if ($("body").hasClass("arabic-version")) {
          // Add Arabic spans
          $(this).append("<span> تبرع</span><span>سريع</span>");
        } else {
          // Add English spans
          $(this).append("<span>Quick</span><span>Donation</span>");
        }
      }
    } else {
      // Remove spans when opening
      $(this).find("span").remove();
    }
  });
});

// donation progress

$(document).ready(function () {
  $(".inner-colored-progress-bar").each(function () {
    // Get the progress value
    const progressValue = $(this).attr("progress");

    // Set the width dynamically
    $(this).css("width", progressValue);

    // Set the text content of the span to the progress value
    $(this).find("span").text(progressValue);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const input = document.querySelector("#mobile-number-input");
  window.intlTelInput(input, {
    initialCountry: "JO",
    separateDialCode: true,
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const input = document.querySelector("#mobile-number-input-2");
  window.intlTelInput(input, {
    initialCountry: "JO",
    separateDialCode: true,
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const ecardInputs = document.querySelectorAll(".ecard input");
  ecardInputs.forEach((input) => {
    input.addEventListener("change", () => {
      document.querySelectorAll(".ecard").forEach((ecard) => {
        ecard.classList.remove("selected");
      });
      input.closest(".ecard").classList.add("selected");
    });
  });
});

$(document).ready(function () {
  $(".floationg-quick-donation-toggle").click(function () {
    $(".floationg-quick-donation").toggleClass("open");
  });
});

$(document).ready(function () {
  $("input[type='date']").on("click", function () {
    if ("showPicker" in this) {
      this.showPicker(); // Opens the native date picker if supported
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const quickOnceBtn = document.getElementById("quick-once-btn");
  const quickMonthlyBtn = document.getElementById("quick-monthly-btn");

  quickOnceBtn.addEventListener("click", function () {
    // Add 'active' class to quickOnceBtn and remove it from quickMonthlyBtn
    quickOnceBtn.classList.add("active");
    quickMonthlyBtn.classList.remove("active");
  });

  quickMonthlyBtn.addEventListener("click", function () {
    // Add 'active' class to quickMonthlyBtn and remove it from quickOnceBtn
    quickMonthlyBtn.classList.add("active");
    quickOnceBtn.classList.remove("active");
  });
});
$(document).ready(function () {
  $(".floating-box-toggle-mobile-version").click(function () {
    $(".floationg-quick-donation-card.mobile-version form")
      .removeClass("hidden")
      .hide()
      .slideDown("fast");

    $(this).addClass("hidden");
  });

  $(".floating-box-close-btn").click(function () {
    $(".floationg-quick-donation-card.mobile-version form").slideUp(
      "fast",
      function () {
        $(this).addClass("hidden"); // Hide form after animation

        // Ensure the toggle button reappears
        $(".floating-box-toggle-mobile-version").removeClass("hidden").fadeIn();
      }
    );
  });
});

$(document).ready(function () {
  $(".mobile-bars-icon-container span").click(function () {
    const $span = $(this);
    if ($span.hasClass("bars-active")) {
      $span.removeClass("bars-active").addClass("xmark-active");
      $(".side-nav-mobile-version").addClass("burger-menu-open");
    } else if ($span.hasClass("xmark-active")) {
      $span.removeClass("xmark-active").addClass("bars-active");
      $(".side-nav-mobile-version").removeClass("burger-menu-open");
    }
  });
});
// Share Button
$(document).ready(function () {
  $(".share-btn1").on("click", function () {
    const shareBtn = $(this);
    const overlay = shareBtn.next(".share-overlay1");
    const closeBtn = overlay.find("#close");
    const overlay2 = overlay.find(".share-container");
    const overlay3 = shareBtn.closest(".buttons").find(".type-4-btn");

    // إخفاء زر المشاركة وتحريكه للخارج
    shareBtn.css({
      opacity: "0",
      transform: "translateX(-50px)",
      transition: "0.5s ease-in-out",
    });

    setTimeout(() => {
      shareBtn.css("display", "none");
    }, 500);

    if (overlay3.length) {
      overlay3.css({
        opacity: "0",
        transform: "translateX(-50px)",
        transition: "0.5s ease-in-out",
      });

      setTimeout(() => {
        overlay3.css("display", "none");
      }, 500);
    }

    // إظهار زر الإغلاق
    closeBtn.css({
      display: "flex",
      opacity: "0",
      transform: "translateX(50px)",
    });

    setTimeout(() => {
      closeBtn.css({
        opacity: "1",
        transform: "translateX(0)",
        transition: "0.5s ease-in-out",
      });
    }, 100);

    // بعد 0.2 ثانية، إظهار القائمة مع الأنيميشن
    setTimeout(function () {
      overlay2.css({
        display: "flex",
        opacity: "0",
        transform: "translateX(100%)",
      });

      setTimeout(() => {
        overlay2.css({
          opacity: "1",
          transform: "translateX(0)",
          transition: "0.5s ease-in-out",
        });
      }, 50);

      overlay.addClass("active");
    }, 200);
  });

  // عند الضغط على زر الإغلاق
  $(document).on("click", "#close", function () {
    const closeBtn = $(this);
    const overlay = closeBtn.closest(".share-overlay1");
    const shareBtn = overlay.prev(".share-btn1");
    const overlay2 = overlay.find(".share-container");
    const overlay3 = shareBtn.closest(".buttons").find(".type-4-btn");

    overlay.removeClass("active");

    // إخفاء القائمة بتحريكها للخارج
    overlay2.css({
      opacity: "1",
      transform: "translateX(0)",
    });

    setTimeout(() => {
      overlay2.css({
        opacity: "0",
        transform: "translateX(100%)",
        transition: "0.5s ease-in-out",
      });
    }, 50);

    setTimeout(() => {
      overlay2.css("display", "none");
    }, 500);

    // إخفاء زر الإغلاق
    closeBtn.css({
      opacity: "0",
      transform: "translateX(50px)",
      transition: "0.5s ease-in-out",
    });

    setTimeout(() => {
      closeBtn.css("display", "none");
    }, 500);

    // إعادة إظهار زر المشاركة وتحريكه للداخل
    setTimeout(function () {
      shareBtn.css({
        display: "flex",
        opacity: "0",
        transform: "translateX(-50px)",
      });

      setTimeout(() => {
        shareBtn.css({
          opacity: "1",
          transform: "translateX(0)",
          transition: "0.5s ease-in-out",
        });
      }, 50);
    }, 500);

    // إعادة إظهار زر "Read more" وتحريكه للداخل
    if (overlay3.length) {
      setTimeout(function () {
        overlay3.css({
          display: "flex",
          opacity: "0",
          transform: "translateX(-50px)",
        });

        setTimeout(() => {
          overlay3.css({
            opacity: "1",
            transform: "translateX(0)",
            transition: "0.5s ease-in-out",
            flexShrink: "0",
          });
        }, 50);
      }, 200);
    }
  });
});
