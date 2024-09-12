<?php

namespace Agencetwogether\TermsConditions\Resources\TermResource\Pages;

use Agencetwogether\TermsConditions\Resources\TermResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditTerm extends EditRecord
{
    protected static string $resource = TermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($record->is_published) {
            unset($data['published_at']);
        }

        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        $record->update($data);

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
