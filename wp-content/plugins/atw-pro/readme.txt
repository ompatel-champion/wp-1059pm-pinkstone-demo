==== Advanced Text Widget PRO ====
Contributors: Max Chirkov
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JRA6WSKH3MSPG
Tags: text, php, plugin, widget, sidebar, conditions
Requires at least: 2.8
Tested up to: 5.2.1
Stable tag: 2.3.0

Text widget with HTML and raw PHP support. Conditional visibility for all widgets or just this advanced text widget. Extensive conditional options with ability to edit and/or add custom conditions.

== Description ==
Advanced Text Widget is a text widget that allows you to execute raw PHP code. It comes with 10 default visibility conditions that will allow you to choose where exactly on your site this widget should be displayed. You can edit and/or add your own visibility conditions. The BEST FEATURE - it allows you to apply visibility conditions to ALL widgets on the site.

**Features:**

* 10 Default widget visibility conditions with over 20 application possibilities.
* Add unlimited custom conditions.
* “Advanced Text” widget with raw PHP support and shortcodes execution.
* Apply visibility conditions to ANY widget.
* Add custom CSS IDs/Classes to ANY widget.
* Import/Export your visibility conditions to re-use on other sites.


**Credits:**

* Author: Max Chirkov
* Author URI: [http://simplerealtytheme.com](http://SimpleRealtyTheme.com "Real Estate Themes for WordPress")
* Copyright: Released under GNU GENERAL PUBLIC LICENSE


== Installation ==

**Install like any other basic plugin:**

1.	Copy the advanced-text-widget folder to your /wp-content/plugins/ folder

2.	Activate the Advanced Text Widget on your plugin-page.

3.	Drag the Advanced Text Widget to your sidebar and add your own content including php code if needed. Optionally specify whether to display only on home, pages, posts, posts in category (-ies) or category archives. Specify even more if you like with slug/ID/title.

The plugins settings are located under Settings => ATW Plugin. From there you can edit/add visibility conditions as well as opt-out from applying conditions to all widgets.

**Notes:**

* *When selecting to show widget on **Home** page - it will show up on the Blog's index (main) page. If you have a static front page where you would like to show your widget, select the **Front page** option.*


== Changelog ==

= 2.3.1 =
- Adds support for Envato Market plugin.

= 2.2.4 =
- Fixes use of a deprecated function in PHP 7.2.

= 2.2.3 =
- Fixes minor PHP Error.
- WP 4.9.4 compatibility update.

= 2.2.2 =
- WP 4.8.2 compatibility update.

= 2.2.1 =
- PHP7 compatibility update.
- WP 4.7 compatibility update.

= 2.2.0 =
- Improvement: loads minified JS script in the admin settings.
- New Feature: interface for deleting existing conditions.

= 2.1.11 =
- WP 4.5.3 compatibility update.

= 2.1.10 =
- WP 4.3 compatibility update.

= 2.1.9 =
- WP 4.1 compatibility update.

= 2.1.8 =
- Added settings reset button.

= 2.1.7 =
- Fixed: default settings weren't getting imported on initial plugin activation.

= 2.1.6 =
- Added support for [embed] shortcodes.
- Updated deprecated functions usage and removed php notices.

= 2.1.5 =
- WP 3.9 Compatibility update.

= 2.1.4 =
- Added filter to widget title.
- Cleaned up minor PHP warnings.

= 2.1.3 =
- Bug Fix: Default conditions weren't getting imported by initial plugin activation.
- Bug Fix: Import/Export functionality was missing, while form items were present. Duh!
- More code clean up.

= 2.1.2 =
- Compatibility update for WordPress 3.4
- Code clean up to remove PHP notices.

= 2.1.1 =
- Bug Fix: custom CSS ID was being appended rather than replacing the existing one.
- Bug Fix: after plugin activation existing widgets had to be re-saved, otherwise they were displayed with default settings. No data loss there - just the output issue.

= 2.1.0 =
- New Feature: custom CSS ID and class options for every widget.
- Bug Fix: atw shortcode filter wasn't using the right handle.

= 2.0.3 =
- Changed widget's content filter to atw_widget_content instead of the default widget_text.
- Bug fix: foreach error on line 99 /pro/functions.php - wasn't checking if sidebars had no widgets

= 2.0.2 =
- Updated all get method operations with esc_attr() to improve security.

= 2.0.1 =
- Fix for possible security vulnerability.