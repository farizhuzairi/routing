<?php

use Illuminate\Support\Facades\Route;

$routes = routing()?->routeCases();

if(! $routes->isEmpty()) {
    foreach($routes as $__routeName => $i) {

        if(! empty($i['__data'])) {

            Route::{$i['httpMethod']}(
                $i['endpoint'],
                [$i['__data']['controller'], $i['__data']['method']]
            )->name($__routeName)->middleware($i['__data']['middleware']);

        }

    }
}