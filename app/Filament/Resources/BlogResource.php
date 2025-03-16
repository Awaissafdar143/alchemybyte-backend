<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Blog;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Services\ChatGPTService;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BlogResource\Pages;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogResource\RelationManagers;



class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                        TextInput::make('Title')
                            ->live() // Allows real-time updates
                            ->suffixAction( // ✅ Adds an icon-only button
                                Action::make('generateContent')
                                    ->icon('heroicon-o-sparkles') // Use a ChatGPT-style icon
                                    ->tooltip('Generate Blog Content') // Shows text on hover
                                    ->action(function ($set, $get) {
                                        $chatGPTService = new ChatGPTService();
                                        $generatedContent = $chatGPTService->generateBlogContent($get('Title'));
                                        $set('content', $generatedContent);
                                    })
                            ),

                        TextInput::make('description'),
                        TextInput::make('keyword'),
                        TextInput::make('slug'),
                        FileUpload::make('Image')->image()->imageEditor()->directory('blog'),
                        RichEditor::make('content')
                            ->fileAttachmentsDisk('s3')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('private'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Title'),
                TextColumn::make('description'),
                TextColumn::make('keyword'),
                ImageColumn::make('Image'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
