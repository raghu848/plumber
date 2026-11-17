let grecaptchaKey = '6LfLESApAAAAAF3wOVNZ4FnA8gM4nCVezsC0kT8A';
! function(e) {
    "use strict";

    function a() {
        if (e(".main-header").length) {
            var a = e(window).scrollTop(),
                t = e(".main-header"),
                s = e(".main-header").height(),
                i = e(".scroll-to-top"),
                n = e(".main-header .sticky-header");
            a > s ? (t.addClass("fixed-header"), n.addClass("animated slideInDown"), i.fadeIn(300)) : (t.removeClass("fixed-header"), n.removeClass("animated slideInDown"), i.fadeOut(300))
        }
    }
	
    if (a(), e(".main-header li.dropdown ul").length && e(".main-header .navigation li.dropdown").append('<div class="dropdown-btn"><span class="fa fa-angle-right"></span></div>'), e(".mobile-menu").length) {
        e(".mobile-menu .menu-box").mCustomScrollbar();
        var t = e(".main-header .nav-outer .main-menu").html();
        e(".mobile-menu .menu-box .menu-outer").append(t), e(".sticky-header .main-menu").append(t), e(".mobile-menu li.dropdown .dropdown-btn").on("click", (function() {
            e(this).toggleClass("open"), e(this).prev("ul").slideToggle(500)
        })), e(".mobile-nav-toggler").on("click", (function() {
            e("body").addClass("mobile-menu-visible")
        })), e(".mobile-menu .menu-backdrop,.mobile-menu .close-btn").on("click", (function() {
            e("body").removeClass("mobile-menu-visible")
        })), e(document).keydown((function(a) {
            27 === a.keyCode && (e("#search-popup").removeClass("mobile-menu-visible"), e("body").removeClass("mobile-menu-visible"))
        }))
    }

    function s() {
        e(".masonry-container").length && (e(window), e(".masonry-container").isotope({
            itemSelector: ".masonry-item",
            masonry: {
                columnWidth: ".column-width"
            },
            animationOptions: {
                duration: 500,
                easing: "linear"
            }
        }))
    }

    function i() {
        if (e(".sortable-masonry").length) {
            var a = e(window),
                t = e(".sortable-masonry .items-container"),
                s = e(".filter-btns");
            t.isotope({
                filter: "*",
                masonry: {
                    columnWidth: ".column-width"
                },
                animationOptions: {
                    duration: 500,
                    easing: "linear"
                }
            }), s.find("li").on("click", (function() {
                var a = e(this).attr("data-filter");
                try {
                    t.isotope({
                        filter: a,
                        animationOptions: {
                            duration: 500,
                            easing: "linear",
                            queue: !1
                        }
                    })
                } catch (e) {}
                return !1
            })), a.on("resize", (function() {
                var e = s.find("li.active").attr("data-filter");
                t.isotope({
                    filter: e,
                    animationOptions: {
                        duration: 500,
                        easing: "linear",
                        queue: !1
                    }
                })
            }));
            var i = e(".filter-btns li");
            i.on("click", (function() {
                var a = e(this);
                a.hasClass("active") || (i.removeClass("active"), a.addClass("active"))
            }))
        }
    }
	
    e(".banner-carousel").length && e(".banner-carousel").owlCarousel({
        loop: !0,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        margin: 0,
        nav: !0,
        smartSpeed: 500,
        autoplay: 6e3,
        autoplayTimeout: 7e3,
        navText: ['<span class="icon flaticon-left-arrow"></span>', '<span class="icon flaticon-right-arrow-1"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            800: {
                items: 1
            },
            1024: {
                items: 1
            }
        }
    }), e(".project-carousel").length && e(".project-carousel").owlCarousel({
        loop: !0,
        margin: 30,
        nav: !0,
        smartSpeed: 700,
        autoplay: 5e3,
        autoplayTimeout: 5e3,
        navText: ['<span class="icon flaticon-left-arrow"></span>', '<span class="icon flaticon-right-arrow-1"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    }), e(".testimonial-carousel").length && e(".testimonial-carousel").owlCarousel({
        loop: !0,
        margin: 0,
        nav: !0,
        smartSpeed: 700,
        autoplay: 5e3,
        autoplayTimeout: 5e3,
        navText: ['<span class="icon flaticon-left-arrow"></span>', '<span class="icon flaticon-right-arrow-1"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    }), e(".testimonial-carousel-two").length && e(".testimonial-carousel-two").owlCarousel({
        loop: !0,
        margin: 30,
        nav: !0,
        smartSpeed: 700,
        autoplay: 5e3,
        autoplayTimeout: 5e3,
        navText: ['<span class="icon flaticon-left-arrow"></span>', '<span class="icon flaticon-right-arrow-1"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    }), e(".sponsors-carousel").length && e(".sponsors-carousel").owlCarousel({
        loop: !0,
        margin: 30,
        nav: !0,
        smartSpeed: 700,
        autoplay: 5e3,
        autoplayTimeout: 5e3,
        navText: ['<span class="icon flaticon-left-arrow"></span>', '<span class="icon flaticon-right-arrow-1"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 4
            }
        }
    }), e(".awards-carousel").length && e(".awards-carousel").owlCarousel({
        loop: !0,
        margin: 30,
        nav: !0,
        smartSpeed: 700,
        autoplay: 5e3,
        autoplayTimeout: 5e3,
        navText: ['<span class="icon flaticon-left-arrow"></span>', '<span class="icon flaticon-right-arrow-1"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 2
            },
            1700: {
                items: 2
            },
            1900: {
                items: 3
            }
        }
    }), e(".mvg-carousel").length && e(".mvg-carousel").owlCarousel({
        loop: !0,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        margin: 30,
        nav: !0,
        smartSpeed: 500,
        autoplay: 5e3,
        autoplayTimeout: 5e3,
        navText: ['<span class="icon flaticon-left-arrow"></span>', '<span class="icon flaticon-right-arrow-1"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            800: {
                items: 1
            },
            1024: {
                items: 1
            }
        }
    }), e(".history-carousel").length && e(".history-carousel").owlCarousel({
        loop: !0,
        margin: 50,
        nav: !0,
        smartSpeed: 700,
        autoplay: 5e3,
        autoplayTimeout: 5e3,
        navText: ['<span class="icon flaticon-left-arrow"></span>', '<span class="icon flaticon-right-arrow-1"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    }), e(".team-carousel").length && e(".team-carousel").owlCarousel({
        loop: !0,
        margin: 30,
        nav: !0,
        smartSpeed: 700,
        autoplay: 5e3,
        autoplayTimeout: 5e3,
        navText: ['<span class="icon flaticon-left-arrow"></span>', '<span class="icon flaticon-right-arrow-1"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    }), e(".single-item-carousel").length && e(".single-item-carousel").owlCarousel({
        loop: !0,
        margin: 30,
        nav: !0,
        smartSpeed: 500,
        autoplay: 5e3,
        autoplayTimeout: 5e3,
        navText: ['<span class="icon flaticon-left-arrow-1"></span>', '<span class="icon flaticon-left-arrow0"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            800: {
                items: 1
            },
            1024: {
                items: 1
            }
        }
    }), e(".count-box").length && e(".count-box").appear((function() {
        var a = e(this),
            t = a.find(".count-text").attr("data-stop"),
            s = parseInt(a.find(".count-text").attr("data-speed"), 10);
        a.hasClass("counted") || (a.addClass("counted"), e({
            countNum: a.find(".count-text").text()
        }).animate({
            countNum: t
        }, {
            duration: s,
            easing: "linear",
            step: function() {
                a.find(".count-text").text(Math.floor(this.countNum))
            },
            complete: function() {
                a.find(".count-text").text(this.countNum)
            }
        }))
    }), {
        accY: 0
    }), e(".tabs-box").length && e(".tabs-box .tab-buttons .tab-btn").on("click", (function(a) {
        a.preventDefault();
        var t = e(e(this).attr("data-tab"));
        if (e(t).is(":visible")) return !1;
        t.parents(".tabs-box").find(".tab-buttons").find(".tab-btn").removeClass("active-btn"), e(this).addClass("active-btn"), t.parents(".tabs-box").find(".tabs-content").find(".tab").fadeOut(0), t.parents(".tabs-box").find(".tabs-content").find(".tab").removeClass("active-tab"), e(t).fadeIn(300), e(t).addClass("active-tab")
    })), e(".accordion-box").length && e(".accordion-box").on("click", ".acc-btn", (function() {
        var a = e(this).parents(".accordion-box"),
            t = e(this).parents(".accordion");
        e(this).next(".acc-content").is(":visible") ? (e(this).removeClass("active"), e(this).next(".acc-content").slideUp(300), e(a).children(".accordion").removeClass("active-block")) : (e(a).find(".accordion .acc-btn").removeClass("active"), e(this).addClass("active"), e(a).children(".accordion").removeClass("active-block"), e(a).find(".accordion").children(".acc-content").slideUp(300), t.addClass("active-block"), e(this).next(".acc-content").slideDown(300))
    })), e(".custom-select-box").length && e(".custom-select-box").selectmenu().selectmenu("menuWidget").addClass("overflow"), e(".time-countdown").length && e(".time-countdown").each((function() {
        var a = e(this),
            t = e(this).data("countdown");
        a.countdown(t, (function(a) {
            e(this).html(a.strftime('<div class="counter-column"><span class="count">%D</span>Days</div> <div class="counter-column"><span class="count">%H</span>Hrs</div>  <div class="counter-column"><span class="count">%M</span>Mins</div>  <div class="counter-column"><span class="count">%S</span>Secs</div>'))
        }))
    })), e(".lightbox-image").length && e(".lightbox-image").fancybox({
        openEffect: "fade",
        closeEffect: "fade",
        helpers: {
            media: {}
        }
    }), e(".filter-list").length && e(".filter-list").mixItUp({}), e(".datepicker").length && e(".datepicker").datepicker({
        minDate: 0,
        maxDate: "+11M +29D"
    }), e(".price-range-slider").length && (e(".price-range-slider").slider({
        range: !0,
        min: 10,
        max: 200,
        values: [10, 99],
        slide: function(a, t) {
            e("input.property-amount").val(t.values[0] + " - " + t.values[1])
        }
    }), e("input.property-amount").val(e(".price-range-slider").slider("values", 0) + " - $" + e(".price-range-slider").slider("values", 1))), e(".quantity-spinner").length && e("input.quantity-spinner").TouchSpin({
        verticalbuttons: !0
    }), s(), i(), e("#contact-form").length && e("#contact-form").validate({
        rules: {
            username: {
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            phone: {
                required: !0
            },
            subject: {
                required: !0
            },
            message: {
                required: !0
            }
        },
		submitHandler: function(a) {
            var t;
            e(".errormessage").html('<div class="alert alert-success">Submiting..</div>');
            var s = e(a).serialize();
			grecaptcha.ready(function() { // Wait for the recaptcha to be ready
                grecaptcha.execute(grecaptchaKey, {
                        action: "contact"
                    }).then(function(token){
                        let recaptchaResponse = document.getElementById("recaptchaResponse");
                        recaptchaResponse.value = token;
						var i = e(a).serialize();
						e.ajax({
							method: "POST",
							url: "1send_mail.php",
							data: i,
							dataType: "json",
							success: function(s) {
								s.status ? (e(a)[0].reset(), t = '<div class="alert alert-success">' + s.message + "</div>") : t = '<div class="alert alert-danger">' + s.message + "</div>", e(".errormessage").html(t), setTimeout((function() {
									e(".errormessage").html("")
								}), 5e3)
							}
						});
                    })
            });
        }
    }), e(".scroll-to-target").length && e(".scroll-to-target").on("click", (function(a) {
        a.preventDefault();
        var t = e(this).attr("data-target");
        e("html, body").animate({
            scrollTop: e(t).offset().top
        }, 1500)
    })), e(".wow").length && new WOW({
        boxClass: "wow",
        animateClass: "animated",
        offset: 0,
        mobile: !1,
        live: !0
    }).init(), e("#contactForm").length && e("#contactForm").validate({
        rules: {
            name: {
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            phone: {
                required: !0
            },
            service: {
                required: !0
            },
            message: {
                required: !0
            }
        },
        messages: {
            name: "Your name required",
            email: "Enter a valid email",
            phone: "Your phone required",
            service: "Service required",
            message: "Your message required"
        },
        submitHandler: function(a) {
            var t;
            e(".errormessage").html('<div class="alert alert-success">Submiting..</div>');
            var s = e(a).serialize();
			grecaptcha.ready(function() { // Wait for the recaptcha to be ready
                grecaptcha.execute(grecaptchaKey, {
                        action: "contact"
                    }).then(function(token){
                        let recaptchaResponse = document.getElementById("recaptchaResponse");
                        recaptchaResponse.value = token;
						var i = e(a).serialize();
						e.ajax({
							method: "POST",
							url: "1send_mail.php",
							data: i,
							dataType: "json",
							success: function(s) {
								s.status ? (e(a)[0].reset(), t = '<div class="alert alert-success">' + s.message + "</div>") : t = '<div class="alert alert-danger">' + s.message + "</div>", e(".errormessage").html(t), setTimeout((function() {
									e(".errormessage").html("")
								}), 5e3)
							}
						});
                    })
            });
			return false;
        }
    }), e("#homeQuote").length && e("#homeQuote").validate({
        rules: {
            name: {
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            phone: {
                required: !0
            },
            service: {
                required: !0
            },
            address: {
                required: !0
            }
        },
        messages: {
            name: "Your name required",
            email: "Enter a valid email",
            phone: "Your phone required",
            service: "Service required",
            address: "Your address required"
        },
        submitHandler: function(a) {
            var t;
            e(".errormessage").html('<div class="alert alert-success">Submiting..</div>');
            var s = e(a).serialize();
			grecaptcha.ready(function() { // Wait for the recaptcha to be ready
                grecaptcha.execute(grecaptchaKey, {
                        action: "contact"
                    }).then(function(token){
                        let recaptchaResponse = document.getElementById("recaptchaResponse");
                        recaptchaResponse.value = token;
						var i = e(a).serialize();
						e.ajax({
							method: "POST",
							url: "1send_mail.php",
							data: i,
							dataType: "json",
							success: function(s) {
								s.status ? (e(a)[0].reset(), t = '<div class="alert alert-success">' + s.message + "</div>") : t = '<div class="alert alert-danger">' + s.message + "</div>", e(".errormessage").html(t), setTimeout((function() {
									e(".errormessage").html("")
								}), 5e3)
							}
						});
                    })
            });
			return false;
        }
    }), e("#sliderForm").length && e("#sliderForm").validate({
        rules: {
            name: {
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            phone: {
                required: !0
            },
            service: {
                required: !0
            },
            address: {
                required: !0
            }
        },
        messages: {
            name: "Your name required",
            email: "Enter a valid email",
            phone: "Your phone required",
            service: "Service required",
            address: "Your address required"
        },
        submitHandler: function(a) {
            var t;
            e(".errormessage").html('<div class="alert alert-success">Submiting..</div>');
            var s = e(a).serialize();
			grecaptcha.ready(function() { // Wait for the recaptcha to be ready
                grecaptcha.execute(grecaptchaKey, {
                        action: "contact"
                    }).then(function(token){
                        let recaptchaResponse = document.getElementById("recaptchaResponse");
                        recaptchaResponse.value = token;
						var i = e(a).serialize();
						e.ajax({
							method: "POST",
							url: "1send_mail.php",
							data: i,
							dataType: "json",
							success: function(s) {
								s.status ? (e(a)[0].reset(), t = '<div class="alert alert-success">' + s.message + "</div>") : t = '<div class="alert alert-danger">' + s.message + "</div>", e(".errormessage").html(t), setTimeout((function() {
									e(".errormessage").html("")
								}), 5e3)
							}
						});
                    })
            });
			return false;
        }
    }), e("#appointmentForm").length && e("#appointmentForm").validate({
        rules: {
            name: {
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            phone: {
                required: !0
            },
            service: {
                required: !0
            },
            package: {
                required: !0
            },
            sel_group: {
                required: !0
            },
            address1: {
                required: !0
            },
            address2: {
                required: !0
            },
            special_mention: {
                required: !0
            },
            time_group: {
                required: !0
            }
        },
        messages: {
            name: "Your name required",
            email: "Enter a valid email",
            phone: "Your phone required",
            service: "Service required",
            package: "Your package required",
            sel_group: "Service Type required",
            address1: "Your Address required",
            address2: "Your Address 2 required",
            special_mention: "Special Mention required",
            time_group: "Time required"
        },
        submitHandler: function(a) {
            var t, s = e(".datepicker").datepicker().val();
            console.log(s), e(".errormessage").html('<div class="alert alert-success">Submiting..</div>');
			
			grecaptcha.ready(function() { // Wait for the recaptcha to be ready
                grecaptcha.execute(grecaptchaKey, {
                        action: "contact"
                    }).then(function(token){
                        let recaptchaResponse = document.getElementById("recaptchaResponse");
                        recaptchaResponse.value = token;
						var i = e(a).serialize() + "&date=" + s;
						e.ajax({
							method: "POST",
							url: "1send_mail.php",
							data: i,
							dataType: "json",
							success: function(s) {
								s.status ? (e(a)[0].reset(), t = '<div class="alert alert-success">' + s.message + "</div>") : t = '<div class="alert alert-danger">' + s.message + "</div>", e(".errormessage").html(t), setTimeout((function() {
									e(".errormessage").html("")
								}), 5e3)
							}
						});
                    })
            });
			return false;
        }
    }), setInterval((() => {
        let e = new Date,
            a = e.getHours(),
            t = e.getMinutes(),
            s = e.getSeconds(),
            i = "";
        a > 12 ? (a -= 12, i = "PM") : 0 == a ? (a = 12, i = "AM") : i = "AM", a = a > 10 ? a : "0" + a, t = t > 10 ? t : "0" + t, s = s > 10 ? s : "0" + s, document.getElementById("digital-clock").innerHTML = `${a}:${t}:${s} ${i}`
    }), 1e3), e(window).on("scroll", (function() {
        a()
    })), e(window).on("resize", (function() {})), e(window).on("load", (function() {
        e(".preloader").length && (e("body").addClass("page-loaded"), e(".preloader").delay(1e3).fadeOut(0)), s(), i()
    }))
}(window.jQuery);