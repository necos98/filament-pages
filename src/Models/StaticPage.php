<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pages\Http\Controllers\PageController;
use Pages\Http\Controllers\StaticPageController;
use Pages\Interfaces\PageInterface;
use Pages\Traits\HasPages;

class StaticPage extends Model implements PageInterface
{
    use HasPages;

    protected $fillable = ['text_1', 'text_2', 'text_3'];

    // public function title(): string
    // {
    //     return $this->title;
    // }

    // public function description(): string
    // {
    //     return $this->description;
    // }

    // public function slug(): string
    // {
    //     return $this->slug;
    // }

    // public function parent(): ?Page
    // {
    //     return null;
    // }
    
    public function pageController(): string
    {
        return StaticPageController::class;
    }
}
