<?php

namespace Hascha\Routing\Service\Traits;

trait Routerable
{
    protected const SEPARATOR = "#";
    protected const DEFAULT_HTTP_METHOD = "get";
    protected const DEFAULT_ENDPOINT = "/";
    
    public static function data(): array
    {
        return array_combine(
            array_column(static::cases(), 'name'),
            array_column(static::cases(), 'value'),
        );
    }

    public static function on(?string $routeName = null): static|null
    {
        if(empty($routeName)) {
            $routeName = \Illuminate\Support\Facades\Route::currentRouteName();
        }

        $data = static::cases();
        foreach($data as $key => $case) {
            if($case->route() === $routeName) {
                return $case;
            }
        }

        return null;
    }

    protected function get(): array
    {
        $explode = [];

        try {
            $explode = explode(static::SEPARATOR, $this->value);
        } catch (\Throwable $th) {
            return [];
        }

        return (array) $explode;
    }
    
    public function route(): string
    {
        $result = $this->get();
        if(empty($result) || ! isset($result[0])) return "";

        return trim($result[0]);
    }

    public function url(array $params = []): string
    {
        $route = $this->route();

        if(empty($route)) {
            return "";
        }

        if(! empty($params)) {
            return route($route, $params);
        }

        return route($route);
    }

    public function httpMethod(): string
    {
        $result = $this->get();
        if(empty($result) || ! isset($result[1])) return static::DEFAULT_HTTP_METHOD;

        return trim($result[1]);
    }

    public function endpoint(): string
    {
        $result = $this->get();
        if(empty($result) || ! isset($result[2])) return static::DEFAULT_ENDPOINT;

        return trim($result[2]);
    }

    public function pageName(): string
    {
        $result = $this->get();
        if(empty($result) || ! isset($result[3])) return "";

        return trim($result[3]);
    }

    public function pageTitle(): string
    {
        $result = $this->get();
        if(empty($result) || ! isset($result[4])) return "";

        return trim($result[4]);
    }
}