const elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss');
});

elixir(mix => {
    mix.styles([
        'resources/assets/css'
    ], 'public/css/app.css');
});

elixir(mix => {
    mix.scripts([
        'resources/assets/js',
    ], 'public/js/app.js')
});

elixir(mix => {
    mix.version(["public/css/app.css", "public/js/app.js"]);
});
