<?php

namespace Pages;

use Illuminate\Support\Facades\File;

class Pages
{
    public function getLocaleTranslations()
    {
        return config("pages.locale_translations");
    }

    public function isEnabledLocale(?string $lang = null): bool
    {
        return in_array($lang, $this->getLocaleTranslations());
    }

    public function getViews(): array
    {

        $projectViews = collect(File::allFiles(resource_path('views')))->map(function ($view) {

            $replaced = str_replace(".blade.php", "", $view->getRelativePathname());
            $replaced = str_replace("\\", ".", $replaced);

            return $replaced;
        });

        $packageViews = collect(File::allFiles(__DIR__ . "/../resources/views"))->map(function ($view) {

            $replaced = str_replace(".blade.php", "", $view->getRelativePathname());
            $replaced = str_replace("\\", ".", $replaced);

            return PagesServiceProvider::$viewNamespace . "::" . $replaced;
        });

        return array_merge(
            $projectViews->toArray(),
            $packageViews->toArray()
        );
    }
}
