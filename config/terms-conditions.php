<?php

return [

    /**
     * Navigation options
     */
    'navigation' => [

        'resources' => [
            'term_resource' => [
                'slug' => 'terms-conditions',
                'sort' => 10,
                'label' => 'Terms & Conditions',
                'icon' => 'heroicon-o-document-text',
                'group' => 'Terms',
            ],
        ],

        'pages' => [
            'accept_terms' => [
                'slug' => 'page-accept-terms-conditions-default',
            ],
            'show_terms' => [
                'label' => 'Label default Show Terms & Conditions',
                'slug' => 'page-show-terms-conditions-default',
            ],
        ],

    ],

    /**
     * Paths to exclude from the global middleware check
     */
    'excluded_paths' => [
        'admin/logout',
    ],

    /**
     * Paths for showing and accepting the terms. Prefixed by /terms
     */
    'paths' => [
        // The path to show the latest terms (default: latest)
        'latest_path' => '/latest',

        // The path to post the agreement to (default: agree)
        'agree_path' => '/agree',
    ],

    /**
     * The path to redirect to after accepting the terms
     */
    'redirect' => '/',
];
