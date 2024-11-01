<?php

namespace WPPTC\Inc\Classes;
/**
 * Class WPPTCShortcode
 * @package WPPTC\Inc\Classes
 * Shortcode
 */
class WPPTCShortcode
{
    private $getComments;

    public function __construct()
    {
        $this->getComments = new WPPTCFrontController();
    }

    public function exec()
    {
        if ($this->getComments->frontComments() != NULL) {
            $parser_id_html = $this->getComments->frontComments();
            return $parser_id_html;
        }else{
            return __('Such a comments does not exist! Check comments ID','WPPTC');
        }
    }

}