<?php

namespace WPPTC\Inc\Classes;
/**
 * Class WPPTCFilterRaiting
 * @package WPPTC\Inc\Classes
 * Filter stars rating
 */
class WPPTCFilterRaiting
{
    public function raitingStarsFilter($rait)
    {
        $raitFilter_05 = '<span class="fa fa-star checked-half"></span>';
        $raitFilter_10 = '<span class="fa fa-star checked"></span>';
        $raitFilter_00 = '<span class="fa fa-star"></span>';

        switch($rait){
            case 05: $raitFilter = $raitFilter_05.$raitFilter_00.$raitFilter_00.$raitFilter_00.$raitFilter_00; break;
            case 10: $raitFilter = $raitFilter_10.$raitFilter_00.$raitFilter_00.$raitFilter_00.$raitFilter_00; break;
            case 15: $raitFilter = $raitFilter_10.$raitFilter_05.$raitFilter_00.$raitFilter_00.$raitFilter_00; break;
            case 20: $raitFilter = $raitFilter_10.$raitFilter_10.$raitFilter_00.$raitFilter_00.$raitFilter_00; break;
            case 25: $raitFilter = $raitFilter_10.$raitFilter_10.$raitFilter_05.$raitFilter_00.$raitFilter_00; break;
            case 30: $raitFilter = $raitFilter_10.$raitFilter_10.$raitFilter_10.$raitFilter_00.$raitFilter_00; break;
            case 35: $raitFilter = $raitFilter_10.$raitFilter_10.$raitFilter_10.$raitFilter_05.$raitFilter_00; break;
            case 40: $raitFilter = $raitFilter_10.$raitFilter_10.$raitFilter_10.$raitFilter_10.$raitFilter_00; break;
            case 45: $raitFilter = $raitFilter_10.$raitFilter_10.$raitFilter_10.$raitFilter_10.$raitFilter_05; break;
            case 50: $raitFilter = $raitFilter_10.$raitFilter_10.$raitFilter_10.$raitFilter_10.$raitFilter_10; break;
            default: $raitFilter = 'Not Rated';
        }

        return $raitFilter;
    }
}