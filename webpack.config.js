const Encore = require('@symfony/webpack-encore');
const SpriteLoaderPlugin = require('svg-sprite-loader/plugin');
const glob = require("glob");

Encore
// directory where compiled assets will be stored
    .setOutputPath('public_html/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('index', './assets/js/pages/index.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')

    .addEntry('img', glob.sync('./assets/images/*'))

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

// uncomment if you use TypeScript
//.enableTypeScriptLoader()

    .enableLessLoader()
    .enablePostCssLoader()
    .autoProvidejQuery()
    .cleanupOutputBeforeBuild()
    .disableImagesLoader()

    .addLoader({
        test: /\.(png|jpg|jpeg|gif|ico|svg|webp)$/,
        loader: 'file-loader',
        exclude: /svg-sprite/,
        options: {
            name: 'assets/images/[name].[hash:8].[ext]',
        }
    })

    .addLoader({
        test: /\.svg$/,
        exclude: /images/,
        loader: 'svg-sprite-loader',
        options: {
            esModule: false
        }
    })

    .addPlugin(
        new SpriteLoaderPlugin({
        })
    )
;

module.exports = Encore.getWebpackConfig();

