<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{ config('variables.templateName') }}</span>
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
                ['name' => 'Role', 'slug' => 'role', 'url' => '/role-view', 'icon' => 'bx bx-user'],
                ['name' => 'Clubhouse', 'slug' => 'clubhouse', 'url' => '/clubhouse-view', 'icon' => 'bx bx-building'],
                ['name' => 'Item', 'slug' => 'item', 'url' => '/item-view', 'icon' => 'bx bx-box'],
                ['name' => 'Ticket Type', 'slug' => 'ticket-type', 'url' => '/ticket-type-view', 'icon' => 'bx bx-receipt'],
                ['name' => 'Package', 'slug' => 'package', 'url' => '/package-view', 'icon' => 'bx bx-package'],
            ];
            $currentRouteName = Route::currentRouteName();
        @endphp

        @foreach ($menus as $menu)
            @php
                $activeClass = $currentRouteName === $menu['slug'] ? 'active open' : '';
            @endphp

            <li class="menu-item {{ $activeClass }}">
                <a href="{{ url($menu['url']) }}" class="menu-link menu-toggle">
                    <i class="{{ $menu['icon'] }}"></i>
                    <div>{{ __($menu['name']) }}</div>
                </a>
                
                {{-- Tambahkan submenu di sini jika ada --}}
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ url($menu['url']) }}" class="menu-link">
                            <div>Submenu {{ __($menu['name']) }}</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endforeach
    </ul>

</aside>

{{-- Tambahkan JavaScript untuk Animasi --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let menuLinks = document.querySelectorAll(".menu-toggle");

        menuLinks.forEach(function (link) {
            link.addEventListener("click", function (event) {
                event.preventDefault();
                let parentLi = this.closest(".menu-item");

                // Tutup semua yang terbuka
                document.querySelectorAll(".menu-item.open").forEach(function (openItem) {
                    if (openItem !== parentLi) {
                        openItem.classList.remove("open");
                    }
                });

                // Toggle menu saat ditekan
                parentLi.classList.toggle("open");
            });
        });
    });
</script>
