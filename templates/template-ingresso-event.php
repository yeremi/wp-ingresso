<?php

declare(strict_types=1);

use Yeremi\Ingresso\Domain\ValueObject\GenericSession;
use Yeremi\Ingresso\Domain\ValueObject\GenericSessionSessionType;
use Yeremi\Ingresso\Domain\ValueObject\GenericTheaterRoom;
use Yeremi\Ingresso\Domain\ValueObject\ShowTimeByMovie;
use Yeremi\Ingresso\Domain\ValueObject\SimplifiedTheater;
use Yeremi\Ingresso\Infrastructure\WordPress\Functions\EventFunctions;
use Yeremi\Ingresso\Infrastructure\WordPress\Functions\Helper;
use Yeremi\Ingresso\Infrastructure\WordPress\Functions\SessionFunctions;

get_header();

$event = EventFunctions::getOne();
$posterLandscape = EventFunctions::getPoster($event, Helper::getPosterLandscape());
$posterPortrait = EventFunctions::getPoster($event, Helper::getPosterPortrait());
$genres = Helper::getGenres($event);
$ratingDescription = Helper::getRatingDescriptors($event);
$rateValue = (int) filter_var($event->getContentRating(), FILTER_SANITIZE_NUMBER_INT);
$ratingBorderColor = sprintf("wp-ingresso-border-%s", Helper::ratingColor($rateValue));
$ratingBgColor = sprintf("wp-ingresso-bg-%s", Helper::ratingColor($rateValue));
$trailers = $event->getTrailers();
?>
<?php if ($event->getId()) { ?>
<div class="wp-ingresso-bg-cover wp-ingresso-bg-center"
    style="background-image: url(<?php echo esc_attr($posterLandscape); ?>)">
    <div class="wp-ingresso-bg-black/75 wp-ingresso-h-full wp-ingresso-p-20">
        <div class="wp-ingresso-flex wp-ingresso-justify-center wp-ingresso-flex-wrap">
            <div class="wp-ingresso-w-4/5 wp-ingresso-flex">
                <div class="wp-ingresso-w-[300px]">
                    <picture class="wp-ingresso-w-[300px]">
                        <img class="wp-ingresso-min-w-[300px] wp-ingresso-w-[300px] wp-ingresso-drop-shadow-xl"
                            alt="<?php echo esc_attr($event->getTitle()); ?>"
                            src="<?php echo esc_url($posterPortrait); ?>"/>
                    </picture>
                    <?php if ($trailers) {
                        $trailer = array_key_first($trailers);
                        $trailer = $trailers[$trailer];
                        ?>
                        <a target="_blank" href="<?php echo esc_url($trailer->getUrl()); ?>" class=" wp-ingresso-bg-orange-400 hover:wp-ingresso-bg-orange-500 wp-ingresso-no-underline wp-ingresso-text-white wp-ingresso-flex wp-ingresso-items-center wp-ingresso-w-full wp-ingresso-justify-center wp-ingresso-px-5 wp-ingresso-py-6">
                            <img src="<?php echo esc_url(Helper::getAsset('play-icon')); ?>" alt="Watch Trailer"
                                class="wp-ingresso-w-8 wp-ingresso-h-8 wp-ingresso-mr-2"/>
                            <?php echo esc_html__('Watch Trailer', 'wp-ingresso'); ?>
                        </a>
                    <?php } ?>
                </div>
                <div>
                    <div class="wp-ingresso-text-white wp-ingresso-text-left wp-ingresso-flex wp-ingresso-flex-col wp-ingresso-flex-nowrap wp-ingresso-p-14 wp-ingresso-pt-1">

                        <div class="wp-ingresso-mb-10">
                            <span class="wp-ingresso-text-center  wp-ingresso-text-white wp-ingresso-w-12 wp-ingresso-border-solid wp-ingresso-rounded-md wp-ingresso-border wp-ingresso-inline-block wp-ingresso-font-bold
                            <?php echo esc_attr($ratingBorderColor); ?>
                            <?php echo esc_attr($ratingBgColor); ?>
                            "><?php echo esc_html($rateValue === 0 ? 'L' : (string) $rateValue); ?></span>
                            <span class="wp-ingresso-text-2xl wp-ingresso-mb-16"><?php echo esc_html($ratingDescription); ?></span>
                        </div>

                        <h3 class="wp-ingresso-m-0"><?php echo esc_html($event->getTitle()); ?></h3>

                        <div class="wp-ingresso-mb-16">
                            <span><?php echo esc_html($genres); ?></span>
                            • <?php echo esc_html($event->getDuration()); ?> min
                        </div>

                        <h5 class="wp-ingresso-text-left wp-ingresso-m-0 wp-ingresso-p-0 wp-ingresso-text-slate-100">
                            <?php echo esc_html(__('Synopsis', 'wp-ingresso')) ?>
                        </h5>

                        <p class="wp-ingresso-text-slate-100"><?php echo esc_html($event->getSynopsis()); ?></p>

                        <?php if ($event->getCast()) { ?>
                            <p class="wp-ingresso-text-slate-100">
                                <strong><?php echo esc_html__('Cast:', 'wp-ingresso'); ?></strong>
                                <?php echo esc_html($event->getCast()); ?>
                            </p>
                        <?php } ?>

                        <?php if ($event->getDirector()) { ?>
                            <p class="wp-ingresso-text-slate-100">
                                <strong><?php echo esc_html__('Director:', 'wp-ingresso') ;?></strong>
                                <?php echo esc_html($event->getDirector()); ?>
                            </p>
                        <?php } ?>

                        <?php if ($event->getDistributor() !== 'Sem Distribuidor') { ?>
                            <p class="wp-ingresso-text-slate-100">
                                <strong><?php echo esc_html__('Distributor:', 'wp-ingresso'); ?></strong>
                                <?php echo esc_html($event->getDistributor()); ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wp-ingresso-p-20">
    <div class="wp-ingresso-flex wp-ingresso-justify-center wp-ingresso-flex-wrap">
        <?php if ($trailers) { ?>
            <div class="wp-ingresso-w-4/5 wp-ingresso-mb-20">
                <div class="wp-ingresso-grid wp-ingresso-grid-cols-1 md:wp-ingresso-grid-cols-2 lg:wp-ingresso-grid-cols-4 wp-ingresso-gap-4">
                    <?php foreach ($trailers as $trailer) { ?>
                        <div class="wp-ingresso-relative wp-ingresso-w-full wp-ingresso-aspect-w-16 wp-ingresso-aspect-h-9">
                            <a href="<?php echo esc_url($trailer->getUrl()); ?>" target="_blank">
                                <img alt="<?php echo esc_attr($event->getTitle()); ?>"
                                    src="<?php echo esc_url(Helper::getYouTubeThumbnailUrl($trailer->getEmbeddedUrl())); ?>"/>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <div class="wp-ingresso-w-4/5 wp-ingresso-flex">
            <div class="wp-ingresso-grid wp-ingresso-grid-cols-3 wp-ingresso-gap-4 wp-ingresso-w-full">
                <?php foreach (SessionFunctions::getSessionEventPartnership() as $sessionEventPartnership) {
                    /** @var ShowTimeByMovie $sessionEventPartnership */
                    ?>
                    <div class="wp-ingresso-relative wp-ingresso-w-full wp-ingresso-flex wp-ingresso-flex-col">
                        <div class="wp-ingresso-p-14 wp-ingresso-bg-gray-200">
                            <span class="wp-ingresso-text-gray-900 wp-ingresso-text-3xl wp-ingresso-font-bold">
                                <?php echo esc_html(Helper::getReadableDate($sessionEventPartnership->getDate())); ?>
                            </span>
                            <?php foreach ($sessionEventPartnership->getTheaters() as $theater) { /** @var SimplifiedTheater $theater */ ?>
                                <span class="wp-ingresso-block wp-ingresso-mb-4 wp-ingresso-text-gray-500 wp-ingresso-text-2xl">
                                    <?php echo esc_html(wp_sprintf(
                                    /* translators: The theater name */
                                        __('Theater: %s', 'wp-ingresso'),
                                        esc_html($theater->getName())
                                    ));
                                    ?>
                                </span>
                                <?php foreach ($theater->getRooms() as $room) { /** @var GenericTheaterRoom $room */ ?>
                                    <?php foreach ($room->getSessions() as $session) { /** @var GenericSession $session */ ?>
                                        <div class="wp-ingresso-flex wp-ingresso-flex-row wp-ingresso-gap-6 wp-ingresso-py-6 wp-ingresso-border wp-ingresso-border-b-gray-300">
                                            <?php foreach (Helper::getTypesLabels($session) as $type) { /** @var GenericSessionSessionType $type */ ?>
                                                <span class="wp-ingresso-leading-8 wp-ingresso-flex-none wp-ingresso-text-center wp-ingresso-px-2 wp-ingresso-py-1 wp-ingresso-border-solid wp-ingresso-rounded-md wp-ingresso-border wp-ingresso-font-medium wp-ingresso-text-blue wp-ingresso-border-blue wp-ingresso-text-xl wp-ingresso-h-11">
                                                <?php echo esc_html($type->getAlias()); ?></span>
                                            <?php } ?>
                                            <span class="wp-ingresso-flex-1 wp-ingresso-w-32">
                                                <?php echo esc_html($session->getTime()); ?>
                                            </span>
                                            <span>
                                                <a class="wp-ingresso-flex-1 wp-ingresso-w-32 wp-ingresso-bg-orange-400 wp-ingresso-block wp-ingresso-text-white wp-ingresso-no-underline wp-ingresso-rounded-md hover:wp-ingresso-bg-orange-500 wp-ingresso-text-center wp-ingresso-uppercase wp-ingresso-drop-shadow-md wp-ingresso-font-medium wp-ingresso-py-2 wp-ingresso-text-2xl"
                                                    href="<?php echo esc_url($session->getSiteUrl()); ?>"
                                                    rel="noopener"
                                                    target="_blank">
                                                    <?php echo esc_html__('Buy', 'wp-ingresso'); ?>
                                                </a>
                                            </span>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>
