<?php
/**
 * 
 * Template part for displaying profile component
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-indigo
 * 
 */
?>

<div class="c-profile">
    
    <?php if ( true == get_theme_mod( 'profile_image', true ) && has_custom_logo()) : ?>
        <div class="c-profile__image">
            <?php wp_indigo_show_avatar(); ?>
        </div>
    <?php endif; ?>

    <div class="c-profile__title">
        <a class="c-profile__title__link h1" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php bloginfo( 'name' ); ?>
        </a>
    </div>

    <div class="c-profile__desc">
        <?php wp_indigo_show_description(); ?>
    </div>
    
</div>


