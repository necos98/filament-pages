<?php

namespace Pages\Traits;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Support\Enums\ActionSize;
use Pages\Facades\Pages;

trait HasHeaderActions
{
    use ManipulateHeaderActions;

    public function bootedHasHeaderActions()
    {
        $langActions = collect();
        $model = $this->getRecord();

        foreach (Pages::getLocaleTranslations() as $locale) {

            $translationsExists = $model->translationsExists($locale);

            $langActions->add(
                Action::make('translate')
                    ->label((!$translationsExists ? "Create" : "Edit") . ' ' . strtoupper($locale))
                    ->url(function ($record) use ($locale, $model) {
                        return static::getResource()::getUrl("translate", ["record" => $model, "lang" => $locale]);
                    })
                    ->icon($translationsExists ? "heroicon-o-check" : "heroicon-o-x-mark")
                    ->color($translationsExists ? "success" : "danger")
            );
        }

        $this->pushToFirst(ActionGroup::make($langActions->toArray())
            ->label('Translations')
            ->icon('heroicon-m-ellipsis-vertical')
            ->size(ActionSize::Small)
            ->color('primary')
            ->button());

        if ($model->page) {
            $this->pushToFirst(
                Action::make('translate')
                    ->color("success")
                    ->label("Visit page")
                    ->url(function () use ($model) {
                        return "/" . $model->page->url;
                    }, true)
                    ->icon("heroicon-s-arrow-uturn-right")
            );
        }
    }
}
