@php
use App\Service\WEB\Back\Menu\VerticalMenuService;
extract(VerticalMenuService::getMenu());
@endphp

@section('page-script')
    @vite(['resources/js/service/auth/logout.js'])
@endsection
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{ url('/dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Pacific Global</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1 d-flex flex-column" style="height: calc(100vh - 70px);">
        <!-- Regular menu items -->
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
        
        <!-- Spacer to push logout to bottom -->
        <li class="menu-item flex-grow-1"></li>
        
        <!-- Logout button at the bottom with proper left alignment -->
        <li class="menu-item mt-auto">
            <form id="logout-form" action=""" method="POST" style="width: 100%; padding: 0;">
                @csrf
                <button type="submit" class="menu-link btn btn-link w-100 text-start ps-3" style="justify-content: flex-start;">
                    <i class="bx bx-power-off me-2"></i>
                    <div>Logout</div>
                </button>
            </form>
        </li>        
    </ul>
</aside>