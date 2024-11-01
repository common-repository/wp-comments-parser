<?php
namespace WPPTC\Inc\Classes;

use WP_Widget;

/**
 * Class WPPTCInitWidget
 * @package WPPTC\Inc\Classes
 * Init widget
 */
class WPPTCInitWidget extends WP_Widget
{
    public $WPPTCParser;
    public $getComments;
    
    function __construct()
    {
        $this->WPPTCParser = new WPPTCParser();
        $this->getComments = new WPPTCFrontController();

        parent::__construct(
            'WPPTCInitWidget',
            __('ParserComments', 'WPPTC'),
            array('description' => __('Display comments from tripadvisor', 'WPPTC'),)
        );
    }

    public function widget($args, $instance)
    {
        if ($this->getComments->frontComments() != NULL) {
            $parser_id_html = $this->getComments->frontComments();
            echo $parser_id_html;
        }else{
             _e('Such a comments does not exist! Check comments ID','WPPTC');
        }
    }
}