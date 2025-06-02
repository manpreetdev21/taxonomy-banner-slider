<?php $term_page_id = $this->term_page_id; $dynamic_slider = $this->meta_data;?>
<?php if( !empty( $dynamic_slider ) ):?>
<div id="carouselExample<?php echo $term_page_id;?>" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $i = 1;
        foreach( $dynamic_slider as $key => $data ):
        $img_src = wp_get_attachment_url( $data, 'full' );?>
            <div class="carousel-item <?php echo $i == 1 ? 'active' : '' ?>">
                <img src="<?php echo $img_src;?>" class="d-block w-100" alt="img_<?php echo $i.' '.$term_page_id;?>">                
            </div>
        <?php $i++;
        endforeach;?>
    </div>
    <?php if( ( !empty( $dynamic_slider ) ) && ( count( $dynamic_slider ) > 1 ) ):?>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample<?php echo $term_page_id;?>" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample<?php echo $term_page_id;?>" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    <?php endif;?>
</div>
<?php endif;?>