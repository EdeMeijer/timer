<?php

namespace App\Utils\Navigation;

class NavigationItem
{
    /** @var string */
    private $route;
    /** @var string */
    private $name;
    /** @var bool */
    private $active = false;

    public function __construct(string $route, string $name)
    {
        $this->route = $route;
        $this->name = $name;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function activate()
    {
        $this->active = true;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}
