<?php

namespace Agencetwogether\TermsConditions;

use Agencetwogether\TermsConditions\Commands\TermsConditionsCommand;
use Agencetwogether\TermsConditions\Components\UserConsentList;
use Agencetwogether\TermsConditions\Pages\PageAcceptTerms;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TermsConditionsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'terms-conditions';

    public static string $viewNamespace = 'terms-conditions';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasConfigFile('terms-conditions')
            ->hasRoute('web')
            ->hasTranslations()
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('agencetwogether/terms-conditions');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        Livewire::component('agencetwogether.filament.terms-conditions.pages.term', PageAcceptTerms::class);
        Livewire::component('agencetwogether.filament.terms-conditions.user-consent-list', UserConsentList::class);
        parent::packageBooted();
    }

    protected function getAssetPackageName(): ?string
    {
        return 'agencetwogether/terms-conditions';
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            TermsConditionsCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_term_user_table',
            'create_terms_table',
        ];
    }
}
