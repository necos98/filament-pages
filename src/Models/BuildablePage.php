<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Pages\Http\Controllers\StaticPageController;
use Pages\Interfaces\PageInterface;
use Pages\Traits\HasPages;
use Pages\Traits\HasTranslations;

class BuildablePage extends Model implements PageInterface
{
    use HasPages, HasTranslations;

    protected $fillable = ['components'];

    public array $translableFields = [
        "components"
    ];

    protected $casts = [
        'components' => 'json'
    ];
    
    public function pageController(): string
    {
        return StaticPageController::class;
    }

    public function translations(string $lang): HasOne
    {
        return $this->hasOne(BuildablePageTranslation::class)->where("lang", $lang);
    }

    public function getTranslations(string $lang)
    {
        return $this->translations($lang)->get(["key", "value"]);
    }

    public function syncTranslations(string $lang, array $data)
    {
        foreach ($data as $key => $value) {
            BuildablePageTranslation::updateOrCreate([
                "buildable_page_id" => $this->id,
                "lang" => $lang,
                "key" => $key
            ], [
                "value" => $value
            ]);
        }
    }
}
