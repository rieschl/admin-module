(function ($) {
    'use strict';

    var Tabs;

    Tabs = (function () {
        function Tabs($container) {
            this.$container = $container;
            this.init();
        }

        Tabs.prototype.init = function () {
            var that;
            that = this;
            this.$container.children('ul').on('click', 'a', function(e) {
                e.preventDefault();
                that.go($(this).attr('href').substr(1));
            });
            this.go(this.getFirst());
        };

        Tabs.prototype.closeAll = function () {
            this.$container.children('article').removeClass('active');
            this.$container.children('ul').find('li').removeClass('active');
        };

        Tabs.prototype.go = function (tab) {
            this.closeAll();
            this.$container.find('[id=' + tab + ']').next().addClass('active');
            this.$container.find('[href=#' + tab + ']').parents('li').addClass('active');
        };

        /**
         * Returns the key of the first tab
         *
         * @returns {string}
         */
        Tabs.prototype.getFirst = function () {
            return this.$container.find('ul a').attr('href').substr(1);
        };

        return Tabs;
    }());

    function init() {
        $('.admin-tabs').each(function () {
            var $container;
            $container = $(this);
            new Tabs($container);
        });
    }

    $(init);
}(jQuery));
