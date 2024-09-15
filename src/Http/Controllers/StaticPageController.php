<?php

namespace Pages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Pages\Models\StaticPage;
use Pages\Support\Page;

class StaticPageController extends Page
{
    protected function content(): View
    {
        return view($this->bindedModel->view);
    }
}
