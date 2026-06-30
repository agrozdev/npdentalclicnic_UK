@extends('layouts.app', [
    'title' => __('contact.meta_title'),
    'description' => __('contact.meta_description'),
])

@section('content')

    @include('partials.page-header', [
        'title' => __('contact.hero_title'),
        'breadcrumb' => __('contact.breadcrumb'),
    ])

    <div class="page-contact-us section-spacer">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-9">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ __('contact.intro.eyebrow') }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('contact.intro.title') }}</h2>
                        <p class="wow fadeInUp lead-text" data-wow-delay="0.25s">{{ __('contact.intro.lead') }}</p>
                    </div>
                </div>
            </div>

            <div class="row g-4" style="margin-bottom:60px;">
                <div class="col-lg-3 col-md-6">
                    <div class="contact-us-item wow fadeInUp">
                        <div class="icon-box"><img src="{{ asset('images/icon-location-info.svg') }}" alt=""></div>
                        <div class="contact-info-content">
                            <h3>{{ __('contact.cards.address_title') }}</h3>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(config('site.contact.map_query')) }}" target="_blank" rel="noopener" style="color:inherit;text-decoration:none;">
                                @foreach (config('site.contact.address_lines') as $line)
                                    <p>{{ $line }}</p>
                                @endforeach
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-us-item wow fadeInUp" data-wow-delay="0.15s">
                        <div class="icon-box"><img src="{{ asset('images/icon-phone-info.svg') }}" alt=""></div>
                        <div class="contact-info-content">
                            <h3>{{ __('contact.cards.phone_title') }}</h3>
                            <p><a href="tel:{{ config('site.contact.phone_e164') }}" style="color:inherit;">{{ config('site.contact.phone_display') }}</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-us-item wow fadeInUp" data-wow-delay="0.3s">
                        <div class="icon-box"><img src="{{ asset('images/icon-phone-info.svg') }}" alt=""></div>
                        <div class="contact-info-content">
                            <h3>{{ __('contact.cards.email_title') }}</h3>
                            <p><a href="mailto:{{ config('site.contact.email') }}" style="color:inherit;">{{ config('site.contact.email') }}</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-us-item wow fadeInUp" data-wow-delay="0.45s">
                        <div class="icon-box"><img src="{{ asset('images/icon-watch-info.svg') }}" alt=""></div>
                        <div class="contact-info-content">
                            <h3>{{ __('contact.cards.hours_title') }}</h3>
                            <p>{{ config('site.contact.hours') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-start g-4">
                <div class="col-lg-7">
                    <div class="section-title" style="margin-bottom:24px;">
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ __('contact.form.title') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('contact.form.subtitle') }}</p>
                    </div>

                    @if (session('contact_success'))
                        <div class="form-success">{{ session('contact_success') }}</div>
                        <!-- Event snippet for Contact Form Submit conversion page -->
                        <script>
                          gtag('event', 'conversion', {'send_to': 'AW-18212143061/RnylCJj66rgcENX_nOxD'});
                        </script>
                    @endif
                    @if (session('contact_error'))
                        <div class="form-error-banner">{{ session('contact_error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('contact.submit') }}" class="contact-form" novalidate>
                        @csrf

                        <div class="hp-field" aria-hidden="true">
                            <label>Website (leave empty)</label>
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="contact-name">{{ __('contact.form.name') }}</label>
                                <input id="contact-name" name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                                @error('name') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="contact-email">{{ __('contact.form.email') }}</label>
                                <input id="contact-email" name="email" type="email" class="form-control" value="{{ old('email') }}" required>
                                @error('email') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="contact-phone">{{ __('contact.form.phone') }}</label>
                                <input id="contact-phone" name="phone" type="tel" class="form-control" value="{{ old('phone') }}">
                                @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="contact-subject">{{ __('contact.form.subject') }}</label>
                                <select id="contact-subject" name="subject" class="form-select" required>
                                    @foreach (__('contact.form.subject_options') as $value => $label)
                                        <option value="{{ $value }}" @selected(old('subject') === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('subject') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="contact-message">{{ __('contact.form.message') }}</label>
                                <textarea id="contact-message" name="message" class="form-control" rows="6" required>{{ old('message') }}</textarea>
                                @error('message') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-check">
                                    <input type="checkbox" name="consent" value="1" {{ old('consent') ? 'checked' : '' }} required>
                                    <span>{!! __('contact.form.consent') !!}</span>
                                </label>
                                @error('consent') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-default">{{ __('contact.form.submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="contact-map" style="border-radius:18px;overflow:hidden;height:100%;min-height:480px;">
                        <iframe
                            src="https://www.google.com/maps?q={{ urlencode(config('site.contact.map_query')) }}&output=embed"
                            width="100%" height="100%" style="border:0;min-height:480px;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
