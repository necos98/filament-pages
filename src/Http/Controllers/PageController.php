<?php

namespace Pages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Pages\Facades\Pages;
use Pages\Models\Page;
use Pages\Models\PageLang;
use ReflectionClass;

class PageController extends Controller
{
    public function handle($url)
    {
        $firstSegment = request()->segment(1);
        $hasLang = Pages::isEnabledLocale($firstSegment);

        if ($hasLang) {
            $page = PageLang::where('url', substr($url, strlen($firstSegment) + 1))->where('lang', $firstSegment)->firstOrFail()->page;
        } else {
            $page = Page::where('url', $url)->firstOrFail();
        }

        $modelType = $page->modelable_type;

        $reflectionClass = new ReflectionClass($modelType);
        $controllerName = $reflectionClass->newInstance()->pageController();

        $controller = app()->make($controllerName);

        $bindedModel = $modelType::find($page->modelable_id);

        if ($hasLang) {
            $bindedModel->getTranslatedModel($firstSegment);
        }

        return app()->call([$controller, "handle"], ['page' => $page, "bindedModel" => $bindedModel]);
    }
}
