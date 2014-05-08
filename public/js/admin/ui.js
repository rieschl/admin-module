$(function () {
    'use strict';
    var domPageOptions = $('.page-options'),
        domStickyOptions;
    // Sticky page options
    $(document).bind('scroll', function (e) {
        var viewportOffset;
        if (domPageOptions.length === 0) {
            return;
        }
        viewportOffset = domPageOptions.offset()['top'] - $(document).scrollTop();
        if (viewportOffset < 0) {
            if (!domStickyOptions) {
                domStickyOptions = domPageOptions
                    .clone(true)
                    .hide()
                    .insertAfter(domPageOptions)
                    .addClass('sticky')
                    .slideDown('fast');
            }
        } else {
            if (domStickyOptions) {
                domStickyOptions.slideUp('fast', function () {
                    $(this).remove();
                });
                domStickyOptions = undefined;
            }
        }
    });
    $('.page-help-trigger').click(function () {
        $('.' + $(this).data('key')).fadeToggle('slow');
    });
    setTimeout(function () {
        var $el = $('.flash-messages');
        $el.addClass('hidden');
        setTimeout(function () {
            $el.remove();
        }, 1000);
    }, 2000);
    $('body').on('click', 'a.confirm', function (e) {
        e.preventDefault();
        if (confirm('Sicher?')) {
            location.href = $(this).attr('href');
        }
    });
});