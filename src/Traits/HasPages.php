<?php

namespace Pages\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Pages\Models\Page;

trait HasPages
{
    public static function bootHasPages()
    {
        static::deleted(function (Model $model) {
            $model->page->forceDelete();
        });
    }

    public function page(): MorphOne
    {
        return $this->morphOne(Page::class, 'modelable');
    }
}
