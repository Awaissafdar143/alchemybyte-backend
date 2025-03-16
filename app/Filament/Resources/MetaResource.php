<?php

namespace App\Filament\Resources;

use App\Models\Meta;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Services\OpenAIService;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\MetaResource\Pages;

class MetaResource extends Resource
{
    protected static ?string $model = Meta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // ✅ Disable "Create" Button
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns([
                        'sm' => 1,
                        'xl' => 1,
                        '2xl' => 1,
                    ])->schema([
                        // ✅ Disable "Page Name" When Editing
                        TextInput::make('page_name')
                            ->label('Page Name')
                            ->disabled(fn($record) => $record !== null) // Disable only when editing
                            ->required(),

                        TextInput::make('Title')
                            ->maxLength(50)
                            ->suffixAction(
                                Action::make('Generate Title')
                                    ->icon('heroicon-o-sparkles')
                                    ->color('primary')
                                    ->tooltip('Generate SEO Title using AI')
                                    ->action(function ($set, $get) {
                                        $aiService = new OpenAIService();
                                        $generatedTitle = $aiService->generateBlogContent("SEO title for " . $get('page_name'), "");
                                        $set('Title', $generatedTitle);
                                    })
                            ),

                        TextInput::make('description')
                            ->maxLength(80)
                            ->suffixAction(
                                Action::make('Generate Description')
                                    ->icon('heroicon-o-sparkles')
                                    ->color('primary')
                                    ->tooltip('Generate SEO Description using AI')
                                    ->action(function ($set, $get) {
                                        $aiService = new OpenAIService();
                                        $generatedDescription = $aiService->generateBlogContent("SEO description for " . $get('page_name'), "");
                                        $set('description', $generatedDescription);
                                    })
                            ),

                        TextInput::make('keyword')
                            ->suffixAction(
                                Action::make('Generate Keywords')
                                    ->icon('heroicon-o-sparkles')
                                    ->color('primary')
                                    ->tooltip('Generate SEO Keywords using AI')
                                    ->action(function ($set, $get) {
                                        $aiService = new OpenAIService();
                                        $generatedKeywords = $aiService->generateBlogContent("SEO keywords for " . $get('page_name'), "");
                                        $set('keyword', $generatedKeywords);
                                    })
                            ),

                        FileUpload::make('OgImage')->directory('seo')->ImageEditor(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page_name')->label("Page Name"),
                TextColumn::make('Title')->formatStateUsing(fn($state) => Str::limit($state, 30, '...')),
                TextColumn::make('description')
                    ->label('Description')
                    ->formatStateUsing(fn($state) => Str::limit($state, 30, '...')),
                TextColumn::make('keyword'),
                ImageColumn::make('OgImage'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMetas::route('/'),
            // 'create' => Pages\CreateMeta::route('/create'),
            'edit' => Pages\EditMeta::route('/{record}/edit'),
        ];
    }
}
