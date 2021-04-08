<?php

namespace Modules\Core\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\Core\Services\FormDataBinder;
use Modules\Core\Traits\CanPublishConfiguration;
use Nwidart\Modules\Module;

class CoreServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;

    protected string $moduleName = 'Core';
    protected string $moduleNameLower = 'core';
    protected array $middleware = [
        'Core' => [
            'theme' => 'ThemeMiddleware'
        ]
    ];

    public function boot(): void
    {
        $this->publishConfig('config');
        $this->publishConfig('core');
        $this->publishConfig('components');

        $this->registerMiddleware();
        $this->registerModulesResourcesNamespaces();
        $this->registerCustomizeBlade();
    }

    public function register(): void
    {
        $this->app->singleton('wowlf.isInstalled', function () {
            return true === config('wowlf.core.core.is_installed');
        });

        $this->app->singleton('wowlf.onAdmin', function () {
            $url = app(Request::class)->path();

            return Str::contains($url, config('wowlf.core.core.admin-url-prefix'));
        });

        $this->app->singleton(FormDataBinder::class, fn () => new FormDataBinder);
    }

    private function registerMiddleware(): void
    {
        foreach ($this->middleware as $module => $middlewares) {
            foreach ($middlewares as $name => $middleware) {
                $class = "Modules\\{$module}\\Http\\Middleware\\{$middleware}";
                router()->aliasMiddleware($name, $class);
            }
        }
    }

    private function registerModulesResourcesNamespaces(): void
    {
        foreach (modules()->getOrdered() as $module) {
            $this->registerViewNamespace($module);
            $this->registerLanguageNamespace($module);
        }
    }

    private function registerCustomizeBlade() {
        // Form components
        Blade::directive('bind', function ($bind) {
            return "<?php app(" . FormDataBinder::class . ")->bind($bind); ?>";
        });

        Blade::directive('endbind', function () {
            return "<?php app(" . FormDataBinder::class . ")->pop(); ?>";
        });

        Blade::directive('wire', function ($modifier) {
            return "<?php app(" . FormDataBinder::class . ")->wire($modifier); ?>";
        });

        Blade::directive('endwire', function () {
            return "<?php app(" . FormDataBinder::class . ")->endWire(); ?>";
        });

        Collection::make(config('wowlf.core.components.components'))->each(
            fn ($component, $componentName) => Blade::component($componentName, $component['class'])
        );
    }

    private function registerViewNamespace(Module $module)
    {
        $moduleName = $module->getLowerName();

        $configFile = 'config';
        $configKey = 'wowlf.' . $moduleName . '.' . $configFile;

        $this->mergeConfigFrom($module->getExtraPath('Config' . DIRECTORY_SEPARATOR . $configFile . '.php'), $configKey);

        /**
         * The ThemeMiddleware add theme view namespace with these current namespace describe bellow
         *
         * Order priority for resources selection :
         * 1. With default laravel resources in /resources/views/modules/MODULE_NAME
         * 2. Inside the module himself in /modules/MODULE_NAME/Resources/view
         */
        view()->addNamespace($moduleName, [
            base_path('resources/views/modules/' . $moduleName),
            $module->getPath() . '/Resources/views'
        ]);
    }

    private function registerLanguageNamespace(Module $module)
    {
        $moduleName = $module->getLowerName();

        $langPath = resource_path("lang/$moduleName");

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $moduleName);
        }

        $this->loadTranslationsFrom($module->getPath() . '/Resources/lang', $moduleName);
    }
}
