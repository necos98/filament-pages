<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pages\Http\Controllers\PageController;
use Pages\Http\Controllers\StaticPageController;
use Pages\Interfaces\PageInterface;
use Pages\Traits\HasPages;
use Pages\Traits\HasTranslations;

class StaticPage extends Model implements PageInterface
{
    use HasPages, HasTranslations;

    protected $fillable = ['text_1', 'text_2', 'text_3'];

    public array $translableFields = [
        "text_1"
    ];

    public function pageController(): string
    {
        return StaticPageController::class;
    }
}
