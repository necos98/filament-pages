<?php

namespace Pages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pages\Models\Page;
use Pages\Models\PageLang;
use ReflectionClass;

class PageController extends Controller
{
    public function handle($url, $lang)
    {
        $pageLang = PageLang::where('url', $url)->where('lang', $lang)->firstOrFail();

        $page = $pageLang->page;
        $modelType = $page->modelable_type;

        $reflectionClass = new ReflectionClass($modelType);
        $controllerName = $reflectionClass->newInstance()->pageController();

        $controller = app()->make($controllerName);

        return app()->call([$controller, "handle"], ['page' => $page, "bindedModel" => $modelType::find($page->modelable_id)]);
    }
}
