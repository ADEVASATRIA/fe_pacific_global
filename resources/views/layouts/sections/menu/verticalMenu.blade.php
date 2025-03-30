<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Pacific Global</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        @php
            $menus = [
                ['name' => 'Dashboard', 'slug' => 'dashboard', 'url' => '/dashboard', 'icon' => 'bx bx-home-alt'],
                [
                    'name' => 'Role',
                    'slug' => 'role',
                    'url' => '#',
                    'icon' => 'bx bx-user',
                    'submenu' => [['name' => 'View All Role', 'slug' => 'view-all-role', 'url' => '/role-view']],
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
        @endphp

        @foreach ($menus as $menu)
            @php
                $activeClass = '';
                if ($currentRouteName === ($menu['slug'] ?? '')) {
                    $activeClass = 'active';
                } elseif (isset($menu['submenu'])) {
                    foreach ($menu['submenu'] as $submenu) {
                        if ($currentRouteName === ($submenu['slug'] ?? '')) {
                            $activeClass = 'active open';
                            break;
                        }
                    }
                }

                if ($activeClass === '' && isset($menu['url'])) {
                    $menuUrl = trim($menu['url'], '/');
                    $currentUrl = trim(request()->path(), '/');
                    if ($menuUrl === $currentUrl) {
                        $activeClass = 'active';
                    }
                }
            @endphp

            <li class="menu-item {{ $activeClass }}">
                <a href="{{ isset($menu['submenu']) ? 'javascript:void(0);' : url($menu['url'] ?? '#') }}"
                    class="{{ isset($menu['submenu']) ? 'menu-link menu-toggle' : 'menu-link' }}">
                    <i class="{{ $menu['icon'] ?? 'bx bx-error' }}"></i>
                    <div>{{ __($menu['name'] ?? 'Unnamed') }}</div>
                </a>

                @if (isset($menu['submenu']))
                    <ul class="menu-sub">
                        @foreach ($menu['submenu'] as $submenu)
                            <li class="menu-item {{ $currentRouteName === ($submenu['slug'] ?? '') ? 'active' : '' }}">
                                <a href="{{ url($submenu['url'] ?? '#') }}" class="menu-link">
                                    <div>{{ __($submenu['name'] ?? 'Unnamed') }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</aside>
