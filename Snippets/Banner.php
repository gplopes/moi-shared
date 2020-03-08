<?php
$background = isset($bg) ? $bg : '';
$class = isset($name) ? $name : '';
$is_grid = isset($grid) && $grid;
$is_moving = isset($bg_move) && $bg_move;
?>
<section class="hero" role="banner">
    <div class="container_ hero-container">
        <div class="hero-bg <?= $class ?>">
            <!-- Hero Clean Container -->
            <?php if (isset($clean) && $clean) : ?>
                <div class="hero-title <?php e($is_grid, "hero-title-grid") ?>">
                    <div class="container">
                        <h1><?= $page->hero_title()->or($page->banner_title()) ?></h1>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Hero Box -->
            <?php if (isset($box) && $box) : ?>
                <div class="container">
                    <div class="content">
                        <div class="hero-card"><?= $content ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Hero Grid -->
            <?php if ($is_grid) : ?>
                <div class="hero-grid hero-overlay">
                    <?php foreach ($page->hero_images()->toFiles() as $img) : ?>
                        <div class="hero-grid-img" style="background-image: url(<?= $img->url() ?>)"></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($background) : ?>
                <div class="hero-fixed-bg hero-overlay <?php e($is_moving, "jsBgMove") ?>" style="background-image: url(<?= $background ?>)"></div>
            <?php endif; ?>
        </div>
    </div>
</section>
