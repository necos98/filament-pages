<?php

namespace Pages\Filament\Resources;

use App\Filament\Resources\PatientResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use Pages\Filament\Resources\StaticPageResource\RelationManagers\PageRelationManager;
use Pages\Models\Page;
use Pages\Models\StaticPage;

class StaticPageResource extends Resource
{
    protected static ?string $model = StaticPage::class;

    protected static ?string $navigationIcon = 'heroicon-s-folder-minus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Info pagina')
                    ->relationship('page')
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->label("Slug")
                            ->required()
                            ->columnSpan(2)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('title')
                            ->label("Titolo")
                            ->required()
                            ->columnSpan(2),
                        Forms\Components\Textarea::make('description')
                            ->label("Descrizione SEO")
                            ->required()
                            ->columnSpanFull(),
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
                    ]),
                // Forms\Components\TextInput::make('page.title'),
                // Forms\Components\TextInput::make('page.description'),
                Forms\Components\RichEditor::make('text_1')
                    ->label("Testo 1")
                    ->required()
                    ->rules(
                        "string"
                    )
                    ->columnSpan("12"),
                Forms\Components\DatePicker::make('published_at')
                    ->label("Pubblicato il")
                // Forms\Components\RichEditor::make('text_2')
                //     ->label("Testo 2"),
                // Forms\Components\RichEditor::make('text_3')
                //     ->label("Testo 3"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page.slug')->label("Slug")->searchable()->sortable(),
                Tables\Columns\TextColumn::make('page.title')->label("Titolo")->searchable()->sortable(),
                Tables\Columns\TextColumn::make('page.description')->label("Descrizione SEO")->searchable()->sortable(),
                Tables\Columns\TextColumn::make('page.created_at')->label("Data creazione")->sortable(),
                Tables\Columns\TextColumn::make('page.updated_at')->label("Data modifica")->sortable(),
            ])
            ->filters([
                // Tables\Filters\SelectFilter::make('type')
                //     ->options([
                //         'cat' => 'Cat',
                //         'dog' => 'Dog',
                //         'rabbit' => 'Rabbit',
                //     ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // PageRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Pages\Filament\Resources\StaticPageResource\Pages\ListStaticPage::route('/'),
            'create' => \Pages\Filament\Resources\StaticPageResource\Pages\CreateStaticPage::route('/create'),
            'edit' => \Pages\Filament\Resources\StaticPageResource\Pages\EditStaticPage::route('/{record}/edit'),
        ];
    }
}
