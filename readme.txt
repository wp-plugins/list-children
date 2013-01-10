=== List Children ===
Contributors: theandystratton
Donate link: http://theandystratton.com/donate
Tags: permalinks, list pages, nagivation, subnavigation
Requires at least: 2.6
Tested up to: 3.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: trunk


== Description ==

Use an HTML comment to list links of the current page's children or siblings.

Common usage is for content sites utilizing WordPress as a simple CMS. Some content hierarchies call for an Overview page followed by multiple subpages, for example, a Services page.

Use the following shortcodes to list children and or siblings of the current page:

Alphabetical listing of current page's children:

[list_children sort_column="page_title" sort_order="asc"]

List of current page's siblings, ordered by menu order (descending):

[list_siblings sort_column="menu_order" sort_order="desc"]

You can use a majority of the attributes from the wp_list_pages() call: http://codex.wordpress.org/Function_Reference/wp_list_pages

*The following will work for now but is deprecated:*

&lt;ul&gt;
&lt;!--list_children()--&gt;
&lt;/ul&gt;

== Installation ==

1. Download and unzip to the 'wp-content/plugins/' directory 
1. Activate the plugin.

== Frequently Asked Questions ==

= Can I include the current page in the list_siblings() call? =

Of course, use the following:

<code>[list_siblings exclude_me="false"]</code>
