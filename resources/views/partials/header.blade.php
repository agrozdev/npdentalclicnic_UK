@php $current = request()->route()?->getName(); @endphp
<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('site.brand') }}" style="max-height:48px;width:auto;">
                </a>

                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item">
                                <a class="nav-link {{ $current === 'home' ? 'active' : '' }}" href="{{ route('home') }}">{{ __('nav.home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $current === 'about' ? 'active' : '' }}" href="{{ route('about') }}">{{ __('nav.about') }}</a>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link {{ str_starts_with((string) $current, 'services.') ? 'active' : '' }}" href="#">{{ __('nav.services') }}</a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('services.implants') }}">{{ __('nav.implants') }}</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('services.aligners') }}">{{ __('nav.aligners') }}</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ str_starts_with((string) $current, 'blog.') ? 'active' : '' }}" href="{{ route('blog.index') }}">{{ __('nav.blog') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $current === 'contact' ? 'active' : '' }}" href="{{ route('contact') }}">{{ __('nav.contact') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="contact-now-box d-inline-flex">
                        <div class="icon-box">
                            <img src="{{ asset('images/icon-phone-header.svg') }}" alt="">
                        </div>
                        <div class="contact-now-box-content">
                            <p>{{ __('nav.need_help') }}</p>
                            <h3><a href="tel:{{ config('site.contact.phone_e164') }}" style="color:inherit;text-decoration:none;">{{ config('site.contact.phone_display') }}</a></h3>
                        </div>
                    </div>
                </div>

                <div class="navbar-toggle"></div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
