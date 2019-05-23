(function ($, undefined) {
    $.widget('ux.PasswordMeter', {
        vars: {
            passwordBoxId: '',
            strength: 0,
            symbols: ['~', '`', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '+', '=', '|', '\\', '[', '{', ']', '}', ':', ';', '\'', '"', ',', '<', '.', '>', '/', '?'],
            alphaCount: 0,
            numberCount: 0,
            symbolCount: 0,
            length: 0
        },
        options: {
            color0: '#e2e2e2',
            color25: '#ff6a00',
            color50: '#f7d722',
            color75: '#b6ff00',
            color100: '#6bc246',
            color10: '#ff0000'
        },
        _create: function () {
            this.vars.passwordBoxId = $(this.element).attr('id');
            this._setKeyPressEvent();
        },
        _init: function () {
        },
        _destroy: function () {
        },
        _setKeyPressEvent: function () {
            var that = this;
            var id = that.vars.passwordBoxId;
            $('#' + id + ' input[type=password]').on('keyup', function () {
                that.vars.passwordBoxId = id;
                var password = $(this).val();
                that._validatePassword(password);
            });
        },
        _validatePassword: function (password) {
            var that = this;
            that._clearVars();
            that.vars.length = password.length;

            var regExpAlpha = /[a-z]/;
            var regExpAlphaCaps = /[A-Z]/;
            var regExpNum = /[0-9]/;
            var isValid = false;
            for (var i = 0; i < password.length; i++) {
                var current = password.charAt(i);
                isValid = regExpAlpha.test(current);
                if (isValid) {
                    that.vars.alphaCount++;
                }
                isValid = regExpAlphaCaps.test(current);
                if (isValid) {
                    that.vars.alphaCapsCount++;
                }
                isValid = regExpNum.test(current);
                if (isValid) {
                    that.vars.numberCount++;
                }
                if ($.inArray(current, that.vars.symbols) != -1) {
                    that.vars.symbolCount++;
                }
            }

            if (that.vars.alphaCount >= 1) {
                that.vars.strength += 5 * that.vars.alphaCount;
            }
            if (password.length >= 8)
            	{
		            if (that.vars.alphaCapsCount >= 1 && that.vars.alphaCapsCount <= 5) {
		                that.vars.strength += 10 * that.vars.alphaCapsCount;
		            }
		            if (that.vars.numberCount >= 1) {
		                that.vars.strength += 5 * that.vars.numberCount;
		            }
		            if (that.vars.symbolCount >= 1 && that.vars.symbolCount <= 5) {
		                that.vars.strength += 15 * that.vars.symbolCount;
		            }
		            if (that.vars.numberCount >= 1 && that.vars.alphaCount >= 1) {
		            	that.vars.strength += 10
		            }
            	}


            that._setClasses();
        },
        _setClasses: function () {
            var that = this;
            var color = '#e2e2e2';

            color = that.options.color0;
            if (that.vars.strength <= 10)
            	color = that.options.color10;
            if (that.vars.strength > 10 && that.vars.strength <= 25)
            	color = that.options.color25;
            if (that.vars.strength > 25 && that.vars.strength <= 50)
            	color = that.options.color50;
            if (that.vars.strength > 50 && that.vars.strength <= 75)
            	color = that.options.color75;
            if (that.vars.strength > 75 )
            	color = that.options.color100;
            var id = $('#' + that.vars.passwordBoxId).attr('id');
            $('#' + id + ' .password-strength').css({
                width: that.vars.strength + '%',
                backgroundColor: color
            });
        },
        _clearVars: function () {
            var that = this;
            that.vars.strength = 0;
            that.vars.alphaCount = 0;
            that.vars.alphaCapsCount = 0;
            that.vars.numberCount = 0;
            that.vars.symbolCount = 0;
            that.vars.length = 0;
        }
    });
})(jQuery);
