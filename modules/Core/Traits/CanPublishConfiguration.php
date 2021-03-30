<?php

namespace Modules\Core\Traits;

use JetBrains\PhpStorm\NoReturn;

trait CanPublishConfiguration
{
    public function publishConfig(string $fileName): void
    {
        $module = $this->moduleNameLower;

        $this->mergeConfigFrom($this->getModuleConfigFilePath($module, $fileName), strtolower("wowlf.$module.$fileName"));
        $this->publishes([
            $this->getModuleConfigFilePath($module, $fileName) => config_path(strtolower("wowlf/$module/$fileName") . '.php'),
        ], 'config');
    }

    private function getModuleConfigFilePath(string $module, string $file): string
    {
        return $this->getModulePath($module) . "/Config/$file.php";
    }

    private function getModulePath(string $module): string
    {
        return base_path('modules' . DIRECTORY_SEPARATOR . ucfirst($module));
    }
}
