<?php
/**
 * @package AutoFix Greeklish Permalink 
 * @version 1.0
 */
/*
Plugin Name:  AutoFix Greeklish Permalink
Plugin URI:   https://github.com/akidrizi/greeklish-slug-fixer
Description:  Solves the issues where  post, page and term slugs are saved in Greek letters by auto converting them to Latin characters.
Version:      1.0
Author:       Akis Idrizi
Author URI:   https://github.com/akidrizi
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  greeklish-slug-fixer
*/

defined('ABSPATH') || exit;

function ai_get_greeklish_expressions() {

    return array(
        '/[αΑ][ιίΙΊ]/u' => 'e',
        '/[οΟΕε][ιίΙΊ]/u' => 'i',
        '/[αΑ][υύΥΎ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'af$1',
        '/[αΑ][υύΥΎ]/u' => 'av',
        '/[εΕ][υύΥΎ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'ef$1',
        '/[εΕ][υύΥΎ]/u' => 'ev',
        '/[οΟ][υύΥΎ]/u' => 'ou',
        '/(^|\s)[μΜ][πΠ]/u' => '$1b',
        '/[μΜ][πΠ](\s|$)/u' => 'b$1',
        '/[μΜ][πΠ]/u' => 'b',
        '/[νΝ][τΤ]/u' => 'nt',
        '/[τΤ][σΣ]/u' => 'ts',
        '/[τΤ][ζΖ]/u' => 'tz',
        '/[γΓ][γΓ]/u' => 'ng',
        '/[γΓ][κΚ]/u' => 'gk',
        '/[ηΗ][υΥ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'if$1',
        '/[ηΗ][υΥ]/u' => 'iu',
        '/[θΘ]/u' => 'th',
        '/[χΧ]/u' => 'ch',
        '/[ψΨ]/u' => 'ps',
        '/[αάΑΆ]/u' => 'a',
        '/[βΒ]/u' => 'v',
        '/[γΓ]/u' => 'g',
        '/[δΔ]/u' => 'd',
        '/[εέΕΈ]/u' => 'e',
        '/[ζΖ]/u' => 'z',
        '/[ηήΗΉ]/u' => 'i',
        '/[ιίϊΐΙΊΪ]/u' => 'i',
        '/[κΚ]/u' => 'k',
        '/[λΛ]/u' => 'l',
        '/[μΜ]/u' => 'm',
        '/[νΝ]/u' => 'n',
        '/[ξΞ]/u' => 'x',
        '/[οόΟΌ]/u' => 'o',
        '/[πΠ]/u' => 'p',
        '/[ρΡ]/u' => 'r',
        '/[σςΣ]/u' => 's',
        '/[τΤ]/u' => 't',
        '/[υύϋΰΥΎΫ]/u' => 'y',
        '/[φΦ]/iu' => 'f',
        '/[ωώ]/iu' => 'o',
    );
}

function ai_filter_sanitize_title($title) {
    if (!is_admin())
        return $title;

    $expressions = ai_get_greeklish_expressions();
    $title = preg_replace( array_keys($expressions), array_values($expressions), $title );
    
    return $title;
}

add_filter('sanitize_title', 'ai_filter_sanitize_title', 1);
