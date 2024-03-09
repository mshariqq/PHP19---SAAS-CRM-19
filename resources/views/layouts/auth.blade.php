@php
    $settings = Utility::settings();
    $color = !empty($settings['color']) ? $settings['color'] : 'theme-3';

    if (isset($settings['color_flag']) && $settings['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }

    //$logo = asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo/');

    $company_favicon = $settings['favicon'];
    $setting = App\Models\Utility::colorset();
    
    $lang = \App::getLocale('lang');
    if ($lang == 'ar' || $lang == 'he') {
        $settings['SITE_RTL'] = 'on';
    }
    $SITE_RTL = !empty($settings['SITE_RTL']) ? $settings['SITE_RTL'] : '';

    $logos = Utility::get_superadmin_logo();
    //meta tag
    // $meta = DB::table('settings')
    //     ->where('created_by', '=', 1)
    //     ->get();
    // foreach ($meta as $row) {
    //     $settings[$row->name] = $row->value;
    // }
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $SITE_RTL == 'on' ? 'rtl' : '' }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="PHP 19">

    <title> @yield('page-title') -
        {{ Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'SAAS CRM') }}
    </title>    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <!-- SEO -->
    <meta name="keyword" content="{{ !empty($settings['meta_keyword']) ? $settings['meta_keyword'] : '' }}">
    <meta name="description" content="{{ !empty($settings['meta_description']) ? $settings['meta_description'] : '' }}">

      <!-- Open Graph / Facebook -->
      <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ !empty($settings['meta_keyword']) ? $settings['meta_keyword'] : '' }}">
    <meta property="og:description"
        content="{{ !empty($settings['meta_description']) ? $settings['meta_description'] : '' }}">
    <meta property="og:image"
        content="{{ asset('storage/meta/' . (isset($settings['meta_image']) && !empty($settings['meta_image']) ? $settings['meta_image'] : '')) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ !empty($settings['meta_keyword']) ? $settings['meta_keyword'] : '' }}">
    <meta property="twitter:description"
        content="{{ !empty($settings['meta_description']) ? $settings['meta_description'] : 'meta_image.png' }}">
    <meta property="twitter:image"
        content="{{ isset($settings['meta_image']) && !empty($settings['meta_image']) ? $settings['meta_image'] : '' }}">
        

        {{-- <link rel="icon" href="{{\App\Models\Utility::get_file('uploads/logo/favicon.png') }}" type="image" sizes="16x16"> --}}

    <link rel="icon"
    href="{{ $logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}"type="image/x-icon" />
    {{-- <link rel="icon" href="assets/images/favicon.svg" type="image/x-icon" /> --}}

    @if(isset($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on')
    <style>
        .g-recaptcha {
            filter: invert(1) hue-rotate(180deg) !important;
        }
        body{
            font-size: 0.9rem !important;
        }
    </style>
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" referrerpolicy="no-referrer" />


  </head>
  <body class="bg-light">

  <header>
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #54595f;">
        <a href="#">
                                <img src="{{ $logo . (isset($logos) && !empty($logos) ? $logos : 'logo-dark.png') . '?timestamp=' . time() }}" alt="{{ config('app.name', 'CRMGo Saas') }}" alt="logo" loading="lazy" class="logo" width="40px" height="40px">
                            </a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="navbarlogin">
                            <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                                @include('landingpage::layouts.buttons')
                                <div class="lang-dropdown-only-desk">
                                    <li class="dropdown dash-h-item drp-language">
                                        <a class="dash-head-link dropdown-toggle btn" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="drp-text"> {{ isset(Utility::languages()[$lang]) ? ucFirst(Utility::languages()[$lang]) : 'English' }}
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                                            @yield('language')
                                        </div>
                                    </li>
                                </div>
                            </ul>
            </div>
    </nav>
  </header>

        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-4 mt-5 mb-4">
                                    @yield('content')
                                </div>
                            </div>
        </div>

        <footer>
            <p class="text-center">
                <span>&copy; {{ (isset($footer_text)) ? $footer_text :config('app.name', 'Storego Saas')   }} </span>
            </p>
        </footer>

    @stack('custom-scripts')
    <script src="{{ asset('public/custom_assets/js/jquery.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>