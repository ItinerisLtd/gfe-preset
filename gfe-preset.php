<?php
/**
 * Plugin Name:     GFE Preset
 * Plugin URI:      https://github.com/ItinerisLtd/gfe-preset
 * Description:     Utilities for Gravity Forms Encrypted Fields
 * Version:         0.0.0
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

/**
 * Die to prevent encrypting data with unknown (not backed up) website key or encryption key
 */
add_action('muplugins_loaded', function (): void {
    if (! defined('GFE_PRESET_WEBSITE_KEY')) {
        wp_die("Constant 'GFE_PRESET_WEBSITE_KEY' is undefined");
    }

    if (! defined('GFE_PRESET_ENCRYPTION_KEY')) {
        wp_die("Constant 'GFE_PRESET_ENCRYPTION_KEY' is undefined");
    }
});

add_filter('default_option_gfe_pluginowl_licensed', function ($key) {
    return defined('GFE_PRESET_LICENSE_KEY')
        ? constant('GFE_PRESET_LICENSE_KEY')
        : $key;
});

add_filter('pre_option_gfe_website_key', function ($key): string {
    if (! defined('GFE_PRESET_WEBSITE_KEY')) {
        // Die to prevent encrypting data with unknown (not backed up) website key.
        wp_die("Constant 'GFE_PRESET_WEBSITE_KEY' is not set");
    }

    return md5(constant('GFE_PRESET_WEBSITE_KEY'));
});

add_filter('pre_option_gfe_encryption_key', function ($key): string {
    if (! defined('GFE_PRESET_ENCRYPTION_KEY')) {
        // Die to prevent encrypting data with unknown (not backed up) encryption key.
        wp_die("Constant 'GFE_PRESET_ENCRYPTION_KEY' is not set");
    }

    return md5(constant('GFE_PRESET_ENCRYPTION_KEY'));
});
