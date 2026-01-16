<?php

namespace App\View\Components\Admin;

use App\Utils\Admin\MenuBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarMenu extends Component
{

    public array $sidebars;
    /**
     * Create a new component instance.
     */
    public function __construct(MenuBuilder $menuBuilder)
    {
        $this->sidebars = self::filterSidebarByPermission($menuBuilder->listAllMenu());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.sidebar-menu');
    }
    function filterSidebarByPermission(array $sidebars): array
    {
        return collect($sidebars)->map(function ($group) {
            $menus = collect($group['menu'] ?? [])->map(function ($menu) {
                if (!isset($menu['can'])) {
                    return null;
                }

                // Filter sub_menu jika ada
                if (isset($menu['sub_menu'])) {
                    $menu['sub_menu'] = collect($menu['sub_menu'])->filter(function ($sub) {
                        return collect($sub['can'] ?? [])
                            ->some(fn($perm) => request()->user()->can($perm));
                    })->values()->all();

                    // Jika tidak ada submenu yang lolos permission, jangan tampilkan menu utama
                    return count($menu['sub_menu']) > 0 ? $menu : null;
                }

                return collect($menu['can'] ?? [])
                    ->some(fn($perm) => request()->user()->can($perm)) ? $menu : null;
            })->filter()->values()->all();

            return count($menus) > 0 ? [
                'title_label' => $group['title_label'] ?? null,
                'menu' => $menus,
            ] : null;
        })->filter()->values()->all();
    }
}
