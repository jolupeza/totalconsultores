<?php
/**
 * Displays the user interface for the TC Manager meta box by type content Parallaxs.
 *
 * This is a partial template that is included by the TC Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-parallaxs-id">

    <?php
        $values = get_post_custom( get_the_ID() );
        $title = isset($values['mb_title']) ? esc_attr($values['mb_title'][0]) : '';
        $subtitle = isset($values['mb_subtitle']) ? esc_attr($values['mb_subtitle'][0]) : '';
        $legend = isset($values['mb_legend']) ? esc_attr($values['mb_legend'][0]) : '';

        wp_nonce_field( 'parallaxs_meta_box_nonce', 'meta_box_nonce' );
    ?>
    
    <!-- Title -->
    <p class="content-mb">
        <label for="mb_title">Título: </label>
        <input type="text" name="mb_title" id="mb_title" value="<?php echo $title; ?>" />
    </p>
    
    <!-- SubTitle -->
    <p class="content-mb">
        <label for="mb_subtitle">SubTítulo: </label>
        <input type="text" name="mb_subtitle" id="mb_subtitle" value="<?php echo $subtitle; ?>" />
    </p>
    
    <!-- Legend -->
    <p class="content-mb">
        <label for="mb_legend">Leyenda: </label>
        <input type="text" name="mb_legend" id="mb_legend" value="<?php echo $legend; ?>" />
    </p>
</div><!-- #mb-locals-id -->