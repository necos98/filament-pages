<?php

namespace Pages\Filament\Support;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Pages\Filament\Forms\Components\Slug;
use Illuminate\Support\Str;

class StaticPageResource extends Resource
{

    public static function translableFields(): array
    {
        return [
            Forms\Components\TextInput::make('slug')
                ->label("Slug")
                ->required()
                ->columnSpan(2)
                ->afterStateUpdated(function (Set $set, ?string $state) {
                    $set('slug', Str::slug($state, "-"));
                }),

            Forms\Components\TextInput::make('title')
                ->label("Titolo")
                ->required()
                ->columnSpan(2),
            Forms\Components\Textarea::make('description')
                ->label("Descrizione SEO")
                ->required()
                ->columnSpanFull()
        ];
    }

    public static function upperFields(): array
    {
        return [
            Fieldset::make('Info pagina')
                ->relationship('page')
                ->schema(array_merge(self::translableFields(), [
                    Forms\Components\Select::make('parent_id')
                        ->relationship(name: 'parent', titleAttribute: 'url', ignoreRecord: true)
                        ->searchable()
                        ->preload(),
                    Forms\Components\ToggleButtons::make('status')
                        ->label("Stato")
                        ->options([
                            'draft' => 'In bozza',
                            'scheduled' => 'Schedulato',
                            'published' => 'Pubblicato'
                        ])->inline()
                        ->default("draft")
                ])),
        ];
    }
}
