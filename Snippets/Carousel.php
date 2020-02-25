<?php
$class = isset($name) ? $name : '';
?>

<section class="hero" role="banner">
  <div class="hero-container">
    <div class="js-slider <?= $class ?>">
      <?php $slides = $page->hero_slider()->toStructure() ?>

      <?php foreach ($slides as $slide) : ?>
        <?php $pic = $slide->picture()->toFile(); ?>

        <?php if ($pic) : $type = $pic->type(); ?>
          <?php if ($type === "image") : ?>
            <div class="slider-item">
              <div class="hero-title">
                <div class="container">
                  <h1><?= $slide->title(); ?></h1>
                </div>
              </div>
              <div class="hero-fixed-bg hero-overlay" style="background-image: url(<?= $pic->url() ?>)"></div>

            </div>
          <?php endif; ?>
          <?php if ($type === "video") : ?>
            <div class="slider-item">
              <div class="hero-title">
                <div class="container">
                  <h1><?= $slide->title(); ?></h1>
                </div>
              </div>
              <video class="slider-video" muted loop playsinline autoplay src="<?= $pic->url() ?>">
            </div>
          <?php endif; ?>

        <?php endif; ?>
      <?php endforeach; ?>
    </div>

  </div>
</section>