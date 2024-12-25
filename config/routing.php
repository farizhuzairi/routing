<?php

return [

    /**
     * Default Route Enumeration.
     * The default value will always be returned.
     * Only valid classes can be passed as route objects.
     * 
     */
    'enumeration_route' => \Hascha\Routing\Router::class,

    /**
     * Page Service,
     * where page data sources are defined as objects
     * 
     */
    'pageable_data' => \Hascha\Routing\PageableData::class,

    /**
     * Allows checking of user roles.
     * It is recommended to use Direction Package.
     * 
     */
    'user_role_allowed' => true,

];