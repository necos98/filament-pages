<?php

namespace Pages\Filament\Resources;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Pages\Filament\Resources\BuildablePageResource\Pages\CreateBuildablePage;
use Pages\Filament\Resources\BuildablePageResource\Pages\EditBuildablePage;
use Pages\Filament\Resources\BuildablePageResource\Pages\ListBuildablePage;
use Pages\Filament\Resources\BuildablePageResource\Pages\TranslateBuildablePage;
use Pages\Filament\Support\StaticPageResource as SupportStaticPageResource;
use Pages\Models\BuildablePage;

class BuildablePageResource extends SupportStaticPageResource
{
    protected static ?string $model = BuildablePage::class;

    protected static ?string $navigationIcon = 'heroicon-s-folder-minus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Builder::make('components')
                    ->blocks([
                        Builder\Block::make('heading')
                            ->schema([
                                TextInput::make('content')
                                    ->label('Heading')
                                    ->required(),
                                Select::make('level')
                                    ->options([
                                        'h1' => 'Heading 1',
                                        'h2' => 'Heading 2',
                                        'h3' => 'Heading 3',
                                        'h4' => 'Heading 4',
                                        'h5' => 'Heading 5',
                                        'h6' => 'Heading 6',
                                    ])
                                    ->required(),
                            ])
                            ->columns(2),
                        Builder\Block::make('paragraph')
                            ->schema([
                                Textarea::make('content')
                                    ->label('Paragraph')
                                    ->required(),
                            ]),
                        // Builder\Block::make('image')
                        //     ->schema([
                        //         FileUpload::make('url')
                        //             ->label('Image')
                        //             ->image()
                        //             ->required(),
                        //         TextInput::make('alt')
                        //             ->label('Alt text')
                        //             ->required(),
                        //     ]),
                    ])
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

        // dd(\Pages\Filament\Support\CreateOrUpdateTranslation::routePath());

        return [
            'index' => ListBuildablePage::route('/'),
            'create' => CreateBuildablePage::route('/create'),
            'edit' => EditBuildablePage::route('/{record}/edit'),
            // 'translate' => \Pages\Filament\Resources\StaticPageResource\Pages\TranslateStaticPage::translationRoute(),
            'translate' => TranslateBuildablePage::route('/{record}/translate/{lang}'),
        ];
    }
}
