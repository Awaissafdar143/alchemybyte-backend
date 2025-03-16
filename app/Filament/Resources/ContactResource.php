<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Contact;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\CheckboxColumn;
use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\MetaResource\Pages\CreateMeta;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false;
    }
    public static function canEdit($record): bool
{
    return false; // Disables editing for all records
}

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('created_at', 'desc');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('name')->sortable(),
                TextColumn::make('fname')->label('First Name')->sortable()->formatStateUsing(fn ($state) => str()->words($state, 2, '...'))->tooltip(fn ($record) => $record->message),
                TextColumn::make('lname')->label('Last Name')->sortable()->formatStateUsing(fn ($state) => str()->words($state, 2, '...'))->tooltip(fn ($record) => $record->message),
                TextColumn::make('email')->sortable()->formatStateUsing(fn ($state) => str()->words($state, 15, '...'))->tooltip(fn ($record) => $record->message),
                TextColumn::make('phone')->sortable()->formatStateUsing(fn ($state) => str()->words($state, 15, '...'))->tooltip(fn ($record) => $record->message),
                TextColumn::make('company')->sortable()->formatStateUsing(fn ($state) => str()->words($state, 10, '...'))->tooltip(fn ($record) => $record->message),
                TextColumn::make('service')->sortable()->formatStateUsing(fn ($state) => str()->words($state, 10, '...'))->tooltip(fn ($record) => $record->message),
                TextColumn::make('subject')->sortable()->formatStateUsing(fn ($state) => str()->words($state, 10, '...'))->tooltip(fn ($record) => $record->message),

                // Show only the first 10 words of the message
                TextColumn::make('message')
                    ->label('Message')->formatStateUsing(fn ($state) => str()->words($state, 5, '...'))->tooltip(fn ($record) => $record->message),

                // Time ago column
                TextColumn::make('created_at')
                    ->label('Time Ago')
                    ->getStateUsing(fn ($record) => $record->created_at->diffForHumans())
                    ->sortable(),
            ])
            ->actions([
                // View Button with Styled Modal
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Contact Details')
                    ->modalContent(fn ($record) => new HtmlString("
                        <div class='p-6 rounded-lg shadow-md'>
                            <h2 class='text-lg font-semibold text-gray-700 mb-4'>Contact Information</h2>
                            
                            <div class='space-y-3'>
                                <div class='flex justify-between'>
                                    <span class='font-medium text-gray-600'>Full Name:</span>
                                    <span class='text-gray-800'>{$record->fname} {$record->lname}</span>
                                </div>

                                <div class='flex justify-between'>
                                    <span class='font-medium text-gray-600'>Email:</span>
                                    <span class='text-gray-800'>{$record->email}</span>
                                </div>

                                <div class='flex justify-between'>
                                    <span class='font-medium text-gray-600'>Phone:</span>
                                    <span class='text-gray-800'>{$record->phone}</span>
                                </div>

                                <div class='flex justify-between'>
                                    <span class='font-medium text-gray-600'>Company:</span>
                                    <span class='text-gray-800'>{$record->company}</span>
                                </div>

                                <div class='flex justify-between'>
                                    <span class='font-medium text-gray-600'>Service:</span>
                                    <span class='text-gray-800'>{$record->service}</span>
                                </div>

                                <div class='flex justify-between'>
                                    <span class='font-medium text-gray-600'>Subject:</span>
                                    <span class='text-gray-800'>{$record->subject}</span>
                                </div>

                                <div class='border-t pt-3'>
                                    <span class='font-medium text-gray-600'>Message:</span>
                                    <p class='text-gray-800 text-sm mt-2 p-2 rounded-md'>{$record->message}</p>
                                </div>

                                <div class='flex justify-between border-t pt-3'>
                                    <span class='font-medium text-gray-600'>Created At:</span>
                                    <span class='text-gray-800'>{$record->created_at->format('Y-m-d H:i:s')} ({$record->created_at->diffForHumans()})</span>
                                </div>
                            </div>
                        </div>
                    ")), 

                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
            // 'create' =>CreateMeta::route('/create'),
            // 'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
