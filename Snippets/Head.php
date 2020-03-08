<title><?= $site->title() ?> | <?= $page->seoTitle() ?></title>
<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
<meta charset="utf-8">
<meta name="msapplication-TileColor" content="#2d89ef">
<meta name="theme-color" content="#ffffff">

<!-- Meta -->
<meta name="description" content="<?= $page->seoDescription()->toString(); ?>">
<meta property="og:title" content="<?= $site->og_title()->html() ?>">
<meta property="og:site_name" content="<?= $site->og_site_name()->html() ?>">
<meta property="og:type" content="website">
<meta property="og:description" content="<?= $site->og_description()->html() ?>">
<meta property="og:url" content="<?= $page->url() ?>">
<meta property="og:image" content="<?= $site->og_image()->html() ?>">


<!-- Link -->
<link rel="apple-touch-icon" sizes="180x180" href="<?= url('assets/favicon/apple-touch-icon.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= url('assets/favicon/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= url('assets/favicon/favicon-16x16.png') ?>">
<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/skycons/1396634940/skycons.min.js"></script>

<!-- Keys -->
<script>
    window.MOI_SETTINGS = {
        url: "<?= $site->url('cs') ?>",
        maps: "<?= $site->maps() ?>",
        lang: "<?= $kirby->language()->code() ?>",
        hotjarKey: "<?= $site->hotjar() ?>",
        gaKey: "<?= $site->analytics() ?>",
        logErrKey: "<?= $site->log_rocket() ?>"
    };
</script>


<!-- Event snippet for Kliknutí button conversion page In your
  html page, add the snippet and call gtag_report_conversion when someone
  clicks on the chosen link or button. -->
<script>
    function gtag_report_conversion(url) {
        var callback = function() {
            if (typeof url != "undefined") {
                window.location = url;
            }
        };
        gtag && gtag("event", "conversion", {
            send_to: '<?= $gtag ?>',
            value: 1.0,
            currency: "CZK",
            event_callback: callback
        });
        return;
        false;
    }
</script>
