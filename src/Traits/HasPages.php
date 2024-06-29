<?php

namespace Pages\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Pages\Models\Page;

trait HasPages
{
    // public static function bootHasPages()
    // {
    //     static::created(function (Model $model) {

    //         $keyName = $model->getKeyName();

    //         Page::create([
    //             'title' => $model->page->title,
    //             'description' => $model->page->description,
    //             'slug' => $model->page->slug,
    //             'model_type' => static::class,
    //             'model_id' => $model->$keyName,
    //             'status' => 'published',
    //             'parent_id' => $model->parent()->id
    //         ]);
    //     });
    // }

    public function page(): MorphOne
    {
        return $this->morphOne(Page::class, 'modelable');
    }
}
