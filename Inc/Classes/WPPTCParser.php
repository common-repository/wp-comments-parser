<?php

namespace WPPTC\Inc\Classes;

use phpQuery;
use WPPTC\Inc\DbClasses\WPPTCCommonDbClass;

/**
 * Class WPPTCParser
 * @package WPPTC\Inc\Classes
 * Parser
 */
class WPPTCParser
{
    private $WPPTCDbWorker;

    public function __construct()
    {
        $this->WPPTCDbWorker = new WPPTCCommonDbClass();
    }

    public function urlResponse($url)
    {
        $comment_array = [];
        $domain = $this->getDomain($url);
        $open_comment = $this->getFirstCommentLink($url, $domain);
        $items_comment = phpQuery::newDocument($open_comment['body']);

        for ($i = 1; $i <= WPPTC_COUNT_COMMENTS_PAGES; $i++) {
            foreach ($items_comment->find('.ppr_rup.ppr_priv_location_reviews_container .review-container') as $item_comments) {
                $domComments = pq($item_comments);
                $comment_array[] = $this->parseCommentInfo($domComments);
            }
            if($i < WPPTC_COUNT_COMMENTS_PAGES) {
                $pagination = $items_comment->find('.unified.pagination.north_star .nav.next.taLnk')->attr('href');
                $doc_pag_a = $domain . $pagination;
                $open_a = $this->getResponse($doc_pag_a);
                $items_comment = phpQuery::newDocument($open_a['body']);
            }

        }
        $this->insertComment($comment_array);
    }
    
    private function getDomain($url)
    {
        $explode_url = explode('/', $url);
        $getDomain = $explode_url[0].'//'.$explode_url[2];
        return $getDomain;
    }

    private function getFirstCommentLink($url, $domain)
    {
        $response = $this->getResponse($url);
        $doc = phpQuery::newDocument($response['body']);
        $comments = $doc->find('.listContainer .review-container');
        $pq = pq($comments[0]);
        $a = $pq->find('.quote a')->attr('href');
        $site_url = $domain . $a;
        return $this->getResponse($site_url);
    }

    private function parseCommentInfo($pq2)
    {
        $rat = $pq2->find('span.ui_bubble_rating')->attr('class');
        $item['title'] = $pq2->find('span.noQuotes')->text();
        $item['description'] = $pq2->find('.wrap > .prw_reviews_text_summary_hsx')->text();
        $item['raiting'] = $this->getRating($rat);
        return $item;
    }

    private function getRating($rat)
    {
        $rate_xplode = explode(' ', $rat);
        array_shift($rate_xplode);
        $rate_xplode_ar = explode('_', $rate_xplode[0]);
        $rating = array_pop($rate_xplode_ar);
        return $rating;
    }

    private function insertComment($comment_array)
    {
        $this->WPPTCDbWorker->drop();
        foreach ($comment_array as $comment) {
            $this->WPPTCDbWorker->create($comment);
        }
    }

    private function getResponse($url){
        $getResponse = wp_remote_post( $url, array(
                'method' => 'GET',
                'timeout' => 45,
                'redirection' => 5,
                'blocking' => true,
                'headers' => array("User-Agent" => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36"),
                'cookies' => array()
            )
        );
        return $getResponse;
    }
}