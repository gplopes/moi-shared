<?php
$class = isset($name) ? $name : '';

?>
<section class="hero" role="banner">
    <div class="hero-container">
        <?php $interval = $page->slide_interval()->or(7000); ?>
        <div class="js-slider <?= $class ?>" data-interval="<?= $interval ?>">
            <?php $slides = $page->hero_slider()->toStructure() ?>

            <?php foreach ($slides as $slide) : ?>
                <?php $pic = $slide->picture()->toFile(); ?>
                <?php if ($pic) : $type = $pic->type(); ?>
                    <div class="slider-item">
                        <div class="hero-title">
                            <div class="container">
                                <h1><?= $slide->title(); ?></h1>
                                <?php if (!$slide->cta_link()->isEmpty()) : ?>
                                    <?php $url = $slide->cta_link()->first()->toPage()->url(); ?>
                                    <a onclick="return gtag_report_conversion(<?= $url ?>);" href="<?= $url ?>" class="button button-primary">
                                        <?= $slide->cta_name() ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($type === "image") : ?>
                            <div class="hero-fixed-bg hero-overlay" style="background-image: url(<?= $pic->url() ?>)"></div>
                        <?php else : ?>
                            <video class="slider-video" muted loop playsinline autoplay src="<?= $pic->url() ?>">
                            <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>
</section>
