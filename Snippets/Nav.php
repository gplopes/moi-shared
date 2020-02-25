<button class="mobile--menu js-burger" aria-label="Menu"><span></span></button>

<nav class="nav-header">
  <ul class="nav-list main-nav js-menu">
    <?php foreach ($pages->listed() as $item) : ?>
      <?php $sub_menu = $item->sub_menu()->yaml() ?>
      <li <?php e($item->isHomePage(), ' class="nav-home-page"') ?>>
        <a onclick="return gtag_report_conversion('<?= $item->url() ?>');" class="<?php e($item->isOpen(), 'active') ?>" href="<?= $item->url() ?>">
          <?= $item->title()->html() ?>
        </a>

      </li>
    <?php endforeach; ?>
  </ul>
</nav>

<a onclick="return gtag_report_conversion('<?= $site->homePage()->url() ?>');" href="<?= $site->homePage()->url() ?>">
  <img class="nav-logo-img mobile" role="presentation" src="<?= $logo_mobile ?>" alt="<?= $logo_alt ?>" />
</a>