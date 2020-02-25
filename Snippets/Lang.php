<div class="nav-lang">
    <div class="active-lang js-lang" role="button">
        <img src="<?= url('assets/img/flag-' . $kirby->language()->code() . '.svg') ?>" alt="flag">
    </div>
    <ul class="nav-lang-more">
        <?php foreach ($kirby->languages() as $language) : ?>
            <?php if ($kirby->language() != $language) : ?>
                <li>
                    <a href="<?= $page->url($language->code()) ?>">
                        <span><?= html($language->name()) ?></span>
                        <img class="jsLazy" data-src="<?= url('assets/img/flag-' . $language->code() . '.svg') ?>" role="presentation" aria-hidden="true" alt="flag">
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
