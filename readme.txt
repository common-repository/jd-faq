=== WP responsive FAQ with Category ===
Contributors: wponlinehelp, bhargavDholariya
Tags:  faq, faq list, faq plugin, faqs,  jquery ui accordion,  faq with accordion, custom post type with accordion, frequently asked questions, wordpress, wordpress faq,jquery ui, wp-faq with category, WordPress Plugin, shortcodes
Requires at least: 2.0
Tested up to: 4.9.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A quick, easy way to add an responsive FAQs page. You can use this plugin as a jquery ui accordion.

== Description ==
Wordpress CMS site needs a FAQs section. JD faqs plugin  allows you add, manage and display FAQ on your wordpress website. This plugin is created with custom post type.


Now you can also Fillter OR Display FAQ by category.

Here is the example :
<code>
News
[wpoh_faq category="category_ID" single_open="true" transition_speed="Numeric"]
sports
[wpoh_faq category="category_ID" single_open="true" transition_speed="Numeric"]
</code>

To use this FAQ plugin just create a new page and add this FAQ short code 
<code>[wpoh_faq]</code> 
OR
If you want to display FAQ by category then use this short code 
<code>[wpoh_faq  category="category_ID"]</code>

= Shortcode parameters are =
* **limit** : [wpoh_faq limit="10"] (ie Limit the number of FAQ's items to be display. By default value is limit="-1" ie all)
* **category** : [wpoh_faq category="category_ID"] (ie Display FAQ's by category. You can find shortcode under **Faq -> FAQ Category**)
* **single_open** : [wpoh_faq single_open="true"] (ie Display One FAQ item when click to open. By default value is "true". Values are "true" and "false")
* **transition_speed** : [wpoh_faq transition_speed="300"] (ie transition speed when user click to open FAQ item )

This faqs plugin add a FAQs page in your wordpress website with accordion.

The faq plugin adds a "FAQ" tab to your admin menu, which allows you to enter FAQ Title and FAQ Description items just as you would regular posts.

we have also used faq accordion function so that user can show/hide FAQ content.

= New Features include: =
* wp-faq with category <code>[wpoh_faq  category="category_ID"]</code> You can find shortcode under **Faq -> FAQ Category**
* Just create a FAQs page and add short code <code>[wpoh_faq limit="-1"]</code>
* accordion
* Add thumb image for FAQ
* Easy to configure FAQ page
* Smooth FAQ Accordion effect
* CSS and JS file for FAQ custmization
* Search Engine Friendly URLs
* Added Text Domain and Domain Path



== Installation ==

1. Upload the 'jd-faq' folder to the '/wp-content/plugins/' directory.
2. Activate the Jd faq list plugin through the 'Plugins' menu in WordPress.
3. Add a new page and add this short code <code>[wpoh_faq limit="-1"]</code>


== Frequently Asked Questions ==

= What templates FAQs are available? =

There is one templates named 'faq.php' which work like same as defult POST TYPE in wordpress.

You can also change the css as per your layout

= Are there shortcodes for FAQs items? =

Yes, Add a new faq page and add this short code <code>[wpoh_faq limit="-1"]</code>


== Screenshots ==
1. all Faqs
2. Add new Faq
3. How to add short code
4. Faq with category
5. preview faq


== Changelog ==
= 2.1 =
* Change Dashicon Icon 
* Change some css

= 1.0 =
* Initial release
* Adds custom post type
* Adds FAQs

== Upgrade Notice ==
= 2.0 =
added new css and js file
= 1.0 =
Initial release