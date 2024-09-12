<?php

namespace Agencetwogether\TermsConditions\Components;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class UserConsentList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Model $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->withWhereHas('term', function ($query) {
                        $query->where('term_id', $this->record->id);
                    }))
            ->columns([
                TextColumn::make('full_name')
                    ->label(__('terms-conditions::terms-conditions.resources.infolist.user.label'))
                    ->width('50%'),
                TextColumn::make('term.accepted_at')
                    ->label(__('terms-conditions::terms-conditions.resources.infolist.accepted.label'))
                    ->dateTime('l j F Y - H:i')
                    ->width('50%'),
            ]);
    }

    public function render()
    {
        return view('terms-conditions::components.user-consent-list');
    }
}
