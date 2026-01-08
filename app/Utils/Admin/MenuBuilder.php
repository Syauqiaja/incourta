<?php

namespace App\Utils\Admin;

class MenuBuilder
{
    const sidebarMenu =
    [
        [
            'title_label' => 'Main Menu',
            'menu' => [
                [
                    'label' => 'Dashboard',
                    'active' => ['home'],
                    'route' => 'dashboard',
                    'icon' => 'ti ti-dashboard',
                    'can' => ['dashboard>read'],
                    'submenu' => null,
                ]
            ],

        ]
    ];

    public function listAllMenu()
    {
        return self::sidebarMenu;
    }
}
