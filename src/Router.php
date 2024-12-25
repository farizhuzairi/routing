<?php

namespace Hascha\Routing;

enum Router : string
{
    use \Hascha\Routing\Service\Traits\Routerable;

    /*
    * Data format.
    * Apart from the route name and end-point,
    * the values ​​defined are optional.
    * [route_name] # [http_method] # [end_point] # [page_name] # [page_title]
    *
    */
    case INDEX = "index # get # / # Home # Home Page";
}