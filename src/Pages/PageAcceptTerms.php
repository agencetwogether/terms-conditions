<?php

namespace Agencetwogether\TermsConditions\Pages;

use Agencetwogether\TermsConditions\Events\AgreedToTerms;
use Agencetwogether\TermsConditions\Models\Term;
use Agencetwogether\TermsConditions\TermsConditionsPlugin;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\SimplePage;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class PageAcceptTerms extends SimplePage
{
    use InteractsWithFormActions;

    protected static string $view = 'terms-conditions::pages.accept-terms';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function accept()
    {
        $this->form->getState();

        /** @var Authenticatable & Model $user */
        $user = Filament::auth()->user();

        $term = Term::latest('id')->first();

        $user->terms()->attach($term->id, ['accepted_at' => now()]);

        event(new AgreedToTerms($user, $term));

        Notification::make()
            ->title(__('terms-conditions::terms-conditions.pages.accept_terms.notifications.title'))
            ->success()
            ->send();

        return redirect()->intended(Filament::getUrl());
    }

    public function form(Form $form): Form
    {
        return $form;
    }

    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        Toggle::make('accepted')
                            ->label(__('terms-conditions::terms-conditions.pages.accept_terms.form.accepted.label'))
                            ->accepted(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    protected function getFormActions(): array
    {
        return [
            $this->getTermFormAction(),
        ];
    }

    protected function getTermFormAction(): Action
    {
        return Action::make('save')
            ->label(__('terms-conditions::terms-conditions.pages.accept_terms.actions.save.label'))
            ->submit('term')
            ->keyBindings(['mod+s']);
    }

    public function getTitle(): string
    {
        return TermsConditionsPlugin::get()->getTitlePageAcceptTerms();
    }

    public function getHeading(): string
    {
        return TermsConditionsPlugin::get()->getHeadingPageAcceptTerms();
    }

    public function getSubheading(): Htmlable|string|null
    {
        return TermsConditionsPlugin::get()->getSubHeadingPageAcceptTerms();
    }

    public function hasLogo(): bool
    {
        return TermsConditionsPlugin::get()->getShowLogoPageAcceptTerms();
    }

    public function getViewData(): array
    {
        return [
            'actual_terms' => Term::latest('id')->first(),
        ];
    }

    protected function getLayoutData(): array
    {
        return [
            'maxWidth' => MaxWidth::FiveExtraLarge,
        ];
    }
}
