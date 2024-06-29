<?php

namespace Pages\Http\Controllers;

use App\Http\Controllers\Controller;
use Pages\Models\Page;
use Pages\Models\StaticPage;

class StaticPageController extends Controller
{
    public function handle(StaticPage $staticPage)
    {

        return $staticPage->text_1;
    }
}
