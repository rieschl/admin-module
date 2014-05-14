/*global jQuery*/

var Midnight = Midnight || {};
Midnight.UI = Midnight.UI || {};
Midnight.UI.Dialog = (function ($) {
    var dialogs = [];

    /**
     * @param {string} html
     * @param {{modal: boolean, addClass: boolean|string}} options
     * @constructor
     *
     * Options:
     * - modal: Prevent the user from closing the dialog? (Default: false)
     * - addClass: add a Class to the Dialog tag (Default: false)
     * - close: Callback function for when the dialog is closed
     */
    function Dialog(html, options) {
        var that;

        if(!(this instanceof Dialog)) {
            throw new Error('Dialog was called directly. You must use \'new Dialog()\'.');
        }

        if (!options) {
            options = { modal: false, addClass: false };
        }

        if (!options.modal) {
            options.modal = false;
        }

        if (!options.addClass) {
            options.addClass = false;
        }

        if (options.close) {
            this.closeCallback = options.close;
        }

        that = this;
        this.$backdrop = $('<div class="dialog-backdrop"></div>')
            .on('click', function () {
                if (!$(this).is('.modal')) {
                    that.close();
                }
            });
        if (options.modal) {
            this.$backdrop.addClass('modal');
        }
        this.$dialog = $('<div class="dialog"></div>')
            .on('click', function (e) {
                e.stopPropagation();
            })
            .appendTo(this.$backdrop);
        this.$dialog.html(html);
        $('<button class="close">Schließen</button>')
            .on('click', function () {
                that.close();
            })
            .appendTo(this.$dialog);

        if (options.addClass) {
            this.$dialog.addClass(options.addClass);
        }

        this.$backdrop.appendTo('body');
        dialogs.push(this);
    }

    Dialog.prototype.close = function () {
        this.$backdrop.remove();
        dialogs.slice(dialogs.indexOf(this), 1);
        this.closeCallback && this.closeCallback();
    };

    function closeAll() {
        dialogs.forEach(function (dialog) {
            dialog.close();
        });
    }

    function init() {
        $('body').on('keyup', function (e) {
            if (e.which === 27) { // Escape
                closeAll();
            }
        });
    }

    $(init);

    return Dialog;
}(jQuery));
