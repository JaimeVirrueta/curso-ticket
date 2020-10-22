const mix = require('laravel-mix');

mix
    .styles([
        'resources/vendor/fontawesome-free-5.11.2-web/css/all.min.css',
        'resources/vendor/icheck-bootstrap/icheck-bootstrap.min.css',
        'resources/vendor/toastr/toastr.css',
        'resources/css/adminlte.css',
    ], 'public/css/app.css')

    .js('resources/js/app.js', 'public/js')

    .scripts([
        'resources/vendor/jquery/jquery.min.js',
        'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'resources/vendor/toastr/toastr.min.js',
    ], 'public/js/vendor.js')

    .copy('resources/vendor/fontawesome-free-5.11.2-web/webfonts', 'public/webfonts')
    .copy('resources/img', 'public/img')

    .version()
;
