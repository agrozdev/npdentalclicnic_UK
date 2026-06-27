<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="about-footer">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('site.brand') }}" style="max-height:56px;width:auto;background:#fff;padding:8px 12px;border-radius:8px;">
                    </div>
                    <div class="about-footer-content">
                        <p>{{ __('footer.about_blurb') }}</p>
                    </div>
                    <div class="footer-contact-content">
                        <h3><a href="mailto:{{ config('site.contact.email') }}" style="color:inherit;text-decoration:none;">{{ config('site.contact.email') }}</a></h3>
                        <h3><a href="tel:{{ config('site.contact.phone_e164') }}" style="color:inherit;text-decoration:none;">{{ config('site.contact.phone_display') }}</a></h3>
                        <address style="font-style:normal;margin-top:12px;opacity:.85;">
                            @foreach (config('site.contact.address_lines') as $line)
                                {{ $line }}@if (!$loop->last)<br>@endif
                            @endforeach
                        </address>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <div class="footer-links">
                    <h3>{{ __('footer.quick_links') }}</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('nav.home') }}</a></li>
                        <li><a href="{{ route('about') }}">{{ __('nav.about') }}</a></li>
                        <li><a href="{{ route('services.implants') }}">{{ __('nav.implants') }}</a></li>
                        <li><a href="{{ route('services.aligners') }}">{{ __('nav.aligners') }}</a></li>
                        <li><a href="{{ route('blog.index') }}">{{ __('nav.blog') }}</a></li>
                        <li><a href="{{ route('contact') }}">{{ __('nav.contact') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 col-12">
                <div class="footer-links">
                    <h3>{{ __('footer.our_services') }}</h3>
                    <ul>
                        <li><a href="{{ route('services.implants') }}">{{ __('nav.implants') }}</a></li>
                        <li><a href="{{ route('services.aligners') }}">{{ __('nav.aligners') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-5 col-12">
                <div class="footer-links">
                    <h3>{{ __('footer.opening_hours') }}</h3>
                    <ul>
                        <li>{{ config('site.contact.hours') }}</li>
                    </ul>
                    <h3 style="margin-top: 28px;">{{ __('footer.legal') }}</h3>
                    <ul>
                        <li><a href="{{ route('legal.cookie') }}">{{ __('footer.cookie_policy') }}</a></li>
                        <li><a href="{{ route('legal.privacy') }}">{{ __('footer.privacy_policy') }}</a></li>
                        <li><a href="{{ route('legal.terms') }}">{{ __('footer.terms') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-copyright">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="footer-copyright-text">
                        <p>{{ __('footer.copyright', ['year' => date('Y')]) }}</p>
                        <p style="margin-top:4px;font-size:0.8em;opacity:0.75;">Crafted by <a href="https://www.grozdevdigital.com/" target="_blank" rel="noopener" style="color:inherit;text-decoration:underline;">Grozdev Digital</a></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer-privacy-policy">
                        <ul>
                            <li><a href="{{ route('legal.terms') }}">{{ __('footer.terms') }}</a></li>
                            <li><a href="{{ route('legal.privacy') }}">{{ __('footer.privacy_policy') }}</a></li>
                            <li><a href="{{ route('legal.cookie') }}">{{ __('footer.cookie_policy') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
