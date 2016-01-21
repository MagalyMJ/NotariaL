var elixir = require('laravel-elixir');

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
elixir(function(mix) {
    mix.styles([
        'normalize.css',
        'styleicon.css',
        'daterangepiker.css',
        'styles.css',
    ]).version('public/css/all.css');
});

elixir(function(mix) {
    mix.styles([
        "normalize.css",
        "pdf.css"
    ], 'public/css/pdf.css');
});
elixir(function(mix) {
    mix.scripts(['enajenanteSript.js'], 'public/js/index.js')
});