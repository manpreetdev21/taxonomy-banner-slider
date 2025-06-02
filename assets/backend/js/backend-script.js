jQuery(document).ready(function($) {

    // Define placeholder image URL
    var wc_placeholder_img_src = taxonomy_banner_slider_vars.placeholder_url;

    // Add new banner item
    $('.add_new_banner_button').on('click', function() {
        var $container = $(this).siblings('.banner-slider-container');
        var $clone = $container.find('.banner-slider-item').first().clone();
        
        // Clear values in the clone
        $clone.find('.image_attachment_id').val('');
        $clone.find('img').attr('src', wc_placeholder_img_src);
        $clone.find('.remove_image_button').hide();
        $clone.find('.remove_banner_button').remove();
        
        // Add remove button for the new item
        $clone.append('<button type="button" class="button remove_banner_button"><span class="dashicons dashicons-trash"></span></button>');
        
        $container.append($clone);
    });
    
    // Remove banner item
    $(document).on('click', '.remove_banner_button', function() {
        $(this).closest('.banner-slider-item').remove();
    });
    
    // Image upload
    $(document).on('click', '.upload_image_button', function(e) {
        e.preventDefault();
        var $button = $(this);
        var $input = $button.siblings('.image_attachment_id');
        var $img = $button.closest('.banner-slider-item').find('img');
        
        var frame = wp.media({
            title: 'Select or Upload Banner Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });
        
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            $input.val(attachment.id);
            $img.attr('src', attachment.sizes.thumbnail.url);
            $button.siblings('.remove_image_button').show();
        });
        
        frame.open();
    });
    
    // Image remove
    $(document).on('click', '.remove_image_button', function(e) {
        e.preventDefault();
        var $button = $(this);
        var $input = $button.siblings('.image_attachment_id');
        var $img = $button.closest('.banner-slider-item').find('img');
        
        $input.val('');
        $img.attr('src', wc_placeholder_img_src);
        $button.hide();
    });
});