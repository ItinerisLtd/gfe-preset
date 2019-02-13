# GFE Preset

[![Packagist Version](https://img.shields.io/packagist/v/itinerisltd/gfe-preset.svg)](https://packagist.org/packages/itinerisltd/gfe-preset)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/itinerisltd/gfe-preset.svg)](https://packagist.org/packages/itinerisltd/gfe-preset)
[![Packagist Downloads](https://img.shields.io/packagist/dt/itinerisltd/gfe-preset.svg)](https://packagist.org/packages/itinerisltd/gfe-preset)
[![GitHub License](https://img.shields.io/github/license/itinerisltd/gfe-preset.svg)](https://github.com/ItinerisLtd/gfe-preset/blob/master/LICENSE)
[![Hire Itineris](https://img.shields.io/badge/Hire-Itineris-ff69b4.svg)](https://www.itineris.co.uk/contact/)

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->


- [Goal](#goal)
- [Explain It Like I'm Five](#explain-it-like-im-five)
- [Minimum Requirements](#minimum-requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Performance](#performance)
- [FAQ](#faq)
  - [Did you just send all the passwords to someone else?](#did-you-just-send-all-the-passwords-to-someone-else)
  - [How do you compare user passwords with the 5,371,313,595 pwned ones?](#how-do-you-compare-user-passwords-with-the-5371313595-pwned-ones)
  - [What to do if I don't trust haveibeenpwned.com?](#what-to-do-if-i-dont-trust-haveibeenpwnedcom)
  - [What to do if I don't trust the plugin author?](#what-to-do-if-i-dont-trust-the-plugin-author)
  - [I have installed this plugin. Does it mean my WordPress site is *unhackable*?](#i-have-installed-this-plugin-does-it-mean-my-wordpress-site-is-unhackable)
  - [Can strong passwords been pwned?](#can-strong-passwords-been-pwned)
  - [How to disable WooCommerce password strength meter?](#how-to-disable-woocommerce-password-strength-meter)
  - [Will you add support for older PHP versions?](#will-you-add-support-for-older-php-versions)
  - [It looks awesome. Where can I find some more goodies like this?](#it-looks-awesome-where-can-i-find-some-more-goodies-like-this)
  - [This plugin isn't on wp.org. Where can I give a ⭐️⭐️⭐️⭐️⭐️ review?](#this-plugin-isnt-on-wporg-where-can-i-give-a-%EF%B8%8F%EF%B8%8F%EF%B8%8F%EF%B8%8F%EF%B8%8F-review)
- [Alternatives](#alternatives)
- [Testing](#testing)
- [Feedback](#feedback)
- [Change Log](#change-log)
- [Security](#security)
- [Credits](#credits)
- [License](#license)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Goal

By default [Gravity Forms Encrypted Fields](https://codecanyon.net/item/gravity-forms-encrypted-fields/18564931) generate **website key** automatically on web servers which violates [12-factor principle](https://12factor.net/) and makes backing up difficult.

[GFE Preset](https://github.com/ItinerisLtd/gfe-preset) overrides the **website key** via PHP constants so that the key always in a *known state*.

Besides, [GFE Preset](https://github.com/ItinerisLtd/gfe-preset) provides similar overrides to:

- CodeCanyon license key
- encryption key (also known as encryption password)

## Minimum Requirements

- PHP v7.2
- WordPress v5.0
- [Gravity Forms Encrypted Fields](https://codecanyon.net/item/gravity-forms-encrypted-fields/18564931) v4.4.2

## Installation

```sh-session
$ composer require itinerisltd/gfe-preset
```

## Usage

### Normal WordPress

Define these 3 constants in `wp-config.php`:

```php
// Required:
define('GFE_PRESET_WEBSITE_KEY', 'aaa');
define('GFE_PRESET_ENCRYPTION_KEY', 'bbb'); // Also kown as **encryption password**

// Optional:
define('GFE_PRESET_LICENSE_KEY', 'zzz');
```

### [Bedrock](https://github.com/roots/bedrock)

Define these 3 constants in `config/application.php`:

```php
// Required:
Config::define('GFE_PRESET_WEBSITE_KEY', 'aaa');
Config::define('GFE_PRESET_ENCRYPTION_KEY', 'bbb'); // Also kown as **encryption password**

// Optional:
Config::define('GFE_PRESET_LICENSE_KEY', 'zzz');
```

## Wanrings

- You must save [Gravity Forms Encrypted Fields](https://codecanyon.net/item/gravity-forms-encrypted-fields/18564931) setting page whenever:
  - installing/activating the plugins
  - updating the plugins
  - changing the [constants](#usage)

- You should run "ENCRYPTION TESTING AND VERIFICATION" on the plugin settings page

- You should backup all the [constants](#usage)

- You should backup **website key and encryption password** shown on the plugin settings page
  - Without both **website key and encryption password**, you can't decrypt the data

- You should practice backing up and restoring the whole WordPress installation from time to time

- Normal [Gravity Forms Security Best Practices](https://docs.gravityforms.com/security/) still applies

- [Gravity Forms Encrypted Fields](https://codecanyon.net/item/gravity-forms-encrypted-fields/18564931) backup, verification, usage procedures still apply
  - You must read the [plugin readme](https://codecanyon.net/item/gravity-forms-encrypted-fields/18564931) and notices on the plugin setting page in full, and follow the instructions

## FAQ

### Why `GFE_PRESET_WEBSITE_KEY` and `GFE_PRESET_ENCRYPTION_KEY` must be defined?

This is to prevent encrypting with unknown (not backed up) website key and encryption key, which end up with a *unrestorable database* (data is encrtpyed but you can't decrypt them).

### Should I reuse `GFE_PRESET_WEBSITE_KEY` and `GFE_PRESET_ENCRYPTION_KEY`?

No!

Each WordPress installation (enviroment) should have its own set of `GFE_PRESET_WEBSITE_KEY` and `GFE_PRESET_ENCRYPTION_KEY`, i.e: staging and production servers should use different keys.

### I have installed this plugin. Does it mean my WordPress site is *unhackable*?

No website is *unhackable*.

To have a secure WordPress site, you have to keep all these up-to-date:

- WordPress core
- PHP
- this plugin
- all other WordPress themes and plugins
- everything on the server
- other security practices
- your mindset

### Will you add support for older PHP versions?

Never! This plugin will only works on [actively supported PHP versions](https://secure.php.net/supported-versions.php).

Don't use it on **end of life** or **security fixes only** PHP versions.

### It looks awesome. Where can I find some more goodies like this?

- Articles on [Itineris' blog](https://www.itineris.co.uk/blog/)
- More projects on [Itineris' GitHub profile](https://github.com/itinerisltd)
- More plugins on [Itineris' wp.org profile](https://profiles.wordpress.org/itinerisltd/#content-plugins)
- Follow [@itineris_ltd](https://twitter.com/itineris_ltd) and [@TangRufus](https://twitter.com/tangrufus) on Twitter
- Hire [Itineris](https://www.itineris.co.uk/services/) to build your next awesome site

### This isn't on wp.org. Where can I give a ⭐️⭐️⭐️⭐️⭐️ review?

Thanks! Glad you like it. It's important to let my boss knows somebody is using this project. Instead of giving reviews on wp.org, consider:

- tweet something good with mentioning [@itineris_ltd](https://twitter.com/itineris_ltd) and [@TangRufus](https://twitter.com/tangrufus)
- star this [Github repo](https://github.com/ItinerisLtd/gfe-preset)
- watch this [Github repo](https://github.com/ItinerisLtd/gfe-preset)
- write blog posts
- submit pull requests
- [hire Itineris](https://www.itineris.co.uk/services/)

## Testing

```bash
# Code style checks.
$ composer style:check
```

Pull requests without tests will not be accepted!

## Feedback

**Please provide feedback!** We want to make this library useful in as many projects as possible.
Please submit an [issue](https://github.com/ItinerisLtd/gfe-preset/issues/new) and point out what you do and don't like, or fork the project and make suggestions.
**No issue is too small.**

## Change Log

Please see [CHANGELOG](./CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email [hello@itineris.co.uk](mailto:hello@itineris.co.uk) instead of using the issue tracker.

## Credits

[GFE Preset](https://github.com/ItinerisLtd/gfe-preset) is a [Itineris Limited](https://www.itineris.co.uk/) project created by [Tang Rufus](https://typist.tech).

Full list of contributors can be found [here](https://github.com/ItinerisLtd/gfe-preset/graphs/contributors).

## License

[GFE Preset](https://github.com/ItinerisLtd/gfe-preset) is licensed under the [MIT License](https://opensource.org/licenses/MIT).
Please see [License File](./LICENSE) for more information.
