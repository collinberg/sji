<?php
//The default Archive template
get_header();
?>

<main class="global-main">

    <div class="hero">
        <div class="container">
            <h1><?php echo sji_title();?></h1>
        </div>
    </div>

    <?php 
    if ( have_posts() ) : ?>
        <section class="blog-grid bg-color__gray">
            <div class="container">
                <div class="blog-grid__grid js-item-container">
                    <?php while (have_posts() ) : the_post(); ?>
                        <article class="blog-grid__item js_filter_item">
                            <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                                <figure>
                                    <?php the_post_thumbnail(); ?>
                                </figure>
                            </a>
                            <div class="blog-grid__item-content">
                                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                                    <span class="blog-grid__item-author"><?php the_author(); ?></span>
                                    <h3><?php the_title(); ?></h3>
                                    <?php the_category(); ?>
                                    <?php the_excerpt(); ?>
                                    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>"><button class="btn btn--asterisk">Read More</button></a>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>



    <?php else : 
        get_template_part( 'includes/no-posts'); 
    endif;?>

</main><!-- #main -->

<?php
get_footer();