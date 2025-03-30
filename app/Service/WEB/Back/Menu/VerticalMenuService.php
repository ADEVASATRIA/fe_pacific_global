<?php

namespace App\Service\WEB\Back\Menu;

use Illuminate\Support\Facades\Route;

class VerticalMenuService
{
    public static function getMenu()
    {
        $menus = [
            ['name' => 'Dashboard', 'slug' => 'dashboard', 'url' => '/dashboard', 'icon' => 'bx bx-home-alt'],
            [
                'name' => 'Role',
                'slug' => 'role',
                'url' => '#',
                'icon' => 'bx bx-user',
                'submenu' => [
                    ['name' => 'View All Role', 'slug' => 'view-all-role', 'url' => '/role-view'],
                    ['name' => 'Create Role', 'slug' => 'create-role', 'url' => '/role-create'],
                ],
            ],
            ['name' => 'Item', 'slug' => 'item', 'url' => '/item-view', 'icon' => 'bx bx-box'],
            [
                'name' => 'Ticket Type',
                'slug' => 'ticket-type',
                'url' => '/ticket-type-view',
                'icon' => 'bx bx-receipt',
            ],
            ['name' => 'Package', 'slug' => 'package', 'url' => '/package-view', 'icon' => 'bx bx-package'],
            ['name' => 'Clubhouse', 'slug' => 'clubhouse', 'url' => '/clubhouse-view', 'icon' => 'bx bx-building'],
        ];

        $currentRouteName = Route::currentRouteName() ?? '';

        if (empty($currentRouteName)) {
            $currentURL = request()->path();
            foreach ($menus as $menu) {
                if (isset($menu['slug']) && isset($menu['url']) && trim($menu['url'], '/') == $currentURL) {
                    $currentRouteName = $menu['slug'];
                    break;
                }
            }
        }

        return compact('menus', 'currentRouteName');
    }
}
