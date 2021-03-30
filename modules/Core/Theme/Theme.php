<?php

namespace Modules\Core\Theme;

use JetBrains\PhpStorm\Pure;

class Theme
{
    private string $name;
    private string $path;

    #[Pure] public function __construct(string $name, string $path)
    {
        $this->name = $name;
        $this->path = realpath($path);
    }

    #[Pure] public function getName(): string
    {
        return ucfirst($this->name);
    }

    #[Pure] public function getPath(): string
    {
        return $this->path;
    }

    #[Pure] public function getLowerName(): string
    {
        return strtolower($this->name);
    }
}
