<?php

namespace Agencetwogether\TermsConditions\Pages;

use Agencetwogether\TermsConditions\Models\Term;
use Agencetwogether\TermsConditions\TermsConditionsPlugin;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class PageShowTerms extends Page
{
    public Model $model;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function shouldRegisterNavigation(): bool
    {
        return TermsConditionsPlugin::get()->getRegisterPageShowTerms();
    }

    //protected static ?string $slug = 'custom-url-slug';

    protected static string $view = 'terms-conditions::pages.show-terms';

    public function getTitle(): string
    {
        return TermsConditionsPlugin::get()->getTitlePageShowTerms();
    }

    public function getHeading(): string
    {
        return TermsConditionsPlugin::get()->getHeadingPageShowTerms();
    }

    public function getSubheading(): Htmlable|string|null
    {
        return TermsConditionsPlugin::get()->getSubHeadingPageShowTerms();
    }

    public static function getNavigationLabel(): string
    {
        return TermsConditionsPlugin::get()->getNavigationLabelPageShowTerms();
    }

    public function mount(): void
    {
        $this->model = Term::latest()->where('is_published', true)->first();

    }
}
