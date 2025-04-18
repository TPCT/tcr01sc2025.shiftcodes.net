$(".owl-carousel").each(function() {
    var t = $(this).attr("data-items-large") || 3,  // Default to 3 if not defined
        m = $(this).attr("data-items-medium") || 2, // Default to 2 if not defined
        e = $(this).attr("data-items-small") || 1,  // Default to 1 if not defined
        s = $(this).attr("data-is-autoplay"),
        a = $(this).attr("data-is-loop"),
        stage = $(this).attr("data-stage");

    $(this).owlCarousel({
        loop: a === "yes",
        margin: 10,
        nav: true,
        dots: false,
        autoplay: !!s,
        autoplayTimeout: 5000,
        navText: [
            "<img alt='left' width='33' height='33' src='/website/images/icons/slider_left.png'>",
            "<img width='33' height='33' alt='right' src='/website/images/icons/slider_right.png'>"
        ],
        responsive: {
            0: {
                items: parseInt(e),
                stagePadding: stage ? parseInt(stage) : 40
            },
            768: {
                items: parseInt(m),
                stagePadding: 5
            },
            1200: {
                items: parseInt(t)
            }
        }
    });
})
, $(".scroll-up").on("click", function() {
    $("html, body").animate({
        scrollTop: 0
    }, "slow")
}), $(".header__actions_list_item").on("click", function() {
    var t = $(this).find(".header__actions_menu");
    t.toggle(), $(".header__actions_menu").not(t).hide()
}), $(document).on('click', function(event) {
    if (!$(event.target).closest('.header__actions_list_item').length) {
        $(".header__actions_list_item .header__actions_menu").hide()
    }
}), $(".type__filter ul li").on("click", function() {
    var t = $(this).find("input");
    t.prop("checked", !t.prop("checked")), $(this).toggleClass("active")
}), $(".select-brand").on("change", function() {
    var t = $(this).val();
    $.ajax({
        url: "/brands/models?brand_id=" + t,
        type: "get",
        success: function(t) {
            $(".select-model").html("<option value=''>Choose Model</option>"), t.forEach(function(t) {
                var e = `<option value="${t.id}">${t.title.en}</option>`;
                $(".select-model").append(e)
            })
        },
    })
}), $(".order-by").on("change", function() {
    $(this).closest("form").submit()
}), $(".search-cars").on("keyup", function() {
    var t = $(this).val();
    t.length >= 3 ? $.ajax({
        url: "/cars/search?search=" + t,
        type: "get",
        success: function(t) {
            t.length > 0 ? (console.log(t + "data" + t.length), $(".search__result ul").html(""), t.forEach(function(t) {
                console.log(t);
                var e = `<li><a href="${t.url}">${t.keyword}</a></li>`;
                $(".search__result ul").append(e)
            }), $(".search__result").show()) : $(".search__result").hide()
        },
    }) : $(".search__result").hide()
}), $(".read-more").click(function() {
    var ReadMore = $(".tr-read-more").val();
    var ReadLess = $(".tr-read-less").val();
    $(this).parent().find(".home__brands_desc").toggleClass("height-auto"), $(this).parent().find(".home__brands_desc").hasClass("height-auto") ? $(this).html(ReadLess) : $(this).html(ReadMore)
}), $('[data-toggle="tooltip"]').tooltip(), $(".wishlist-toggle").click(function() {
    var t = $(this).attr("data-auth");
    (t && "0" != t) || $("#signinModal").modal("show");
    var e = $(this),
        s = $(this).attr("data-id");
    $.ajax({
        url: "/wishlist/toggle?car_id=" + s,
        type: "get",
        success: function(t) {
            "success" == t.status && ("add" == t.action ? e.html("Remove from wishlist") : e.html("Save to wishlist"))
        },
    })
});
$(".link").on("click", function() {
    var url = $(this).attr('data-href')
    if (!url)
        return;
    window.location.href = url
})
$(window).on("load", function() {
    console.log('loaded')
    $.ajax({
        url: "/iframes",
        type: "get",
        success: function(data) {
            console.log(data)
            $(".gr").append(data.gr)
            $(".fb").append(data.fb)
        }
    })
});
$(".go-back").click(function() {
    window.history.back()
})
$('.owl-carousel').each(function() {
    $(this).find('.owl-nav button').each(function(index) {
        $(this).attr('aria-label', index + 1);
        $(this).removeAttr('role')
    })
});
$(".car-contact").on("click", function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var type = $(this).attr('data-type');
    $.ajax({
        url: "/a/" + id + "?type=" + type,
        type: "get",
        success: function(data) {
            window.location.href = data.url
        }
    })
})
$(".navbar-toggler").on("click", function() {
    $(".navbar-collapse").toggleClass("show")
})
$(".open-auth").click(function() {
    $(".navbar-collapse").removeClass("show")
})
$(".close-menu").on("click", function() {
    $(".navbar-collapse").removeClass("show")
});

$(".read-more-page").click(function() {
    var ReadMore = $(".tr-read-more").val();
    var ReadLess = $(".tr-read-less").val();
    $(this).parent().find("p").toggleClass("height-auto"), $(this).parent().find("p").hasClass("height-auto") ? $(this).html(ReadLess) : $(this).html(ReadMore)
})
$(".expand-models").click(function() {
    var ReadMore = $(".tr-read-more").val();
    var ReadLess = $(".tr-read-less").val();
    $(this).parent().find(".product-page__sub_categories").toggleClass("height-auto"), $(this).parent().find(".product-page__sub_categories").hasClass("height-auto") ? $(this).html(ReadLess) : $(this).html(ReadMore)
})
$(".search__filter_toggler").on("click", function() {
    $(this).hide();
    $(".products-page__filter").toggleClass("fixed-filter")
})
$(".close-fixed-filter").click(function() {
    $(".products-page__filter").removeClass("fixed-filter")
    $(".search__filter_toggler").css("display", "flex")
})
