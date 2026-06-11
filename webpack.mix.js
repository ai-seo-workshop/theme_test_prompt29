// 注意：本项目的 CSS 和 JS 直接存放在 public/css/themes/ 和 public/js/themes/ 目录下
// 无需通过 webpack mix 编译，此配置文件保留为 Laravel 默认结构
const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
