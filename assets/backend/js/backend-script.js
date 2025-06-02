jQuery(document).ready(function($) {
    // Ensure WooCommerce placeholder is available
    var placeholder_img = typeof taxonomy_banner_slider_vars !== 'undefined' ? 
        taxonomy_banner_slider_vars.placeholder_url : 
        '<?php echo esc_js(wc_placeholder_img_src()); ?>';

    // Add new banner
    $(document).on('click', '#dwtbs-add-banner', function() {
        var $container = $('#dwtbs-banner-container');
        var $firstItem = $container.find('.banner-slider-item').first();
        
        if ($firstItem.length) {
            var $clone = $firstItem.clone();
            $clone.find('.image_attachment_id').val('');
            $clone.find('img').attr('src', placeholder_img);
            $clone.find('.button_remove_image_button').hide();
            $clone.find('.button_remove_banner_button').remove();
            $clone.append('<button type="button" class="button button_remove_banner_button"><span class="dashicons dashicons-trash"></span></button>');
            $container.append($clone);
        }
    });

    // Remove banner
    $(document).on('click', '.button_remove_banner_button', function() {
        $(this).closest('.banner-slider-item').remove();
    });

    // Image upload
    $(document).on('click', '.button_upload_image_button', function(e) {
        e.preventDefault();
        var $button = $(this);
        var $input = $button.siblings('.image_attachment_id');
        var $img = $button.closest('.banner-slider-item').find('img');

        // Create media frame
        var frame = wp.media({
            title: 'Select or Upload Banner Image',
            button: { text: 'Use this image' },
            multiple: false
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            $input.val(attachment.id);
            $img.attr('src', attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url);
            $button.siblings('.button_remove_image_button').show();
        });

        frame.open();
    });

    // Image remove
    $(document).on('click', '.button_remove_image_button', function(e) {
        e.preventDefault();
        var $button = $(this);
        $button.siblings('.image_attachment_id').val('');
        $button.closest('.banner-slider-item').find('img').attr('src', placeholder_img);
        $button.hide();
    });
});