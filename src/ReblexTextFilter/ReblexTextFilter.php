<?php

namespace reblex\ReblexTextfilter;

class ReblexTextFilter
{
    /**
     * Returned a filterd string.
     * @param  String $text          The original text.
     * @param  String $stringParams Comma separated string with wanted filters.
     * @return Filtered string.
     */
    public function parse($text, $filters)
    {
        if (is_string($filters)) {
            $filters = explode(",", $filters);
        }
        $newText = $text;
        for ($i=0; $i < count($filters); $i++) {
            switch ($filters[$i]) {
                case 'bbcode':
                    $newText = self::bbcodeToHtml($newText);
                    break;
                case 'markdown':
                    $newText = self::markdownToHtml($newText);
                    break;
                case 'link':
                    $newText = self::makeClickable($newText);
                    break;
                case 'nl2br':
                    $newText = nl2br($newText);
                    break;
            }
        }
        return $newText;
    }


    /**
     * Convert cccode to HTML
     * @param  String $text Original text
     * @return Formated string
     */
    public function bbcodeToHtml($text)
    {
        $search = [
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.+?)\[\/img\]/is',
            '/\[url\](https?.+?)\[\/url\]/is',
            '/\[url=(https?.+?)\](.+?)\[\/url\]/is'
        ];
        $replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" alt="">',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        ];
        return preg_replace($search, $replace, $text);
    }



    /**
     * Make clickable links from URLs in text.
     *
     * @param string $text the text that should be formatted.
     * @return string with formatted anchors.
     */
    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            create_function(
                '$matches',
                'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
            ),
            $text
        );
    }


    /**
     * Helper, Markdown formatting converting to HTML.
     *
     * @param string text The text to be converted.
     *
     * @return string the formatted text.
     */
    public static function markdownToHtml($text)
    {
        $markdown = new \Michelf\MarkdownExtra();
        return $markdown::defaultTransform($text);
    }
}
