<?php

namespace Agencetwogether\TermsConditions\Pages;

use Filament\Pages\Page;

class PageSubstitution extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'terms-conditions::pages.show-sub';
}
