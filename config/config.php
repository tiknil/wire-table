<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Theming
    |--------------------------------------------------------------------------
    |
    | This option controls the default css theme to use for your table.
    |
    | Supported: "boostrap5"
    */
    'theme' => 'bootstrap5',

    /*
    | Additional classes added to the <table> element (e.g. table-bordered or table-striped)
    */
    'class' => '',

    /*
    | Carbon date format for displaying dates
    |
    | See: https://carbon.nesbot.com/docs/#api-formatting
    */
    'date-format' => 'd M Y H:i',

    /*
    |--------------------------------------------------------------------------
    | Pagination settings
    |--------------------------------------------------------------------------
    |
    | Defines how row are paginated.
    |
    | simple:       True for simple pagination
    |               see: https://laravel.com/docs/10.x/pagination#simple-pagination
    | size:         number of elements in each page
    | each-side:    number of links to display on the side of the current active page.
    |               see: https://laravel.com/docs/10.x/pagination#adjusting-the-pagination-link-window
    */
    'pagination' => [
        'simple' => false,

        'size' => 10,

        'each-side' => 1,
    ],

    /*
    |--------------------------------------------------------------------------
    | Sorting settings
    |--------------------------------------------------------------------------
    |
    | This values are only used by the WithSorting trait
    |
    | Initial dir defaults to desc, because it's common to sort by a descending date (e.g. created_at)
    | Default dir however defaults to asc, because when sorting a textual column, ascending order is usually expected
    |
    | dir.initial:  Sorting direction at the first render
    | dir.default:  Default direction when a new column is selected for sorting
    | by:           The field to start sorting with
    */
    'sorting' => [
        'dir' => [
            'initial' => 'desc',
            'default' => 'asc',
        ],
        'by' => 'created_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Icons
    |--------------------------------------------------------------------------
    |
    | This option controls the icon theme.
    |
    | Supported: "boostrap", "font-awesome"
    */
    'icon-theme' => 'bootstrap',

    'icons' => [
        // https://icons.getbootstrap.com/
        'bootstrap' => [
            'base' => 'bi',
            'sorting' => [
                'inactive' => 'bi-filter-left',
                'asc' => 'bi-sort-up',
                'desc' => 'bi-sort-down',
            ],
        ],
        // https://fontawesome.com/icons
        'font-awesome' => [
            'base' => 'fa-solid',
            'sorting' => [
                'inactive' => 'fa-sort',
                'asc' => 'fa-sort-up',
                'desc' => 'fa-sort-down',
            ],
        ],
    ],
];
