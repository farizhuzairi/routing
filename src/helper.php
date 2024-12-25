<?php

use Hascha\Routing\Service\Contracts\Pageable;

if(! function_exists('routing')){

    function routing() {
        return app(Pageable::class);
    }

}