<?php

namespace Hascha\Routing;

use Hascha\Routing\Service\RouteService;
use Hascha\Routing\Service\Contracts\Pageable;

class PageableData extends RouteService implements Pageable
{
    protected function pages(): array
    {
        return [

            "index" => [
                "headTitle" => "Home Page | My Web",
                "intro" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Earum, labore! Nobis, explicabo!",
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, harum fuga laboriosam sed odio aspernatur nesciunt tenetur rerum quaerat explicabo sunt et. Blanditiis hic quibusdam veritatis esse iure neque quis, nesciunt iusto vel officiis quisquam sint!",
                "controller" => null,
                "function" => null,
                "middleware" => [],
            ],

        ];
    }
}