<?php

namespace Agencetwogether\TermsConditions\Resources\TermResource\Pages;

use Agencetwogether\TermsConditions\Components\UserConsentList;
use Agencetwogether\TermsConditions\Resources\TermResource;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;

class ViewTerm extends ViewRecord
{
    protected static string $resource = TermResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('terms-conditions::terms-conditions.resources.infolist.name.label')),
                        Group::make()
                            ->schema([
                                IconEntry::make('is_published')
                                    ->label(__('terms-conditions::terms-conditions.resources.infolist.is_published.label'))
                                    ->boolean(),
                                TextEntry::make('published_at')
                                    ->label(__('terms-conditions::terms-conditions.resources.infolist.published_at.label'))
                                    ->dateTime('l j F Y - H:i')
                                    ->visible(fn (Model $record) => $record->is_published),
                            ]),

                    ])
                    ->columns(2),
                Section::make(__('terms-conditions::terms-conditions.resources.infolist.terms.label'))
                    ->schema([
                        TextEntry::make('terms')
                            ->hiddenLabel()
                            ->html(),
                    ])
                    ->collapsible()
                    ->collapsed(),
                Livewire::make(UserConsentList::class, ['id' => $this->record->id])->columnSpanFull(),
            ]);
    }
}
