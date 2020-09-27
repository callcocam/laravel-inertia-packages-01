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

mix.webpackConfig({
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/_dist/admin/js/src"),
            "@assets": path.resolve(__dirname, "resources/_dist/admin/resources/assets"),
            "@store": path.resolve(__dirname, "resources/_dist/admin/resources/js/src/store"),
            "@plugins": path.resolve(
                __dirname,
                "resources/_dist/admin/resources/js/src/utilities/plugins"
            ),
            "@views": path.resolve(__dirname, "resources/_dist/admin/resources/js/src/Pages"),
            "@components": path.resolve(
                __dirname,
                "resources/_dist/admin/resources/js/src/components"
            ),
            "@sass": path.resolve(__dirname, "resources/_dist/admin/resources/sass")
        }
    },
    output: {
        chunkFilename: "_dist/admin/js/chunks/[name].[chunkhash].js"
    }
});

mix.js('resources/_dist/admin/resources/js/app.js', 'public/_dist/admin/js')
    .sass('resources/_dist/admin/resources/sass/app.scss', 'public/_dist/admin/css');
//     .copy('resources/_dist/admin/resources/assets/css/iconfont.css', 'public/_dist/admin/css/iconfont.css')
//     .copyDirectory('resources/_dist/admin/resources/assets/fonts', 'public/_dist/admin/fonts') ;

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
