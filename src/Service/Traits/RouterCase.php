<?php

namespace Hascha\Routing\Service\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

trait RouterCase
{
    final public function routeCases(bool $isArray = false): Collection|array
    {
        $cases = function ($routerEnum) {
            return $routerEnum::cases();
        };

        $hasPoint = function ($e) {
            if(empty($e)) {
                return "/";
            }
            return $e;
        };

        $pageCollection = $this->pageCollection(['controller', 'method', 'middleware']);
        $results = [];
        foreach($cases($this->getRouterAccessor()) as $_key => $_enum) {
            $_routeName = $_enum->route();
            $_epoint = $hasPoint($_enum->endPoint());
            $_data = $pageCollection->first(function (array $__i, string $__k) use ($_routeName) {
                return $__k === $_routeName;
            });
            $pre = [
                'indexOf' => Str::camel(strtolower($_enum->name)),
                'httpMethod' => $_enum->httpMethod(),
                'endpoint' => $_epoint,
                '__data' => $_data,
            ];

            if(! empty($_data)) $results[$_routeName] = $pre;
        }

        return $isArray ? $results : collect($results);
    }
}