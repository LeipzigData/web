== ld-plugin ==
Contributors: Hans-Gert Gräbe, Leipzig
Tags: semantic content, semantic web, rdf, sparql, linked data, open data, triplestore 
Requires at least: 2.7
Tested up to: 4.8.
Stable tag: 1.0

== Description ==

A collection of WP shortcodes, one per file, to create different views on the
Leipzig-Data RDF database for its Wordpress site.

Each shortcode is defined in a separate PHP file that ends with a shortcode
declaration and a test that can be operated standalone from the command line.

All shortcodes are collected in the main.php by include statements and thus can
easily be switched on or off. 

== Installation and Configuration ==

Copy this directory as subdirectory to the plugin dir of the WP site and call
`composer update`. 
