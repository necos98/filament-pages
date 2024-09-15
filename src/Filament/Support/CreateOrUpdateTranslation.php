<?php

namespace Pages\Filament\Support;

use App\Filament\Resources\CatResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Get;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\PageRegistration;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\Support\Htmlable;
use Pages\Filament\Resources\StaticPageResource;
use Pages\Models\PageLang;
use Pages\Models\Page as HttpPage;
use Throwable;

class CreateOrUpdateTranslation extends EditRecord
{

    public string $lang;
    public string $redirectUrl;
    // protected static string $resource = StaticPageResource::class;
    protected ?PageLang $translation = null;
    protected HttpPage $httpPage;

    public function getTitle(): string|Htmlable
    {
        return "Translation " . strtoupper($this->lang) . " - " . $this->getRecord()->page->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('translate')
                ->color("success")
                ->label("Visit page")
                ->url(function () {
                    return "/" . $this->lang . "/" . $this->translation->url;
                }, true)
                ->icon("heroicon-s-arrow-uturn-right")
                ->visible(!is_null($this->translation))
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            $this->getCancelFormAction()
        ];
    }

    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    {

        try {
            $this->beginDatabaseTransaction();

            $this->callHook('beforeValidate');

            $data = $this->form->getState(afterValidate: function () {
                $this->callHook('afterValidate');

                $this->callHook('beforeSave');
            });

            $data = $this->mutateFormDataBeforeSave($data);

            $pageLangData = $data["page_lang"];

            if ($pageLangData["page_lang_id"] != null) {
                PageLang::find($pageLangData["page_lang_id"])->update([
                    "title" => $pageLangData["title"],
                    "description" => $pageLangData["description"],
                    "slug" => $pageLangData["slug"],
                ]);
            } else {
                PageLang::create([
                    "page_id" => $pageLangData["page_id"],
                    "lang" => $pageLangData["lang"],
                    "title" => $pageLangData["title"],
                    "description" => $pageLangData["description"],
                    "slug" => $pageLangData["slug"],
                ]);
            }

            $translableFields = collect($data)->only(
                $this->getRecord()
                    ->getTranslableFields()
            );

            if (!$translableFields->isEmpty()) {
                $this->getRecord()->syncTranslations($pageLangData["lang"], $translableFields->toArray());
            }

            $this->callHook('afterSave');

            $this->commitDatabaseTransaction();
        } catch (Halt $exception) {
            $exception->shouldRollbackDatabaseTransaction() ?
                $this->rollBackDatabaseTransaction() :
                $this->commitDatabaseTransaction();

            return;
        } catch (Throwable $exception) {
            $this->rollBackDatabaseTransaction();

            throw $exception;
        }

        $this->rememberData();

        $this->getSavedNotification()?->send();

        $this->redirect($this->redirectUrl);
    }

    public function mount(int | string $record): void
    {
        $this->lang = request("lang");
        $this->record = $this->resolveRecord(request("record"));
        $this->httpPage = $this->record->page;
        $this->translation = $this->httpPage->getTranslation($this->lang);
        $modelTranslations = $this->record->getTranslatedModel($this->lang);

        $this->form->fill(array_merge([
            "page_lang" => [
                "lang" => $this->lang,
                "page_id" => $this->httpPage->id,
                "page_lang_id" => $this->translation?->id,
                "title" => $this->translation?->title,
                "description" => $this->translation?->description,
                "slug" => $this->translation?->slug,
            ]
        ], $modelTranslations != null ? $modelTranslations->attributesToArray() : []));

        $this->fill([
            "lang" => $this->lang,
            "translation" => $this->translation,
            "redirectUrl" => url()->current(),
        ]);
    }

    protected function getForms(): array
    {

        $resourceForm = static::getResource()::form(
            $this->makeForm()
                ->operation('create')
                ->model($this->getModel())
                ->statePath($this->getFormStatePath())
                ->columns($this->hasInlineLabels() ? 1 : 2)
                ->inlineLabel($this->hasInlineLabels()),
        );

        $form = $this->form($resourceForm);

        $translableFields = collect(static::getResource()::translableFields())
            ->add(Hidden::make("lang"))
            ->add(Hidden::make("page_id"))
            ->add(Hidden::make("page_lang_id"))
            ->map(function (Field $field) {

                // dd($this->translation);

                if ($field->getName() == "slug") {
                    $field->unique(
                        ignoreRecord: true,
                        table: "page_langs",
                        column: "slug",
                        ignorable: function (Get $get) {
                            return $this->getRecord()->page->getTranslation($get("page_lang.lang"));
                        },
                    );
                }

                $name = "page_lang." . $field->getName();

                return $field->name($name)->statePath($name);
            })->toArray();

        $form->components(array_merge(
            $translableFields,
            collect($form->getComponents())->filter(function ($field) {
                return collect($field->getExtraAttributes())->get('translate') ?? false;
            })->toArray(),
        ));

        return [
            'form' => $form,
        ];
    }

    // public static function translationRoute(): PageRegistration
    // {
    //     return \Pages\Filament\Support\CreateOrUpdateTranslation::route('/{record}/translate/{lang}');
    // }
}
