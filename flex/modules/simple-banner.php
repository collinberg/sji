<?php $image = get_sub_field( 'image' ); ?>
<?php $alt_mobile_image = get_sub_field( 'alt_mobile_image' ); ?>

<div class="simple-banner <?php the_sub_field('width'); ?> <?php the_sub_field('padding'); ?>">
    <?php if ( $image ) : ?>
    <img class="simple-banner__img <?php if ( $alt_mobile_image ) : ?>d-none d-lg-block<?php endif;?>"
        src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
    <?php endif; ?>
    <?php if ( $alt_mobile_image ) : ?>
    <img class="simple-banner__img d-block d-lg-none" src="<?php echo esc_url( $alt_mobile_image['url'] ); ?>"
        alt="<?php echo esc_attr( $alt_mobile_image['alt'] ); ?>" />
    <?php endif; ?>
</div>