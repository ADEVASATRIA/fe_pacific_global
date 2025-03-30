@php
    use Illuminate\Support\Facades\Route;
@endphp

<ul class="menu-sub">
    @if (isset($menu))
        @foreach ($menu as $submenu)
            {{-- active menu method --}}
            @php
                // dd($submenu);
                $activeClass = null;
                $active = 'active open';
                $currentRouteName = Route::currentRouteName();

                if ($currentRouteName === $menu['slug']) {
                    $activeClass = 'active';
                } elseif (isset($menu['submenu'])) {
                    foreach ($menu['submenu'] as $submenu) {
                        if (is_array($submenu['slug'])) {
                            foreach ($submenu['slug'] as $slug) {
                                if ($currentRouteName === $slug) {
                                    $activeClass = 'active open';
                                    break 2; // Keluar dari kedua loop jika ditemukan
                                }
                            }
                        } elseif ($currentRouteName === $submenu['slug']) {
                            $activeClass = 'active open';
                            break;
                        }
                    }
                }

            @endphp

            <li class="menu-item {{ $activeClass }}">
                <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}"
                    class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                    @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
                    @if (isset($submenu->icon))
                        <i class="{{ $submenu->icon }}"></i>
                    @endif
                    <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
                    @isset($submenu->badge)
                        <div class="badge rounded-pill bg-{{ $submenu->badge[0] }} text-uppercase ms-auto">
                            {{ $submenu->badge[1] }}</div>
                    @endisset
                </a>

                {{-- submenu --}}
                @if (isset($submenu->submenu))
                    @include('layouts.sections.menu.submenu', ['menu' => $submenu->submenu])
                @endif
            </li>
        @endforeach
    @endif
</ul>
