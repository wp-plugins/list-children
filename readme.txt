=== List Children ===
Contributors: theandystratton
Donate link: http://theandystratton.com
Tags: 
Requires at least: 2.6
Tested up to: 2.7.1
Stable tag: trunk


== Description ==

Use an HTML comment to list links of the current page's children or siblings.

Common usage is for content sites utilizing WordPress as a simple CMS. Some content hierarchies call for an Overview page followed by multiple subpages, for example, a Services page.

Insert the following into your HTML tab when editing content to get a list of child pages:

&lt;ul&gt;
&lt;!--list_children()--&gt;
&lt;/ul&lt;

== Installation ==

1. Download and unzip to the 'wp-content/plugins/' directory 
1. Activate the plugin.

== Frequently Asked Questions ==

= Can I include the current page in the list_siblings() call? =

Yes. Simply add a "false" between the parentheses:

<code>&lt;!--list_siblings(false)--&gt;</code>

This tells the plugin to NOT exclude the current page when listing siblings.
