const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const path = require('path');

module.exports = (env, argv) => {
    const isProduction = argv.mode === 'production';

    return {
        entry: {
            'wp-ingresso-scripts': './resources/ts/wp-ingresso.ts',
        },
        output: {
            filename: isProduction ? 'js/[name].min.js' : 'js/[name].js',
            path: path.resolve(__dirname, 'assets'),
        },
        module: {
            rules: [
                {
                    test: /\.ts$/,
                    use: 'ts-loader',
                    exclude: /node_modules/,
                },
                {
                    test: /\.scss$/,
                    use: [
                        MiniCssExtractPlugin.loader, // Extract CSS into separate files
                        'css-loader',                 // Translates CSS into CommonJS
                        'postcss-loader',             // Processes CSS with PostCSS (Tailwind, etc.)
                        'sass-loader',                // Compiles SCSS into CSS
                    ],
                },
            ],
        },
        resolve: {
            extensions: ['.ts', '.js', '.scss'],
            modules: ['node_modules'],
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: isProduction ? 'css/[name].min.css' : 'css/[name].css',
            }),
        ],
        optimization: {
            minimize: isProduction,
        },
        mode: isProduction ? 'production' : 'development',
    };
};
