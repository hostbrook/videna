let mix = require('laravel-mix');

mix.js('src/js/app.js', 'public/js/app.js')
    .minify('public/js/app.js')
    .sourceMaps();

mix.less('src/less/app.less', 'public/css/app.css')
    .minify('public/css/app.css')
    .sourceMaps();