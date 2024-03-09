<?php
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
?>
<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($SITE_RTL == 'on' ? 'rtl' : ''); ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="PHP 19">

    <title> <?php echo $__env->yieldContent('page-title'); ?> -
        <?php echo e(Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'SAAS CRM')); ?>

    </title>    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <!-- SEO -->
    <meta name="keyword" content="<?php echo e(!empty($settings['meta_keyword']) ? $settings['meta_keyword'] : ''); ?>">
    <meta name="description" content="<?php echo e(!empty($settings['meta_description']) ? $settings['meta_description'] : ''); ?>">

      <!-- Open Graph / Facebook -->
      <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e(!empty($settings['meta_keyword']) ? $settings['meta_keyword'] : ''); ?>">
    <meta property="og:description"
        content="<?php echo e(!empty($settings['meta_description']) ? $settings['meta_description'] : ''); ?>">
    <meta property="og:image"
        content="<?php echo e(asset('storage/meta/' . (isset($settings['meta_image']) && !empty($settings['meta_image']) ? $settings['meta_image'] : ''))); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e(!empty($settings['meta_keyword']) ? $settings['meta_keyword'] : ''); ?>">
    <meta property="twitter:description"
        content="<?php echo e(!empty($settings['meta_description']) ? $settings['meta_description'] : 'meta_image.png'); ?>">
    <meta property="twitter:image"
        content="<?php echo e(isset($settings['meta_image']) && !empty($settings['meta_image']) ? $settings['meta_image'] : ''); ?>">
        

        

    <link rel="icon"
    href="<?php echo e($logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"type="image/x-icon" />
    

    <?php if(isset($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on'): ?>
    <style>
        .g-recaptcha {
            filter: invert(1) hue-rotate(180deg) !important;
        }
        body{
            font-size: 0.9rem !important;
        }
    </style>
    <?php endif; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" referrerpolicy="no-referrer" />


  </head>
  <body class="bg-light">

  <header>
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #54595f;">
        <a href="#">
                                <img src="<?php echo e($logo . (isset($logos) && !empty($logos) ? $logos : 'logo-dark.png') . '?timestamp=' . time()); ?>" alt="<?php echo e(config('app.name', 'CRMGo Saas')); ?>" alt="logo" loading="lazy" class="logo" width="40px" height="40px">
                            </a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="navbarlogin">
                            <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                                <?php echo $__env->make('landingpage::layouts.buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="lang-dropdown-only-desk">
                                    <li class="dropdown dash-h-item drp-language">
                                        <a class="dash-head-link dropdown-toggle btn" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="drp-text"> <?php echo e(isset(Utility::languages()[$lang]) ? ucFirst(Utility::languages()[$lang]) : 'English'); ?>

                                            </span>
                                        </a>
                                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                                            <?php echo $__env->yieldContent('language'); ?>
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
                                    <?php echo $__env->yieldContent('content'); ?>
                                </div>
                            </div>
        </div>

        <footer>
            <p class="text-center">
                <span>&copy; <?php echo e((isset($footer_text)) ? $footer_text :config('app.name', 'Storego Saas')); ?> </span>
            </p>
        </footer>

    <?php echo $__env->yieldPushContent('custom-scripts'); ?>
    <script src="<?php echo e(asset('public/custom_assets/js/jquery.min.js')); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html><?php /**PATH C:\Users\shari\ICU\SAAS CRM 19\code\resources\views/layouts/auth.blade.php ENDPATH**/ ?>