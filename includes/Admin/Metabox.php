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
        //var_dump( $term->term_id );
        $term_id = $term->term_id;
        $banner_slider = get_term_meta( $term_id, 'dwtbs_banner_slider', true );
        ?>
        <div class="form-field term-group"></div>
        <table>
            <tr class="form-field term-banner-thumbnail-wrap">
                <td>
                    <label for="dwtbs_banner_slider"><?php esc_html_e( 'Banner Slider', 'taxonomy-banner-slider' ); ?></label>
                </td>
                <td>
                    <div class="form-field term-group">
                        <input type="hidden" id="product_cat_image" name="product_cat_image" class="image_attachment_id" value="">
                        <div id="product_cat_image_preview" style="min-height: 100px; margin: 10px 0; border: 2px dashed #ddd;"></div>
                        <input type="button" class="button upload_image_button" value="<?php _e('Upload Image', 'text-domain'); ?>">
                        <input type="button" class="button remove_image_button" value="<?php _e('Remove Image', 'text-domain'); ?>" style="display: none;">
                    </div>
                </td>
            </tr>
        </table>
        <?php
    }

    public function wp_dwtbs_render_product_cat_edit_meta_box( $term ) {
        $term_id = $term->term_id;
        $banner_slider = get_term_meta( $term_id, 'dwtbs_banner_slider', true );
        ?>
        <div class="form-field term-group"></div>
            <table>
                <tr class="form-field term-banner-thumbnail-wrap">
                    <td>
                        <label for="dwtbs_banner_slider"><?php esc_html_e( 'Banner Slider', 'taxonomy-banner-slider' ); ?></label>
                    </td>
                    <td>
                        <div class="form-field term-group">
                            <input type="hidden" id="product_cat_image" name="product_cat_image" class="image_attachment_id" value="">
                            <div id="product_cat_image_preview" style="min-height: 100px; margin: 10px 0; border: 2px dashed #ddd;"></div>
                            <input type="button" class="button upload_image_button" value="<?php _e('Upload Image', 'text-domain'); ?>">
                            <input type="button" class="button remove_image_button" value="<?php _e('Remove Image', 'text-domain'); ?>" style="display: none;">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php
    }   

    public function wp_dwtbs_save_product_cat_banner( $term_id ) {
        if ( isset( $_POST['product_cat_image'] ) ) {
            $banner_slider = sanitize_text_field( $_POST['product_cat_image'] );
            update_term_meta( $term_id, 'dwtbs_banner_slider', $banner_slider );
        }
    }

}