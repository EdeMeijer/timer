<?php

namespace App\Utils\Navigation;

/**
 * Represents a set of navigation options, e.g. a top menu
 */
class Navigation
{
    /** @var NavigationItem[] */
    private $items;

    /**
     * @param NavigationItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return NavigationItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function activate(string $currentRoute): Navigation
    {
        foreach ($this->items as $item)
        {
            if ($item->getRoute() === $currentRoute) {
                $item->activate();
                break;
            }
        }
        return $this;
    }
}
