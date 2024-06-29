<?php

namespace Pages\Support;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Pages\Models\Page as ModelsPage;

abstract class Page extends Controller
{
    protected ModelsPage $page;
    protected Model $bindedModel;

    protected function getTitle()
    {
        return $this->page->title;
    }

    protected function getDescription()
    {
        return $this->page->description;
    }

    protected abstract function content(): View;

    public function handle(ModelsPage $page, Model $bindedModel)
    {
        $this->page = $page;
        $this->bindedModel = $bindedModel;

        return view("pages::base",[
            "content" => $this->content(),
            "title" => $this->getTitle(),
            "description" => $this->getDescription(),
        ]);
    }
}
