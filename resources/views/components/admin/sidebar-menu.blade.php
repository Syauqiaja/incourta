<ul class="pc-navbar">
    @foreach ($sidebars as $key => $sidebar)
        @isset($sidebar['title_label'])
            <li class="pc-item pc-caption">
                <label>{{ $sidebar['title_label'] }}</label>
            </li>
        @endisset
        @foreach ($sidebar['menu'] as $menu)
            @isset($menu['sub_menu'])
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span
                            class="pc-mtext">Menu levels</span><span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        @foreach ($menu['sub_menu'] as $submenu)
                            <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
                        @endforeach


                    </ul>
                </li>
            @else
                <li class="pc-item {{ request()->routeIs($menu['active']) ? 'active' : '' }}">
                    <a href="{{ route($menu['route']) }}" class="pc-link">
                        <span class="pc-micon"><i class="{{ $menu['icon'] ?? '' }}"></i></span>
                        <span class="pc-mtext">{{ $menu['label'] }}</span>
                    </a>
                </li>
            @endisset
        @endforeach
    @endforeach
</ul>
