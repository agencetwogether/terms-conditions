<?php

namespace Agencetwogether\TermsConditions\Resources;

use Agencetwogether\TermsConditions\Models\Term;
use Agencetwogether\TermsConditions\Resources\TermResource\Pages\CreateTerm;
use Agencetwogether\TermsConditions\Resources\TermResource\Pages\EditTerm;
use Agencetwogether\TermsConditions\Resources\TermResource\Pages\ListTerms;
use Agencetwogether\TermsConditions\Resources\TermResource\Pages\ViewTerm;
use Agencetwogether\TermsConditions\TermsConditionsPlugin;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class TermResource extends Resource
{
    protected static ?string $model = Term::class;

    public static function getModelLabel(): string
    {
        return __('terms-conditions::terms-conditions.resources.term_resource.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('terms-conditions::terms-conditions.resources.term_resource.plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return TermsConditionsPlugin::get()->getResourceNavigationGroup();
    }

    public static function getNavigationSort(): ?int
    {
        return config('terms-conditions.navigation.resources.term_resource.sort');
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return config('terms-conditions.navigation.resources.term_resource.icon');
    }

    public static function getNavigationLabel(): string
    {
        if (trans()->hasForLocale('terms-conditions::terms-conditions.resources.term_resource.navigation.label')) {
            return __('terms-conditions::terms-conditions.resources.term_resource.navigation.label');
        }

        return config('terms-conditions.navigation.resources.term_resource.label');
    }

    public static function getSlug(): string
    {
        if (trans()->hasForLocale('terms-conditions::terms-conditions.resources.term_resource.navigation.slug')) {
            return __('terms-conditions::terms-conditions.resources.term_resource.navigation.slug');
        }

        return config('terms-conditions.navigation.resources.term_resource.slug');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('terms-conditions::terms-conditions.resources.term_resource.form.name.label'))
                            ->required(),

                        ToggleButtons::make('is_published')
                            ->label(__('terms-conditions::terms-conditions.resources.term_resource.form.is_published.label'))
                            ->boolean()
                            ->inline()
                            ->default(false)
                            ->disableOptionWhen(function (string $value, ?Model $record, string $operation): bool {
                                if ($operation === 'edit') {
                                    return $record->users->isNotEmpty();
                                }

                                return false;
                            }),
                        RichEditor::make('terms')
                            ->label(__('terms-conditions::terms-conditions.resources.term_resource.form.terms.label'))
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('terms-conditions::terms-conditions.resources.term_resource.table.name.label')),
                IconColumn::make('is_published')
                    ->label(__('terms-conditions::terms-conditions.resources.term_resource.table.is_published.label'))
                    ->boolean(),
                TextColumn::make('published_at')
                    ->label(__('terms-conditions::terms-conditions.resources.term_resource.table.published_at.label'))
                    ->dateTime('l j F Y - H:i')
                    ->placeholder('-')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(
                fn (Model $record): string => $record->is_published ? ViewTerm::getUrl([$record]) : EditTerm::getUrl([$record])
            )
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->visible(fn (Model $record) => $record->users->isEmpty()),
                    Tables\Actions\ReplicateAction::make()
                        ->excludeAttributes(['published_at', 'is_published'])
                        ->beforeReplicaSaved(function (Model $replica) {
                            $replica->name = __('terms-conditions::terms-conditions.general.copy').' '.$replica->name;
                        }),
                    Tables\Actions\Action::make('publish')
                        ->label(__('terms-conditions::terms-conditions.resources.term_resource.actions.publish.label'))
                        ->color('info')
                        ->icon('heroicon-m-rocket-launch')
                        ->action(function (Model $record) {
                            $record->published_at = now();
                            $record->is_published = true;
                            $record->save();
                            redirect(ListTerms::getUrl());
                        })
                        ->visible(fn (Model $record) => ! $record->is_published),
                ]),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTerms::route('/'),
            'create' => CreateTerm::route('/create'),
            'view' => ViewTerm::route('/{record}'),
            'edit' => EditTerm::route('/{record}/edit'),
        ];
    }
}
