<?php

namespace Framework\Router;

/**
 * Represent a route
 */
class Route
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var
     */
    private $callback;
    /**
     * @var array
     */
    private array $parameters;

    /**
     * @param string $name
     * @param $callback
     * @param array $parameters
     */
    public function __construct(string $name, $callback, array $parameters)
    {
        $this->name = $name;
        $this->callback = $callback;
        $this->parameters = $parameters;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        if ($this->name) {
            return $this->name;
        }
        return null;
    }

    /**
     * @return string | callable
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * get parameters List
     * @return array
     */
    public function getParams(): array
    {
        return $this->parameters;
    }
}
