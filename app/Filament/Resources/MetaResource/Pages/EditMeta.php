<?php

namespace App\Filament\Resources\MetaResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\MetaResource;

class EditMeta extends EditRecord
{
    protected static string $resource = MetaResource::class;

    // ✅ Redirect to Meta List After Editing
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
