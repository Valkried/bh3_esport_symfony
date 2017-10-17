$(function() {

    $('.button-collapse').sideNav();
    $('.modal').modal();

    // Textarea Auto Resize
    var hiddenDiv = $('.hiddendiv').first();
    if (!hiddenDiv.length) {
        hiddenDiv = $('<div class="hiddendiv common"></div>');
        $('body').append(hiddenDiv);
    }
    var text_area_selector = '.materialize-textarea';

    function textareaAutoResize($textarea) {
        // Set font properties of hiddenDiv

        var fontFamily = $textarea.css('font-family');
        var fontSize = $textarea.css('font-size');
        var lineHeight = $textarea.css('line-height');
        var padding = $textarea.css('padding');

        if (fontSize) {
        hiddenDiv.css('font-size', fontSize);
        }
        if (fontFamily) {
        hiddenDiv.css('font-family', fontFamily);
        }
        if (lineHeight) {
        hiddenDiv.css('line-height', lineHeight);
        }
        if (padding) {
        hiddenDiv.css('padding', padding);
        }

        // Set original-height, if none
        if (!$textarea.data('original-height')) {
        $textarea.data('original-height', $textarea.height());
        }

        if ($textarea.attr('wrap') === 'off') {
        hiddenDiv.css('overflow-wrap', 'normal').css('white-space', 'pre');
        }

        hiddenDiv.text($textarea.val() + '\n');
        var content = hiddenDiv.html().replace(/\n/g, '<br>');
        hiddenDiv.html(content);

        // When textarea is hidden, width goes crazy.
        // Approximate with half of window size

        if ($textarea.is(':visible')) {
        hiddenDiv.css('width', $textarea.width());
        } else {
        hiddenDiv.css('width', $(window).width() / 2);
        }

        /**
         * Resize if the new height is greater than the
         * original height of the textarea
         */
        if ($textarea.data('original-height') <= hiddenDiv.height()) {
        $textarea.css('height', hiddenDiv.height());
        } else if ($textarea.val().length < $textarea.data('previous-length')) {
        /**
         * In case the new height is less than original height, it
         * means the textarea has less text than before
         * So we set the height to the original one
         */
        $textarea.css('height', $textarea.data('original-height'));
        }
        $textarea.data('previous-length', $textarea.val().length);
    }

    $(text_area_selector).each(function () {
        var $textarea = $(this);
        /**
         * Instead of resizing textarea on document load,
         * store the original height and the original length
         */
        $textarea.data('original-height', $textarea.height());
        $textarea.data('previous-length', $textarea.val().length);
    });

    $('body').on('keyup keydown click autoresize', text_area_selector, function () {
        textareaAutoResize($(this));
    });

});