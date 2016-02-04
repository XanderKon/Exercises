<?php

/**
 * Simple page parser
 *  - count html tags
 *  - show html tags names
 *
 * Class Parser
 *
 * @author Kondratenko Alexander (Xander)
 */
Class Parser
{
    /**
     * Parse current url
     *
     * @param $url
     *
     * @return array|string
     *
     * @author Kondratenko Alexander (Xander)
     */
    private function parse($url)
    {
        $html = file_get_contents($url);
        preg_match_all('/<([^\/!][a-z1-9]*)/i', $html, $matches);

        if (empty($matches[1]))
        {
            return 'Can\'t parse this page...please try another url';
        }

        $result = array_count_values($matches[1]);
        return $result;
    }

    /**
     * Parse handler
     *
     * @param $url
     *
     * @author Kondratenko Alexander (Xander)
     */
    public function result($url)
    {
        echo '<pre>';
        var_dump($this->parse($url));
        echo '</pre>';
    }
}

$parser = new Parser;
$parser->result('http://php.net/');