(function () {
    'use strict';

    function switchTab($container, name) {
        var containerSelector = 'article';
        var activeClass = 'active';

        var $tabs = $container.children('.tabs');
        var $containers = $container.children(containerSelector);
        var $tab = $tabs.find('a[href="#' + name + '"]').parent();
        var $target = $container.find('[name=' + name + ']').parents(containerSelector);

        $tabs.find('li').removeClass(activeClass);
        $tab.addClass(activeClass);
        $containers.removeClass(activeClass);
        $target.addClass(activeClass);
    }

    function attachListeners() {
        $('body').on('click', '.tabbed .tabs a', function (e) {
            var $link = $(this);
            var $container = $link.parents('.tabbed');
            var tabName = $link.attr('href').replace('#', '');
//            e.preventDefault();
            switchTab($container, tabName);
        });
    }

    function goToHash() {
        var hash = location.hash;
        var $container = $('a[href="' + hash + '"]').parents('.tabbed');
        switchTab($container, hash.replace('#', ''));
    }

    function init() {
        attachListeners();
        goToHash();
    }

    $(init);
}());