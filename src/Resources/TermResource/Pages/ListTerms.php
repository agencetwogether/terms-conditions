<?php

namespace Agencetwogether\TermsConditions\Resources\TermResource\Pages;

use Agencetwogether\TermsConditions\Resources\TermResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTerms extends ListRecords
{
    protected static string $resource = TermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
