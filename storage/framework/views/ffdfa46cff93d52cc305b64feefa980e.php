<?php
    $settings = Utility::settings();
    
    $color = !empty($settings['color']) ? $settings['color'] : 'theme-3';

    if (isset($settings['color_flag']) && $settings['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }

    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_favicon = Utility::getValByName('company_favicon');
    $company_logo = \App\Models\Utility::GetLogo();
    \App\Models\Utility::setPusherConfig();
    \App\Models\Utility::setMailConfig();
    $users = \Auth::user();
    $currantLang = $users->currentLanguage();
    // $languages=\App\Models\Utility::languages();
    $footer_text = isset($settings['footer_text']) ? $settings['footer_text'] : '';
    // $setting = App\Models\Utility::colorset();
    $SITE_RTL = !empty($settings['SITE_RTL']) ? $settings['SITE_RTL'] : 'off';
?>
<!doctype html>
<html lang="en" dir="<?php echo e($SITE_RTL == 'on' ? 'rtl' : ''); ?>">
    <head>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="url" content="<?php echo e(url('') . '/' . config('chatify.routes.prefix')); ?>" data-user="<?php echo e(Auth::user()->id); ?>">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> <?php echo $__env->yieldContent('page-title'); ?> -
            <?php echo e(Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'CRMGo SaaS')); ?>

        </title>    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo $__env->make('partials.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    </head>
  <body>

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- header -->
    <header>
        <?php echo $__env->make('partials.admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>


    <h1>Hello, world!</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html><?php /**PATH C:\Users\shari\ICU\SAAS CRM 19\code\resources\views/layouts/admin.blade.php ENDPATH**/ ?>