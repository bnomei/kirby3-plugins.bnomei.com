let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

mix.setPublicPath('public');
mix.setResourceRoot('src');

mix.postCss('src/css/app.css', 'public/assets/css', [
  require('precss')(),
  tailwindcss('./tailwind.js'),
]).sourceMaps();

mix.js('src/js/app.js', 'public/assets/js')
  .sourceMaps()
  .version();

/*
mix.browserSync({
  proxy: 'homestead.test',
  files: [
    'public/assets/app.css',
    'public/assets/app.js',
  ]
});
*/
