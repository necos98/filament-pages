<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'slug', 'model_type', 'model_id', 'status', 'page_type_id', 'parent_id', 'url'];

    public function modelable()
    {
        return $this->morphTo();
    }

    public function pageType()
    {
        return $this->belongsTo(PageType::class);
    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function meta()
    {
        return $this->hasMany(PageMeta::class);
    }

    public function translations()
    {
        return $this->hasMany(PageLang::class);
    }

    public function translation(string $lang)
    {
        return $this->hasOne(PageLang::class)->where("lang", $lang);
    }

    public function generateFullUrl()
    {
        if ($this->parent) {
            return rtrim($this->parent->url, '/') . '/' . $this->slug;
        }
        return $this->slug;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($page) {
            $page->url = $page->generateFullUrl();
        });

        static::saved(function ($page) {
            foreach ($page->children as $child) {
                $child->save();

                if(!$child->translations->isEmpty()){
                    foreach($child->translations as $translation){
                        $translation->save();
                    }
                }
            }
        });
    }

    public function getTranslation(string $lang): ?PageLang
    {
        return $this->translation($lang)->first();
    }

    public function hasTranslation(string $lang): bool
    {
        return $this->translation($lang)->exists();
    }
}
