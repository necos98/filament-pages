<?php

namespace Pages\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Pages\Facades\Pages;
use Pages\Models\ModelTranslation;
use Pages\Models\Page;

trait HasTranslations
{
    public static function bootHasTranslations()
    {
        // static::saving();

        static::deleted(function (Model $model) {
            $model->forceDeleteAll();
        });
    }

    public function translations(string $lang): MorphMany
    {
        return $this->morphMany(ModelTranslation::class, 'modelable')->where("lang", $lang);
    }

    public function getTranslations(string $lang)
    {
        return $this->translations($lang)->get(["key", "value"]);
    }

    public function translationsExists(string $lang)
    {
        return $this->translations($lang)->exists();
    }

    public function getTranslatedModel(string $lang): ?Model
    {
        $translatedFields = $this->getTranslations($lang);

        if (!$translatedFields->isEmpty()) {
            foreach ($translatedFields as $field) {
                $this->{$field->key} = $field->value;
            }
        } else {
            return null;
        }

        return $this;
    }

    public function getTranslableFields()
    {
        return isset($this->translableFields) ? $this->translableFields : [];
    }

    public function syncTranslations(string $lang, array $data)
    {
        foreach ($data as $key => $value) {
            ModelTranslation::updateOrCreate([
                "modelable_type" => static::class,
                "modelable_id" => $this->getKey(),
                "lang" => $lang,
                "key" => $key
            ], [
                "value" => $value
            ]);
        }
    }

    public function forceDeleteAll()
    {
        foreach (Pages::getLocaleTranslations() as $lang) {
            $this->translations($lang)?->forceDelete();
        }
    }
}
