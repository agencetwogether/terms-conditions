<?php

namespace Agencetwogether\TermsConditions;

use Agencetwogether\TermsConditions\Middleware\AcceptedTerms;
use Agencetwogether\TermsConditions\Pages\PageAcceptTerms;
use Agencetwogether\TermsConditions\Pages\PageShowTerms;
use Agencetwogether\TermsConditions\Resources\TermResource;
use Filament\Contracts\Plugin;
use Filament\Pages\Page;
use Filament\Panel;

class TermsConditionsPlugin implements Plugin
{
    // Page AcceptTerms
    protected string $pageAcceptTerms = PageAcceptTerms::class;

    protected bool $showLogoPageAcceptTerms = true;

    protected string|bool|null $titlePageAcceptTerms = '';

    protected string|bool|null|HtmlString $headingPageAcceptTerms = null;

    protected string|bool|null|HtmlString $subHeadingPageAcceptTerms = null;

    // Page Show Term
    protected string $pageShowTerms = PageShowTerms::class;

    protected bool $registerPageShowTerms = false;

    protected string|bool|null $titlePageShowTerms = '';

    protected string|bool|null|HtmlString $headingPageShowTerms = null;

    protected string|bool|null|HtmlString $subHeadingPageShowTerms = null;

    protected string|bool|null|HtmlString $navigationLabelPageShowTerms = null;

    // Page Show Term
    public function getSlugPageShowTerms(): string
    {
        if (trans()->hasForLocale('terms-conditions::terms-conditions.pages.show_terms.navigation.slug')) {
            return __('terms-conditions::terms-conditions.pages.show_terms.navigation.slug');
        }

        return config('terms-conditions.navigation.pages.show_terms.slug');
    }

    public function titlePageShowTerms(string|bool|null $titlePageShowTerms): static
    {
        $this->titlePageShowTerms = $titlePageShowTerms;

        return $this;
    }

    public function getTitlePageShowTerms(): ?string
    {
        if (filled($this->titlePageShowTerms)) {
            return $this->titlePageShowTerms;
        }

        return __('terms-conditions::terms-conditions.pages.show_terms.title');
    }

    public function headingPageShowTerms(string|bool|null|HtmlString $headingPageShowTerms): static
    {
        $this->headingPageShowTerms = $headingPageShowTerms;

        return $this;
    }

    public function getHeadingPageShowTerms(): string|HtmlString|null
    {
        if (filled($this->headingPageShowTerms)) {
            return $this->headingPageShowTerms;
        }

        return __('terms-conditions::terms-conditions.pages.show_terms.heading');
    }

    public function subHeadingPageShowTerms(string|bool|null|HtmlString $subHeadingPageShowTerms): static
    {
        $this->subHeadingPageShowTerms = $subHeadingPageShowTerms;

        return $this;
    }

    public function getSubHeadingPageShowTerms(): string|HtmlString|null
    {
        if (filled($this->subHeadingPageShowTerms)) {
            return $this->subHeadingPageShowTerms;
        }

        return __('terms-conditions::terms-conditions.pages.show_terms.sub_heading');
    }

    public function navigationLabelPageShowTerms(string|bool|null|HtmlString $navigationLabelPageShowTerms): static
    {
        $this->navigationLabelPageShowTerms = $navigationLabelPageShowTerms;

        return $this;
    }

    public function getNavigationLabelPageShowTerms(): string|HtmlString|null
    {
        if (filled($this->navigationLabelPageShowTerms)) {
            return $this->navigationLabelPageShowTerms;
        }

        if (trans()->hasForLocale('terms-conditions::terms-conditions.pages.show_terms.navigation.label')) {
            return __('terms-conditions::terms-conditions.pages.show_terms.navigation.label');
        }

        return config('terms-conditions.navigation.pages.show_terms.label');

    }

    public function getRegisterPageShowTerms(): ?int
    {
        return $this->registerPageShowTerms;
    }

    public function usingPageShowTerms(string $page = PageShowTerms::class): static
    {
        $this->registerPageShowTerms = true;
        $this->pageShowTerms = $page;

        return $this;
    }

    //Resource
    public string $resourceNavigationGroup;

    public function resourceNavigationGroup($resourceNavigationGroup): static
    {
        $this->resourceNavigationGroup = $resourceNavigationGroup;

        return $this;
    }

    public function getResourceNavigationGroup(): ?string
    {
        return $this->resourceNavigationGroup ?? $this->getResourceGroupLabel();
    }

    private function getResourceGroupLabel(): string
    {
        if (trans()->hasForLocale('terms-conditions::terms-conditions.resources.term_resource.navigation.group')) {
            return __('terms-conditions::terms-conditions.resources.term_resource.navigation.group');
        }

        return config('terms-conditions.navigation.resources.term_resource.group');
    }

    //Page Accept Terms
    public function getSlugPageAcceptTerms(): string
    {
        if (trans()->hasForLocale('terms-conditions::terms-conditions.pages.accept_terms.navigation.slug')) {
            return __('terms-conditions::terms-conditions.pages.accept_terms.navigation.slug');
        }

        return config('terms-conditions.navigation.pages.accept_terms.slug');
    }

    public function showLogoPageAcceptTerms(bool $showLogoPageAcceptTerms): static
    {
        $this->showLogoPageAcceptTerms = $showLogoPageAcceptTerms;

        return $this;
    }

    public function getShowLogoPageAcceptTerms(): bool
    {
        return $this->showLogoPageAcceptTerms;
    }

    public function titlePageAcceptTerms(string|bool|null $titlePageAcceptTerms): static
    {
        $this->titlePageAcceptTerms = $titlePageAcceptTerms;

        return $this;
    }

    public function getTitlePageAcceptTerms(): ?string
    {
        if (filled($this->titlePageAcceptTerms)) {
            return $this->titlePageAcceptTerms;
        }

        return __('terms-conditions::terms-conditions.pages.accept_terms.title');
    }

    public function headingPageAcceptTerms(string|bool|null|HtmlString $headingPageAcceptTerms): static
    {
        $this->headingPageAcceptTerms = $headingPageAcceptTerms;

        return $this;
    }

    public function getHeadingPageAcceptTerms(): string|HtmlString|null
    {
        if (filled($this->headingPageAcceptTerms)) {
            return $this->headingPageAcceptTerms;
        }

        return __('terms-conditions::terms-conditions.pages.accept_terms.heading');
    }

    public function subHeadingPageAcceptTerms(string|bool|null|HtmlString $subHeadingPageAcceptTerms): static
    {
        $this->subHeadingPageAcceptTerms = $subHeadingPageAcceptTerms;

        return $this;
    }

    public function getSubHeadingPageAcceptTerms(): string|HtmlString|null
    {
        if (filled($this->subHeadingPageAcceptTerms)) {
            return $this->subHeadingPageAcceptTerms;
        }

        return __('terms-conditions::terms-conditions.pages.accept_terms.sub_heading');
    }

    public function pageAcceptTerms(string $pageAcceptTerms): static
    {
        $this->pageAcceptTerms = $pageAcceptTerms;

        return $this;
    }

    public function getPageAcceptTerms(): string
    {
        return $this->pageAcceptTerms;
    }

    public function usingPageAccept(string $page = PageAcceptTerms::class): static
    {
        $this->pageAcceptTerms = $page;

        return $this;
    }

    //General
    public function register(Panel $panel): void
    {
        $panel
            ->authMiddleware([AcceptedTerms::class])
            ->resources([
                TermResource::class,
            ])
            ->pages([
                $this->pageShowTerms,
            ]);

        /*if ($this->registerPageShowTerms) {
            $panel
                ->pages([
                    $this->pageShowTerms,
                ]);
        }
        */

    }

    public function boot(Panel $panel): void {}

    public function getId(): string
    {
        return 'terms-conditions';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        return filament(app(static::class)->getId());
    }
}
