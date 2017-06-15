<?php
/**
 * Displays the user interface for the TC Manager meta box by type content Projects.
 *
 * This is a partial template that is included by the TC Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-projects-id">

    <?php
        $values = get_post_custom( get_the_ID() );
        $gallery = isset($values['mb_gallery']) ? $values['mb_gallery'][0] : '';

        wp_nonce_field('projects_meta_box_nonce', 'meta_box_nonce');
    ?>
    
    <fieldset>
        <legend>Galería</legend>
        <?php
            $totalGallery = 8;
            $countGallery = 0;
            
            if (!empty($gallery)) :
                $gallery = unserialize($gallery);
                $countGallery = count($gallery);

                foreach ($gallery as $img) :
        ?>

            <div class="container-upload-file GroupForm-wrapperImage">
                <p class="btn-add-file">
                    <a title="Set Slider Image" href="javascript:;" class="set-file button button-primary">Añadir</a>
                </p>

                <div class="hidden media-container">
                    <img src="<?php echo $img; ?>" alt="<?php //echo get_post_meta( $post->ID, 'slider-1-alt', true ); ?>" title="<?php //echo get_post_meta( $post->ID, 'slider-1-title', true ); ?>" />
                </div><!-- .media-container -->

                <p class="hidden">
                    <a title="Qutar imagen" href="javascript:;" class="remove-file button button-secondary">Quitar</a>
                </p>

                <p class="media-info">
                    <input class="hd-src" type="hidden" name="mb_gallery[]" value="<?php echo $img; ?>" />
                </p><!-- .media-info -->
            </div><!-- end container-upload-file -->

        <?php 
                endforeach;
            endif; 
            
            if ($countGallery < $totalGallery) : 
                for ($i = 0; $i < ($totalGallery - $countGallery); ++$i) : 
        ?>
            <div class="container-upload-file GroupForm-wrapperImage">
                <p class="btn-add-file">
                    <a title="Set Slider Image" href="javascript:;" class="set-file button button-primary">Añadir</a>
                </p>

                <div class="hidden media-container">
                    <img src="" />
                </div><!-- .media-container -->

                <p class="hidden">
                    <a title="Remove Footer Image" href="javascript:;" class="remove-file button button-secondary">Quitar</a>
                </p>

                <p class="media-info">
                    <input class="hd-src" type="hidden" name="mb_gallery[]" value="" />
                </p><!-- .media-info -->
            </div><!-- end container-upload-file -->

        <?php 
                endfor;
            endif;
        ?>
    </fieldset>
</div><!-- #single-post-meta-manager -->