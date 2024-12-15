<?php

declare(strict_types=1);

use Yeremi\Ingresso\Domain\ValueObject\Event;
use Yeremi\Ingresso\Domain\ValueObject\EventList;
use Yeremi\Ingresso\Domain\ValueObject\Highlight;
use Yeremi\Ingresso\Infrastructure\WordPress\Functions\EventFunctions;
use Yeremi\Ingresso\Infrastructure\WordPress\Functions\TemplatesFunctions;
use Yeremi\Ingresso\Infrastructure\WordPress\Functions\Helper;

$currentUrl = isset($_SERVER['REQUEST_URI']) ? esc_url_raw(wp_unslash($_SERVER['REQUEST_URI'])) : '';

/**
 * Highlights
 */
$highlights = TemplatesFunctions::getHighlightsByCityAndPartnership();
if (is_array($highlights) and count($highlights) > 0) {
    mt_srand((int) microtime(true));
    shuffle($highlights);
    $highlights = array_slice($highlights, 0, 3);
}
/**
 * Now Playing
 */
$nowPlaying = (array) TemplatesFunctions::getNowPlayingByCityAndPartnership();
/**
 * Coming Soon
 */
$comingSoon = array_slice((array) TemplatesFunctions::getSoon(), 0, 36);

get_header();
?>
<?php if (is_array($highlights)) { ?>
<div class="wp-ingresso-px-20 wp-ingresso-py-32 wp-ingresso-bg-gray-900">
    <div class="wp-ingresso-block">
        <h2 class="wp-ingresso-text-gray-100 wp-ingresso-mt-0 wp-ingresso-mb-28 wp-ingresso-text-center">
            <?php echo esc_html__('Highlights', 'wp-ingresso') ?>
        </h2>
        <div class="wp-ingresso-grid wp-ingresso-grid-cols-1 md:wp-ingresso-grid-cols-2 lg:wp-ingresso-grid-cols-3 wp-ingresso-gap-20">
            <?php
            /** @var Highlight[] $highlights */
            foreach ($highlights as $highlight) {
                /** @var Event $event */
                $event = $highlight->getEvent();
                $posterPortrait = EventFunctions::getPoster($event, Helper::getPosterPortrait()); ?>
                <div class="wp-ingresso-rounded-lg wp-ingresso-overflow-hidden">
                    <figure>
                        <img src="<?php echo esc_url($posterPortrait); ?>"
                            alt="<?php echo esc_attr($event->getTitle()); ?>"/>
                    </figure>
                    <?php if ($event->isPlaying()) { ?>
                        <a class="hover:wp-ingresso-bg-gray-300 wp-ingresso-block wp-ingresso-no-underline wp-ingresso-text-center wp-ingresso-bg-gray-600 wp-ingresso-p-8 wp-ingresso-text-black"
                            href="<?php echo esc_url($currentUrl . '/' . $event->getId()); ?>">
                            <?php echo esc_html__('Upcoming Showtimes', 'wp-ingresso')?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
<?php if ($nowPlaying) { ?>
<div class="wp-ingresso-px-20 wp-ingresso-py-28 wp-ingresso-bg-gray-100">
    <div class="wp-ingresso-flex wp-ingresso-justify-center wp-ingresso-flex-wrap">
        <div class="wp-ingresso-w-4/5">
            <div class="wp-ingresso-grid wp-ingresso-grid-cols-1 md:wp-ingresso-grid-cols-2 lg:wp-ingresso-grid-cols-4 wp-ingresso-gap-12">
                <?php
                /** @var Event[] $nowPlaying */
                foreach ($nowPlaying as $now) { ?>
                    <div class="wp-ingresso-rounded-lg wp-ingresso-shadow-md wp-ingresso-shadow-gray-300 wp-ingresso-overflow-hidden">
                        <figure>
                            <img src="<?php echo esc_url(EventFunctions::getPoster($now, Helper::getPosterPortrait())); ?>"
                                alt="<?php echo esc_attr($now->getTitle()); ?>"/>
                        </figure>
                        <?php if ($now->isPlaying()) {
                            $rateValue = (int) filter_var($now->getContentRating(), FILTER_SANITIZE_NUMBER_INT);
                            ?>
                            <a class="hover:wp-ingresso-bg-white wp-ingresso-no-underline wp-ingresso-text-center wp-ingresso-bg-gray-50 wp-ingresso-p-6 wp-ingresso-flex wp-ingresso-items-center wp-ingresso-justify-normal wp-ingresso-text-black"
                                href="<?php echo esc_url($currentUrl . '/' . $now->getId()); ?>">
                                <span class=" wp-ingresso-leading-loose wp-ingresso-mr-6 wp-ingresso-text-center  wp-ingresso-w-12 wp-ingresso-h-12 wp-ingresso-border-solid wp-ingresso-rounded-md wp-ingresso-border wp-ingresso-inline-block wp-ingresso-border-gray-600 wp-ingresso-text-2xl">
                                    <?php echo esc_html($rateValue === 0 ? 'L' : (string) $rateValue); ?>
                                </span>
                                <span class="wp-ingresso-inline-block">
                                    <?php echo esc_html__('See Showtimes', 'wp-ingresso'); ?>
                                </span>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php if ($comingSoon) { ?>
<div class="wp-ingresso-p-20 wp-ingresso-bg-white">
    <div class="wp-ingresso-flex wp-ingresso-justify-center wp-ingresso-flex-wrap ">
        <div class="wp-ingresso-w-4/5 wp-ingresso-mb-20">
            <h3 class="wp-ingresso-text-gray-500 wp-ingresso-mt-0">
                <?php echo esc_html__('Coming soon to theaters', 'wp-ingresso') ?>
            </h3>
            <div class="wp-ingresso-grid wp-ingresso-grid-cols-1 md:wp-ingresso-grid-cols-2 lg:wp-ingresso-grid-cols-6 wp-ingresso-gap-12">
                <?php
                /** @var Event[] $comingSoon */
                foreach ($comingSoon as $soon) {
                    $trailers = $soon->getTrailers();
                    $posterPortrait = EventFunctions::getPoster($soon, Helper::getPosterPortrait());
                    ?>
                    <div class="wp-ingresso-shadow-sm wp-ingresso-shadow-gray-300 wp-ingresso-rounded-lg wp-ingresso-overflow-hidden">
                        <figure class="wp-ingresso-relative">
                            <?php if (count($trailers) > 0) {
                                $trailer = $trailers[0];
                                ?>
                                <a target="_blank" href="<?php echo esc_url($trailer->getUrl()); ?>" class="
                            wp-ingresso-absolute wp-ingresso-rounded-full wp-ingresso-w-20 wp-ingresso-h-20 wp-ingresso-bottom-5 wp-ingresso-right-5
                            wp-ingresso-bg-neutral-400/50 hover:wp-ingresso-bg-orange-500 wp-ingresso-no-underline wp-ingresso-text-white wp-ingresso-flex wp-ingresso-items-center wp-ingresso-justify-center">
                                    <img src="<?php echo esc_url(Helper::getAsset('play-icon')); ?>" alt="Watch Trailer"
                                        class="wp-ingresso-w-12 wp-ingresso-h-12 wp-ingresso-ml-1"/>
                                </a>
                            <?php } ?>

                            <img src="<?php echo esc_url($posterPortrait); ?>" alt="<?php echo esc_attr($soon->getTitle()); ?>"/>
                            <figcaption class="wp-ingresso-sr-only"><?php echo esc_html($soon->getTitle()); ?></figcaption>
                        </figure>
                        <?php
                        $premierDate = $soon->getPremierDate()?->getLocalDate() ?? '';
                        if (!empty($premierDate)) {
                            $rateValue = (int) filter_var($soon->getContentRating(), FILTER_SANITIZE_NUMBER_INT);
                            ?>
                            <div class="wp-ingresso-p-4 wp-ingresso-bg-gray-50 wp-ingresso-text-gray-600">
                                <span class="wp-ingresso-leading-loose wp-ingresso-mr-2 wp-ingresso-text-center  wp-ingresso-w-12 wp-ingresso-h-12 wp-ingresso-border-solid wp-ingresso-rounded-md wp-ingresso-border wp-ingresso-inline-block wp-ingresso-border-gray-600 wp-ingresso-text-2xl">
                                    <?php echo esc_html($rateValue === 0 ? 'L' : (string) $rateValue); ?>
                                </span>
                                <span class=" wp-ingresso-text-2xl  wp-ingresso-text-center">
                                    <?php echo esc_html(Helper::getReadableDate($premierDate)); ?>
                                </span>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>
