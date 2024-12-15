<?php

declare(strict_types=1);

use Yeremi\Ingresso\Domain\Entity\SettingsEntity;

/**
 * phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
 *
 * @var SettingsEntity $settings
 * @var string[] $onErrors
 * @var bool $onSuccess
 */

if ($onErrors) {
    foreach ($onErrors as $onError) {
        $errorMessage = $onError ?: '';
        echo wp_kses_post('<div class="error"><p>' . esc_html($errorMessage) . '</p></div>');
    }
}

if ($onSuccess) { ?>
    <div class="updated">
        <p>
            <?php echo esc_html_x(
                'Settings saved successfully!',
                'Success message',
                'wp-ingresso'
            ); ?>
        </p>
    </div>
<?php } ?>

<div class="wrap">
    <h1><?php echo esc_html(_x('Ingresso Settings', 'Page title', 'wp-ingresso')); ?></h1>

    <form method="post"
            action="<?php echo esc_url(admin_url('options-general.php?page=wp_ingresso_settings')); ?>">
        <?php settings_fields('wp_ingresso_settings_group'); ?>
        <?php wp_nonce_field('wp_ingresso_nonce'); ?>
        <table class="form-table" role="presentation">
            <tbody>
            <tr>
                <th scope="row">
                    <label for="cityId">
                        <?php echo esc_html(__('City ID', 'wp-ingresso')); ?>
                    </label>
                </th>
                <td>
                    <input name="wp-ingresso[cityId]" type="text" id="cityId"
                            value="<?php echo esc_attr($settings->getCityId()); ?>"
                            class="regular-text code" required/>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="theaterId">
                        <?php echo esc_html(__('Theater Code', 'wp-ingresso')); ?>
                    </label>
                </th>
                <td><input name="wp-ingresso[theaterId]" type="text" id="theaterId"
                            value="<?php echo esc_attr($settings->getTheaterId()); ?>"
                            class="regular-text code" required/>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="partnership">
                        <?php echo esc_html(__('Partnership Code', 'wp-ingresso')); ?>
                    </label>
                </th>
                <td>
                    <input name="wp-ingresso[partnership]" type="text" id="partnership"
                            value="<?php echo esc_attr($settings->getPartnership()); ?>"
                            class="regular-text code" required/>
                </td>
            </tr>
            </tbody>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
