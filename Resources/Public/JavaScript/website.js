
/*
 * Copyright (c) Domjos 2023
 *
 * This file is part of Domjos-Modern.
 * Domjos-Modern is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * Domjos-Modern is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with Foobar. If not, see http://www.gnu.org/licenses/.
 */


$(document).ready(
    function () {
        // replace shortcut in header
        $("div.jumbotron div.background div.frame-type-shortcut").each(function () {
           var img = $(this).find("img");
           var header = $(this).find("header");
           $(this).find("div.frame").replaceWith(img);
           $("div.jumbotron div.container.py-5 h2").replaceWith(header.find("h2"))
        });

        $(window).on("resize", function () {
            $('div.banner').each(function () {
                if($(this).find('img').length) {
                    $(this).find("div.banner-content").each(function () {
                        $(this).css("margin-top", "-" + $(this).height() + "px");
                    });
                } else {
                    var banner = $(this);
                    $(this).find("div.banner-content").each(function () {
                        banner.css("height", $(this).height() + "px");
                        $(this).parent().css("height", $(this).height() + "px")
                        $(this).css("margin-top", "1em");
                        $(this).css("padding-bottom", "1em");
                    });
                }
            });
        });

        $('figure.image').each(function() {
            if($(this).has('figcaption').length > 0) {
                $(this).addClass('withFigCaption');
                $(this).parent().parent().parent().parent().parent().parent().addClass('withFigCaption');
                $(this).parent().parent().parent().parent().addClass('withFigCaption');
            }
        });

        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });

        $('div.carousel div.carousel-inner div.carousel-item img').each(function () {
            var height = $(this).height();
            $(this).parent().css("height", height + "px");
        });

        $('div.banner').each(function () {
           if($(this).find('img').length) {
               $(this).find("div.banner-content").each(function () {
                   $(this).css("margin-top", "-" + $(this).height() + "px");
               });
           } else {
               var banner = $(this);
               $(this).find("div.banner-content").each(function () {
                   banner.css("height", $(this).height() + "px");
                   $(this).parent().css("height", $(this).height() + "px")
                   $(this).css("margin-top", "1em");
                   $(this).css("padding-bottom", "1em");
               });
           }
        });

        $('.mc-btn-action').click(function () {
            var card = $(this).parent('.mc-content').parent('.material-card');
            var icon = $(this).children('i');
            icon.addClass('fa-spin-fast');

            if (card.hasClass('mc-active')) {
                card.removeClass('mc-active');

                window.setTimeout(function() {
                    icon
                        .removeClass('fa-arrow-left')
                        .removeClass('fa-spin-fast')
                        .addClass('fa-bars');

                }, 800);
            } else {
                card.addClass('mc-active');

                window.setTimeout(function() {
                    icon
                        .removeClass('fa-bars')
                        .removeClass('fa-spin-fast')
                        .addClass('fa-arrow-left');

                }, 800);
            }
        });

        $('div.gallery div.ce-header img').click(function () {
            var gallery = $(this).parent('.ce-header').parent('.container').parent('.gallery');

            if(gallery.hasClass('active')) {
                gallery.removeClass('active');
            } else {
                gallery.addClass('active');
            }
        });
        const img = $('.parallax img.bg_img');
        $('.parallax').parallax({imageSrc: img.attr('src')});
        $('img.parallax-slider').attr('alt', img.attr('alt'));

        const script = $('script');
        if(Array.isArray(script)) {
            script.forEach(function () {
                if(this.attr("type") === "text/plain") {
                    this.attr("cookie-consent", "tracking")
                }
            });
        }

        $(window).scroll(function () {
            var y = $(this).scrollTop() / 255.0;
            var col = 255 - $(this).scrollTop();
            if(y<=255) {
                console.log(y);
                $("div.sticky").css("background-color", "rgba(255,255,255," + y + ")");
                $("div.sticky nav").css("background-color", "rgba(255,255,255," + y + ")");
                $("div.sticky.top nav.fixed-top ul a").css("color", "rgb(" + col + ", " + col + ", " + col + ")");
                $("div.sticky nav a.navbar-brand img").css("background-color", "rgba(" + col + ", " + col + ", " + col + "," + y + ")");

            } else {
                $("div.sticky").css("background-color", "rgb(255,255,255)");
                $("div.sticky nav").css("background-color", "rgb(255,255,255)");
                $("div.sticky.top nav.fixed-top ul a").css("color", "rgb(0,0,0)");
                $("div.sticky nav a.navbar-brand img").css("background-color", "rgb(0,0,0)");
            }
        })
    }
)

const slider = document.querySelector('.drag');
let mouseDown = false;
let startX, scrollLeft;

if(slider != null) {
    let startDragging = function (e) {
        mouseDown = true;
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    };
    let stopDragging = function () {
        mouseDown = false;
    };
    let move = function (event) {
        event.preventDefault();
        if(!mouseDown) { return; }
        const x = event.pageX - slider.offsetLeft;
        const scroll = x - startX;
        slider.scrollLeft = scrollLeft - scroll;
    }

    slider.addEventListener('mousemove', move, false)
    slider.addEventListener('mousedown', startDragging, false);
    slider.addEventListener('mouseup', stopDragging, false);
    slider.addEventListener('mouseleave', stopDragging, false);
}