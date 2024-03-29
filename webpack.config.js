const path = require('path');
// const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');
const defaultConfig = require('./node_modules/@wordpress/scripts/config/webpack.config.js');

const devMode = process.env.NODE_ENV !== 'production';

const wplib = [
    'hooks',
];

// Turn Off url imports in CSS (background urls)
const rules = defaultConfig.module.rules;
rules[devMode ? 3 : 2].use[1].options.url = false;

module.exports = {
    ...defaultConfig,
    entry: {
        'select2': path.resolve(process.cwd(), 'src', 'scss', 'vendor', 'select2.scss'),
        'gutenberg': path.resolve(process.cwd(), 'src', 'js', 'gutenberg', 'index.js'),
        'reviews': path.resolve(process.cwd(), 'src', 'js', 'reviews', 'index.js'),
        'admin': path.resolve(process.cwd(), 'src', 'js', 'admin', 'index.js'),
    },
    output: {
        path: path.resolve(process.cwd(), `assets/${devMode ? 'unminified' : 'minified'}`),
        filename: devMode ? 'js/[name].js' : 'js/[name].min.js',
    },
    externals: wplib.reduce((externals, lib) => {
        externals[`wp.${lib}`] = {
            window: ['wp', lib],
        };

        return externals;
    }, {
        'wp': 'wp',
        'lodash': '_',
        'jquery': 'jQuery',
        'react': 'React',
        'react-dom': 'ReactDOM',
    }),
    plugins: [
        // new CleanWebpackPlugin({ cleanOnceBeforeBuildPatterns: ['**/*', '!fonts/**', '!images/**'] }),
        process.env.WP_BUNDLE_ANALYZER && new BundleAnalyzerPlugin(),
        new MiniCssExtractPlugin({ filename: devMode ? 'css/[name].css' : 'css/[name].min.css' }),
        !process.env.WP_NO_EXTERNALS && new DependencyExtractionWebpackPlugin({ injectPolyfill: true }),
    ].filter(Boolean),
};