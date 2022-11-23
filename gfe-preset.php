<?php

/**
 * Plugin Name:     GFE Preset
 * Plugin URI:      https://github.com/ItinerisLtd/gfe-preset
 * Description:     Utilities for Gravity Forms Encrypted Fields
 * Version:         0.2.0
 * Author:          Itineris Limited
 * Author URI:      https://itineris.co.uk
 * License:         MIT
 * License URI:     https://opensource.org/licenses/MIT
 * Text Domain:     gfe-preset
 */

declare(strict_types=1);

namespace Itineris\GFEPreset;

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

function get_constant(string $key): string
{
    // phpcs:ignore WordPressVIPMinimum.Constants.ConstantString.NotCheckingConstantName
    if (! defined($key)) {
        wp_die(esc_html("Constant $key is undefined"));
    } elseif (! is_string(constant($key))) {
        wp_die(esc_html("Constant $key is not a string"));
    } elseif ('' === constant($key)) {
        wp_die(esc_html("Constant $key is not an empty string"));
    }

    return constant($key);
}

/**
 * Die to prevent encrypting data with unknown (not backed up) website key or encryption key
 */
add_action('muplugins_loaded', function (): void {
    get_constant('GFE_PRESET_WEBSITE_KEY');
    get_constant('GFE_PRESET_ENCRYPTION_KEY');
});

add_filter('default_option_gfe_pluginowl_licensed', function ($key) {
    return defined('GFE_PRESET_LICENSE_KEY')
        ? constant('GFE_PRESET_LICENSE_KEY')
        : $key;
});

add_filter('pre_option_gfe_website_key', function (): string {
    return md5(get_constant('GFE_PRESET_WEBSITE_KEY'));
});

add_filter('pre_option_gfe_encryption_key', function (): string {
    return md5(get_constant('GFE_PRESET_ENCRYPTION_KEY'));
});
