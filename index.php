<?php

@include_once __DIR__ . '/vendor/autoload.php';


Kirby::plugin('moi/moi-shared', [
    // plugin magic happens here

    'blueprints' => [

        // Tabs
        'Shared/Tabs/Promos'    => __DIR__ . '/Tabs/Promos.yml',
        'Shared/Tabs/Settings'  => __DIR__ . '/Tabs/Settings.yml',

        // Fields
        'Shared/Fields/Carousel' => __DIR__ . '/Fields/Carousel.yml',
        'Shared/Fields/PromoList' => __DIR__ . '/Fields/PromoList.yml',
        'Shared/Fields/Map' => __DIR__ . '/Fields/Map.yml',
        'Shared/Fields/Files' => __DIR__ . '/Fields/Files.yml',
        'Shared/Fields/SEO' => __DIR__ . '/Fields/SEO.yml',
        'Shared/Fields/Banner' => __DIR__ . '/Fields/Banner.yml',
        'Shared/Fields/PromoBanner' => __DIR__ . '/Fields/PromoBanner.yml',
        'Shared/Fields/BannerGrid' => __DIR__ . '/Fields/BannerGrid.yml',
        'Shared/Fields/ContactForm' => __DIR__ . '/Fields/ContactForm.yml',
        'Shared/Fields/TextSection' => __DIR__ . '/Fields/TextSection.yml'
    ],

    'snippets' => [
        'Functions/MailSender' => __DIR__ . '/Functions/MailSender.php',
        'Shared/Snippets/Head' => __DIR__ . '/Snippets/Head.php',
        'Shared/Snippets/CookieBanner' => __DIR__ . '/Snippets/CookieBanner.php',
        'Shared/Snippets/Nav' => __DIR__ . '/Snippets/Nav.php',
        'Shared/Snippets/Lang' => __DIR__ . '/Snippets/Lang.php',
        'Shared/Snippets/Carousel' => __DIR__ . '/Snippets/Carousel.php',
        'Shared/Snippets/BookingBanner' => __DIR__ . '/Snippets/BookingBanner.php',
        'Shared/Snippets/PhotoSwipe' => __DIR__ . '/Snippets/PhotoSwipe.php',
        'Shared/Snippets/Banner' => __DIR__ . '/Snippets/Banner.php',
        'Shared/Snippets/Sitemap' => __DIR__ . '/Snippets/Sitemap.php',
    ],


    'routes' => [
        [
            'pattern' => '(?:(^[A-Za-z]{2})//?)?private/forecast',
            'action' => function ($lang = 'cs') {

                $key = "7344cd4309e8a73d5927c0efe4be1c35";
                $location = "50.003782, 12.609745";
                $query = "lang=$lang&exclude=[minutely,hourly,daily,alerts,flags]";

                $response = file_get_contents("https://api.darksky.net/forecast/$key/$location?$query");
                return new \Kirby\Http\Response($response, 'text/json', 200);
            }
        ],

        [
            'pattern' => 'robots.txt',
            'method' => 'GET',
            'action' => function () {
                $debug = kirby()->option('debug');
                $robots =  $debug ? array('#Debug Mode') : array(
                    'user-agent: *',
                    'disallow: /kirby',
                    'disallow: /site/',
                    'allow: /media/',
                    'sitemap: ' . url() . '/sitemap.xml'
                );
                $txt =  implode(PHP_EOL, $robots) . PHP_EOL;
                if ($txt) {
                    return new \Kirby\Http\Response($txt, 'text/plain', 200);
                }
                return kirby()->site()->visit(
                    kirby()->site()->errorPage()
                );
            },
        ],
        [
            'pattern' => ['sitemap.xml', 'sitemap'],
            'action'  => function () {
                $pages = site()->pages()->index();
                $debug = kirby()->option('debug');

                // fetch the pages to ignore from the config settings,
                // if nothing is set, we ignore the error page
                $ignore = kirby()->option('sitemap.ignore', ['error']);

                $content = snippet('Shared/Snippets/Sitemap', compact('pages', 'ignore'), true);

                if ($debug) {
                    return kirby()->site()->visit(
                        kirby()->site()->errorPage()
                    );
                }
                // return response with correct header type
                return new \Kirby\Http\Response($content, 'application/xml', 200);
                // return new Kirby\Cms\Response($content, 'application/html');
            }
        ],

    ],

    'hooks' => [
        'kirbytags:after' => function ($text, $data, $options) {

            if ($page = $data['parent']->gallery()->toPage()) {
                $gallery = snippet('gallery', ['gallery' => $page], true);
            } else {
                $gallery = '';
            }

            return str_replace('{{ gallery }}', $gallery, $text);
        }
    ],

    'components' => [
        'css' => function ($kirby, $url) {
            $file = $kirby->roots()->index() . DS . $url;
            $date = F::modified($file);
            return $url . '?v=' . $date;
        },
        'js'  => function ($kirby, $url) {
            $file = $kirby->roots()->index() . DS . $url;
            $date = F::modified($file);
            return $url . '?v=' . $date;
        }
    ]
]);
