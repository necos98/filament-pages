<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pages\Http\Controllers\PageController;
use Pages\Http\Controllers\StaticPageController;
use Pages\Interfaces\PageInterface;
use Pages\Traits\HasPages;
use Pages\Traits\HasTranslations;

class BuildablePageTranslation extends Model
{
    protected $casts = [
        'value' => 'json'
    ];
}
