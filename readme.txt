=== WP Ingresso ===
Contributors: yeremiloli
Tags: Cinemark, movies, films, Ingresso.com, theaters, premiers, showtime
Requires at least: 5.0
Tested up to: 6.7.1
Requires PHP: 8.1
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Plugin URI: https://github.com/yeremi/wp-ingresso
Author URI: https://www.linkedin.com/in/yeremiloli/

API integration with Ingresso.com for online ticket sales.

== Description ==

The WP Ingresso plugin integrates with the Ingresso.com API to fetch movie data such as titles, descriptions, ratings, and showtime. It dynamically displays the movie data on WordPress pages, offering a modular and scalable solution.

== Installation ==

The plugin uses the **Ingresso API** to fetch movie information.

### Install via WordPress Dashboard

1. Download the plugin `.zip` file from the plugin repository.
2. Navigate to `Plugins > Add New > Upload Plugin`.
3. Click `Choose File`, select the `.zip` file, and click `Install Now`.
4. After installation, click `Activate` to enable the plugin.
5. Go to `Settings -> Ingresso` and fill the fields accordingly.

### Install via Composer

If you use Composer for managing dependencies:

```bash
composer require wpackagist-plugin/wp-ingresso
```

== Frequently Asked Questions ==

= How do I customize the frontend output? =

Copy the files, example `template/template-ingresso-event.php` and paste it into your theme like `my-custom-theme/wp-ingresso/template-ingresso-evento.php` folder, then you can customize the HTML as needed.

= Can I use this plugin on multisite installations? =

Yes, this plugin is compatible with WordPress multisite.

= Does it support caching? =

No, caching is not built-in. We suggest to address this topic with your hosting provider.

= Can I extend the plugin for more external APIs? =

No, the plugin works only with Ingresso.com API client.

== Screenshots ==

1. Admin Settings Page
2. Cinema page.
3. Movie page.

== Changelog ==

= 1.0.0 =
* Initial release of the WP Ingresso plugin.

== Upgrade Notice ==

= 1.0.0 =
Initial release of the WP Ingresso plugin.

== Contributors ==

* yeremiloli (author)

== License ==

GPL 2.0 or later. See LICENSE file for details.
