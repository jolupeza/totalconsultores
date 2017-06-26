<?php
/**
 * Displays the user interface for the TC Manager meta box by type content Sliders.
 *
 * This is a partial template that is included by the TC Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-sliders-id">

    <?php
        $values = get_post_custom( get_the_ID() );
        $responsive = isset( $values['mb_responsive'] ) ? esc_attr($values['mb_responsive'][0]) : '';
//        $carrera = isset($values['mb_carrera']) ? esc_attr($values['mb_carrera'][0]) : '';
        $title = isset($values['mb_title']) ? esc_attr($values['mb_title'][0]) : '';
        $subtitle = isset($values['mb_subtitle']) ? esc_attr($values['mb_subtitle'][0]) : '';
        $url = isset($values['mb_url']) ? esc_attr($values['mb_url'][0]) : '';
        $text = isset($values['mb_text']) ? esc_attr($values['mb_text'][0]) : '';
        $target = isset($values['mb_target']) ? esc_attr($values['mb_target'][0]) : '';

        wp_nonce_field( 'sliders_meta_box_nonce', 'meta_box_nonce' );
    ?>
    
    <!-- Texto superior -->
    <p class="content-mb">
        <label for="mb_subtitle">Texto superior: </label>
        <input type="text" name="mb_subtitle" id="mb_subtitle" value="<?php echo $subtitle; ?>" />
    </p>
    
    <!-- Texto inferior -->
    <p class="content-mb">
        <label for="mb_title">Texto inferior: </label>
        <input type="text" name="mb_title" id="mb_title" value="<?php echo $title; ?>" />
    </p>
    
    <!-- Texto enlace-->
    <p class="content-mb">
        <label for="mb_text">Texto enlace: </label>
        <input type="text" name="mb_text" id="mb_text" value="<?php echo $text; ?>" />
    </p>
    
    <!-- URL-->
    <p class="content-mb">
        <label for="mb_url">Url: </label>
        <input type="text" name="mb_url" id="mb_url" value="<?php echo $url; ?>" />
    </p>
    
    <!-- Target-->
    <p class="content-mb">
        <label for="mb_target">Mostrar en otra pestaña:</label>
        <input type="checkbox" name="mb_target" id="mb_target" <?php checked($target, 'on'); ?> />
    </p>
    
<?php /*
    <p class="content-mb">
        <label for="mb_url">Seleccionar Carrera</label>
        <select name="mb_carrera" id="mb_carrera">
            <option value="" <?php selected($carrera, ''); ?>>-- Seleccione carrera --</option>

        <?php
            $args = array(
                'post_type' => 'carreras',
                'posts_per_page' => -1
            );
            $carreras = new WP_Query($args);
            if ($carreras->have_posts()) :
                while ($carreras->have_posts()) :
                    $carreras->the_post();
                    $id = get_the_ID();
        ?>
            <option value="<?php echo $id; ?>" <?php selected($carrera, $id); ?>><?php the_title(); ?></option>
        <?php
                endwhile;
            endif;
            wp_reset_postdata();
        ?>

        </select>
    </p>
 */ ?>
    <fieldset class="GroupForm">
        <legend class="GroupForm-legend">Imagen Responsive</legend>

        <div class="container-upload-file GroupForm-wrapperImage">
            <p class="btn-add-file">
                <a title="Set Slider Image" href="javascript:;" class="set-file button button-primary">Añadir</a>
            </p>

            <div class="hidden media-container">
                <img src="<?php echo $responsive; ?>" alt="<?php //echo get_post_meta( $post->ID, 'slider-1-alt', true ); ?>" title="<?php //echo get_post_meta( $post->ID, 'slider-1-title', true ); ?>" />
            </div><!-- .media-container -->

            <p class="hidden">
                <a title="Qutar imagen" href="javascript:;" class="remove-file button button-secondary">Quitar</a>
            </p>

            <p class="media-info">
                <input class="hd-src" type="hidden" name="mb_responsive" value="<?php echo $responsive; ?>" />
            </p>
        </div>

    </fieldset>
</div><!-- #single-post-meta-manager -->