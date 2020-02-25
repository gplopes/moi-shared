<?php
function buttonBlock($link, $primary, $value)
{
    $cta = $primary === true ? 'button-primary' : 'button-dark';
    return "<a
            onclick='return gtag_report_conversion($link);'
            href='$link'
            target='_blank'
            class='button $primary $cta button-shadow'>
            $value
            </a>
        ";
}

?>

<?php
$buttonLeft = buttonBlock(
    $link = $site->booking_button_left_link(),
    $primary = $site->booking_button_left_primary()->isTrue(),
    $value = $site->booking_button_left_value()
);

$buttonRight = buttonBlock(
    $link = $site->booking_button_right_link(),
    $primary = $site->booking_button_right_primary()->isTrue(),
    $value = $site->booking_button_right_value()
);

?>

<section class="standard" id="bookingBanner">
    <div class="container bookingBanner-content">

        <div class="bookingBanner-text js-bookingWrap">
            <h2><?= $site->booking_content() ?></h2>
        </div>
        <div class="bookingBanner-buttons">
            <?= $buttonLeft ?>
            <?= $buttonRight ?>
        </div>

    </div>

    <div class="bookingBanner-buttons--sticky js-bookingButtons">
        <?= $buttonLeft ?>
        <?= $buttonRight ?>
    </div>
</section>
