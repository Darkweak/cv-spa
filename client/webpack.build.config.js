const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const LoadablePlugin = require('@loadable/webpack-plugin');

module.exports = {
  target: 'web',
  devtool: 'source-map',
  mode: 'production',
  entry: './src/index.tsx',
  module: {
    rules: [
      {
        test: /\.s?css$/,
        resolve: {
          extensions: ['.css', '.scss', '.sass'],
        },
        use: [
          MiniCssExtractPlugin.loader,
          { loader: 'css-loader', options: { sourceMap: true } },
          { loader: 'postcss-loader', options: { sourceMap: true } },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true
            },
          },
        ],
      },
      {
        exclude: /node_modules/,
        loader: 'babel-loader',
        test: /\.[jt]sx?$/
      }
    ]
  },
  optimization: {
    splitChunks: {
      chunks: 'all',
      cacheGroups: {
        commons: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendors',
          chunks: 'all',
          minChunks: 2,
        },
        default: {
          minChunks: 2,
          reuseExistingChunk: true,
        },
      },
    },
  },
  plugins: [
    new LoadablePlugin(),
    new webpack.DefinePlugin({
      'process.env': {
        REACT_APP_API_ENTRYPOINT: JSON.stringify(process.env.REACT_APP_API_ENTRYPOINT),
        REACT_APP_DOMAIN: JSON.stringify(process.env.REACT_APP_DOMAIN),
        REACT_APP_NAME: JSON.stringify(process.env.REACT_APP_NAME),
      },
    }),
    new MiniCssExtractPlugin({
      filename: "[name].css",
      chunkFilename: "[id].css"
    })
  ],
  resolve: {
    extensions: [
      '.js',
      '.jsx',
      '.css',
      '.scss',
      '.tsx',
      '.ts'
    ]
  },
  node: { fs: 'empty', net: 'empty' },
  output: {
    filename: '[chunkhash].[name].bundle.js',
    chunkFilename: '[chunkhash].[name].bundle.1_0.chunk.js',
    path: path.resolve(__dirname, 'public/dist')
  }
};
