<?php

/**
 * HTML Minify Class
 *
 * @since      1.0.4
 * @package    Clearfy
 * @author     WPShop.biz <support@wpshop.biz>
 */
class Clearfy_HTML_Minify {

    protected $html;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.4
     */
    public function __construct() {
        add_action('get_header', array( $this, 'html_minify_start' ));
    }

    public function html_minify_start() {
        ob_start( array( $this, 'minify' ) );
    }

    /**
     * Minify
     *
     * @ver 1.2.1
     * @author Chris Ferdinandi
     * @param $html
     * @return string
     */
    public function minify( $html ) {

        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);

        $html = '';
        $overriding = false;
        $raw_tag = false;

        $compress_css = true;
        $remove_comments = false;
        $compress_js = false;

        foreach ($matches as $token) {
            $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;

            $content = $token[0];

            if (is_null($tag)) {
                if ( !empty($token['script']) ) {
                    $strip = $compress_js;
                }
                else if ( !empty($token['style']) ) {
                    $strip = $compress_css;
                }
                else if ($content == '<!--wp-html-compression no compression-->') {
                    $overriding = !$overriding;

                    // Don't print the comment
                    continue;
                }
                else if ($remove_comments) {
                    if (!$overriding && $raw_tag != 'textarea') {
                        // Remove any HTML comments, except MSIE conditional comments
                        $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                    }
                }
            }
            else {
                if ($tag == 'pre' || $tag == 'textarea') {
                    $raw_tag = $tag;
                }
                else if ($tag == '/pre' || $tag == '/textarea') {
                    $raw_tag = false;
                }
                else {
                    if ($raw_tag || $overriding) {
                        $strip = false;
                    }
                    else {
                        $strip = true;

                        // Remove any empty attributes, except:
                        // action, alt, content, src
                        $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc|\bvalue|\bitemscope)="")/', '$1', $content);

                        // Remove any space before the end of self-closing XHTML tags
                        // JavaScript excluded
                        $content = str_replace(' />', '/>', $content);
                    }
                }
            }

            if ($strip) {
                $content = $this->remove_spaces($content);
            }

            $html .= $content;
        }

        return $html;
    }

    protected function remove_spaces( $text ) {
        $text = str_replace("\t", ' ', $text);
        $text = str_replace("\n",  ' ', $text);
        $text = str_replace("\r",  ' ', $text);

        while ( stristr($text, '  ') ) {
            $text = str_replace('  ', ' ', $text);
        }

        return $text;
    }
}
new Clearfy_HTML_Minify;