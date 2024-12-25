<?php

namespace Hascha\Routing\Service;

use Illuminate\Support\Collection;
use Hascha\Routing\Service\Traits\RouterCase;

abstract class RouteService
{
    /**
     * data halaman atau rute
     * yang dikunjungi
     * 
     * @var array
     */
    protected $visitData;

    /**
     * instance route <<enumeration>>
     * 
     * @var object
     */
    protected $router;

    /**
     * role as,
     * peran pengguna yang diatur dalam user model
     * atau enumeration class value
     * 
     * @var string|null
     */
    protected $as = null;

    /**
     * status izin akses halaman
     * 
     * @var bool
     */
    protected $pageAccess = false;

    use RouterCase;
    
    abstract protected function pages(): array;

    /**
     * diperlukan implementasi
     * saat dijalankan bersama dependency service provider,
     * atau middleware method
     * 
     */
    final public function setup(string $route, ?string $role = null): void
    {}

    public function visitData(): array
    {
        if(! isset($this->visitData)) return [];
        return $this->visitData ?? [];
    }

    public function router(): ?object
    {
        if(! isset($this->object)) return null;
        return $this->object;
    }

    final public function as(): string
    {
        return $this->as ?? "";
    }

    final public function pageAccess(): bool
    {
        return $this->pageAccess;
    }

    final public function instanceRouterDefault(): string
    {
        return config('routing.enumeration_route');
    }

    public function getRouterAccessor(): string
    {
        $customRouter = "\\App\\Routing\\Router";
        if(class_exists($customRouter)) {
            return $customRouter;
        }

        $defaultRoute = $this->instanceRouterDefault();
        if(empty($defaultClass)) {
            return \Hascha\Routing\Router::class;
        }

        return $defaultRoute;
    }

    final protected function pageCollection(array $only = []): Collection
    {
        $result = collect($this->pages());
        if(! empty($only)) {
            $result = $result->map(function (array $_val, string $_key) use ($only) {
                $r = collect($_val);
                $filter = $r->only($only);
                return $filter->all();
            });
        }

        return $result;
    }
}