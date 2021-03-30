<?php

namespace Modules\Core\Theme;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ThemeManager implements \Countable
{
    private Application $app;
    private string $path;

    public function __construct(Application $app, string $path)
    {
        $this->app = $app;
        $this->path = $path;
    }

    public function find(string $name): ?Theme
    {
        foreach ($this->all() as $theme) {
            if ($theme->getLowerName() == strtolower($name)) {
                return $theme;
            }
        }

        return null;
    }

    public function all(): array
    {
        $themes = [];
        if (!$this->getFinder()->isDirectory($this->path)) {
            return $themes;
        }

        $directories = $this->getDirectories();

        foreach ($directories as $theme) {
            if (Str::startsWith($name = basename($theme), '.')) {
                continue;
            }

            $themes[$name] = new Theme($name, $theme);
        }

        return $themes;
    }

    private function getDirectories(): array
    {
        return $this->getFinder()->directories($this->path);
    }

    public function getAssetPath(string $theme): string
    {
        return public_path($this->getConfig()->get('themify.themes_assets_path') . '/' . $theme);
    }

    protected function getFinder(): Filesystem
    {
        return $this->app['files'];
    }

    protected function getConfig(): Repository
    {
        return $this->app['config'];
    }

    public function count(): int
    {
        return count($this->all());
    }

    private function getThemeJsonFile(string $theme): ?array
    {
        try {
            return json_decode($this->getFinder()->get("$theme/theme.json"));
        } catch (FileNotFoundException $e) {
            return null;
        }
    }
}
