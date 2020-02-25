<div id="cookies-eu-banner" style="display: none;">
    <div class="container">
        <?= $site->cookie_banner_text() ?>
        <?php if ($site->cookie_banner_reject()->isNotEmpty()) : ?>
            <button id="cookies-eu-reject"><?= $site->cookie_banner_reject() ?></button>
        <?php endif; ?>
        <button id="cookies-eu-accept"><?= $site->cookie_banner_accept() ?></button>
    </div>
</div>
