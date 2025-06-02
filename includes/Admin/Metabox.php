<?php 

namespace TaxonomyBannerSlider\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class Metabox{

    
    var $taxonomy;

    /**
     * The constructor for the Metabox class.
     *
     * This constructor initializes the class and sets up the necessary properties.
     *
     * @since 1.0.0
     */
    
    public function __construct() {
        $this->taxonomy = 'product_cat';
        add_action( $this->taxonomy.'_add_form_fields', array( $this, 'wp_dwtbs_render_product_cat_add_meta_box' ), 20, 1);
        add_action( $this->taxonomy.'_edit_form_fields', array( $this, 'wp_dwtbs_render_product_cat_edit_meta_box' ), 20, 1);
        add_action('created_'.$this->taxonomy, array( $this, 'wp_dwtbs_save_product_cat_banner' ), 20, 1);
        add_action('edited_'.$this->taxonomy, array( $this, 'wp_dwtbs_save_product_cat_banner' ), 20, 1);
    }

    public function wp_dwtbs_render_product_cat_add_meta_box( $term ) {
        ?>
        <div class="form-field term-banner-thumbnail-wrap">
            <label for="dwtbs_banner_slider"><?php esc_html_e( 'Banner Images', 'taxonomy-banner-slider' ); ?></label>
            <div class="banner-slider-container">
                <div class="banner-slider-item">
                    <div class="product_cat_thumbnail" style="float: left; margin-right: 10px;">
                        <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" width="60px" height="60px">
                    </div>
                    <div style="line-height: 60px;">
                        <input type="hidden" class="image_attachment_id" name="dwtbs_banner_slider[]">
                        <button type="button" class="button upload_image_button"><?php esc_html_e('Upload/Add image', 'taxonomy-banner-slider'); ?></button>
                        <button type="button" class="button remove_image_button" style="display: none;"><?php esc_html_e('Remove image', 'taxonomy-banner-slider'); ?></button>
                    </div>
                </div>
            </div>
            <div class="clear" style="margin-top:10px;"></div>
            <button type="button" class="button new_image_button"><span class="dashicons dashicons-insert"></span><?php esc_html_e( 'Add New', 'taxonomy-banner-slider' ); ?></button>
        </div>
        <?php
    }

    public function wp_dwtbs_render_product_cat_edit_meta_box( $term ) {
        $term_id = $term->term_id;
        $banner_sliders = get_term_meta($term_id, 'dwtbs_banner_slider', false);
        $banner_sliders = !empty($banner_sliders) ? $banner_sliders : array('');
        ?>
        <tr class="form-field term-banner-thumbnail-wrap">
            <th scope="row" valign="top"><label for="dwtbs_banner_slider"><?php esc_html_e( 'Banner Images', 'taxonomy-banner-slider' ); ?></label></th>
            <td>
                <div class="banner-slider-container">
                    <?php foreach ($banner_sliders as $index => $banner_slider): ?>
                        <div class="banner-slider-item">
                            <div class="product_cat_thumbnail" style="float: left; margin-right: 10px;">
                                <img src="<?php echo $banner_slider ? wp_get_attachment_image_url($banner_slider, 'thumbnail') : esc_url(wc_placeholder_img_src()); ?>" width="60px" height="60px">
                            </div>
                            <div style="line-height: 60px;">
                                <input type="hidden" class="image_attachment_id" name="dwtbs_banner_slider[]" value="<?php echo esc_attr($banner_slider); ?>">
                                <button type="button" class="button upload_image_button"><?php esc_html_e('Upload/Add image', 'taxonomy-banner-slider'); ?></button>
                                <button type="button" class="button remove_image_button" <?php echo empty($banner_slider) ? 'style="display: none;"' : ''; ?>><?php esc_html_e('Remove image', 'taxonomy-banner-slider'); ?></button>
                                <?php if ($index > 0): ?>
                                    <button type="button" class="button remove_banner_button"><span class="dashicons dashicons-trash"></span></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>		
                <div class="clear" style="margin-top:10px;"></div>
                <button type="button" class="button new_image_button"><span class="dashicons dashicons-insert"></span><?php esc_html_e( 'Add New', 'taxonomy-banner-slider' ); ?></button>
            </td>
        </tr>
        <?php
    }   

    public function wp_dwtbs_save_product_cat_banner($term_id) {
        if (isset($_POST['dwtbs_banner_slider'])) {
            // Delete all existing meta first
            delete_term_meta($term_id, 'dwtbs_banner_slider');
            
            // Save each banner image
            foreach ($_POST['dwtbs_banner_slider'] as $banner_slider) {
                if (!empty($banner_slider)) {
                    add_term_meta($term_id, 'dwtbs_banner_slider', sanitize_text_field($banner_slider));
                }
            }
        }
    }

}