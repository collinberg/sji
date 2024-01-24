<?php
//The default post template
get_header();
$author_id = $post->post_author;
$author_title = get_field('title', 'user_'. $author_id );
?>

<main class="global-main">
    <div class="hero hero--single">
        <div class="container">
        <?php if(get_field('title')): ?>
            <?= the_field('title') ?>
        <?php else: ?>
            <h1><?php the_title(); ?></h1>
        <?php endif; ?>
            <div class="post__author">
                <?= get_avatar($author_id, 79); ?>
                <div class="post__author-info">
                    <div class="post__author-name"><?= get_the_author_meta('display_name', $author_id); ?></div>
                    <span><?= $author_title; ?></span>
                </div>
            </div>
        </div>
    </div>

    <?php if (get_the_content()) : ?>
        <div class="post-content">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (have_rows('modular_content')) : ?>
        <div class="container post__container">
            <div class="row post-content">
                <div class="col-sm-8 offset-sm-2">
                    <?php include get_theme_file_path('flex/modular-content.php'); ?>
                </div>
            </div>  <!-- row -->
        </div> <!-- container -->
        <section class="row">
            <div class="col-12">
                <?php include get_theme_file_path('flex/modules/latest-insights.php'); ?>
            </div>
        </section> <!-- row -->
    <? endif; ?>

    <?php get_template_part('includes/footer-cta'); ?>
</main>

<?php get_footer(); ?>