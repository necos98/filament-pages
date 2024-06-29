<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Model;

class PageLang extends Model
{
    protected $fillable = [
        'title',
        'description',
        'page_id',
        'lang',
        'slug',
        'url'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function generateFullUrl()
    {
        $parent = $this->page->parent;

        if ($parent && $parent->hasTranslation($this->lang)) {

            $parentLang = $parent->getTranslation($this->lang);

            return rtrim($parentLang->url, '/') . '/' . $this->slug;
        }
        return $this->slug;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($pageLang) {
            $pageLang->url = $pageLang->generateFullUrl();
        });

        static::saved(function ($pageLang) {
            $pageLang->page->save();
        });
    }
}
