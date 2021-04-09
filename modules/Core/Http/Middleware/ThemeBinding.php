<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;
use Shipu\Themevel\Middleware\RouteMiddleware;

class ThemeBinding extends RouteMiddleware
{
    public function handle($request, Closure $next, $themeName = null): mixed
    {
        $themeName = (null === $themeName) ? config('theme.active') : $themeName;

        if (null !== $themeName) {
            $this->publishThemeHelpers($themeName);
            $this->publishThemeConfigs($themeName);

            foreach (modules()->getOrdered() as $module) {
                /**
                 * Order priority for resources selection :
                 * 1. Inside theme in /themes/THEME_NAME/view/modules/MODULE_NAME
                 * 2. With default laravel resources in /resources/views/modules/MODULE_NAME
                 * 3. Inside the module himself in /modules/MODULE_NAME/Resources/view
                 */
                view()->replaceNamespace($module->getLowerName(), [
                    themevel()->get($themeName)['path'] . '/views/modules/' . $module->getLowerName(),
                    base_path('resources/views/modules/' . $module->getLowerName()),
                    $module->getPath() . '/Resources/views'
                ]);
            }
        }

        return parent::handle($request, $next, $themeName);
    }

    private function publishThemeHelpers(string $themeName): void
    {
        $themePath = themevel()->get($themeName)['path'];

        // Way to get all function (functional)  helper of current theme
        if (file_exists($themePath .  '/helpers.php')) {
            require_once $themePath .  '/helpers.php';
        }
    }

    private function publishThemeConfigs(string $themeName): void {
        $themeInfo = themevel()->get($themeName);

        $configPath = ($themeInfo['path'] ?? theme_path('')). '/config';

        if (is_dir($configPath)) {
            $configFiles = File::allFiles($configPath);

            foreach ($configFiles as $configFile) {
                if ($configFile->isFile() && $configFile->getExtension() === 'php') {
                    $fileName = $configFile->getFilenameWithoutExtension();
                    config()->set('wowlf.theme' . '.' . $fileName, require $configFile->getRealPath());
                }
            }
        }
    }
}
