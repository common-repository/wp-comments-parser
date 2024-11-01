<?php

namespace WPPTC\Inc\Classes;

use WPPTC\Inc\DbClasses\WPPTCCommonDbClass;

/**
 * Class WPPTCFrontController
 * @package WPPTC\Inc\Classes
 * Output of comments
 */
class WPPTCFrontController
{
    private $commentsDb;
    protected $filterRaiting;
    
    public function __construct()
    {
        $this->commentsDb = new WPPTCCommonDbClass();
        $this->filterRaiting = new WPPTCFilterRaiting();
    }

    private function pars_get_local_file_contents($file_path, $data = [])
    {
        ob_start();
        include $file_path;
        $contents = ob_get_clean();

        return $contents;
    }

    private function getResultParser($results)
    {
        $pretext = esc_attr(get_option('WPPTCShortCode'));
        $getResultParser = '';

        $getResultParser .= $this->pars_get_local_file_contents(WPPTC_T_FRONT_PATH . 'shortcodeStartwrap.php');

        foreach ($results as $item) {
            $getResultParser .= $this->pars_get_local_file_contents(WPPTC_T_FRONT_PATH . 'shortcodeLoop.php', array('title' => $item['title'],'raiting' => $this->filterRaiting->raitingStarsFilter($item['raiting']), 'description' => $item['description']));
        }

        $getResultParser .= $this->pars_get_local_file_contents(WPPTC_T_FRONT_PATH . 'shortcodeFinishwrap.php', array('pretext' => $pretext));

        return $getResultParser;
    }
    
    public function frontComments(){
        $results = $this->commentsDb->getComments();
        
        $getResultParser = $this->getResultParser($results);
        return $getResultParser;
    }
}
