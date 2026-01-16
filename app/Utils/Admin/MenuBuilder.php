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
                    'active' => ['admin.home.*'],
                    'route' => 'admin.home.index',
                    'icon' => 'ti ti-dashboard',
                    'can' => ['admin>home>read'],
                    'submenu' => null,
                ],
                [
                    'label' => 'Event',
                    'active' => ['admin.events.*'],
                    'route' => 'admin.events.index',
                    'icon' => "fas fa-trophy",
                    'can' => ['admin>event>read'],
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
