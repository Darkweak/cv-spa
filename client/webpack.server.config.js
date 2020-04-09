const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  target: 'node',
  mode: 'production',
  entry: './src/server/index.tsx',
  devtool: 'inline-source-map',
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
        test: /\.tsx?$/,
        loader: 'awesome-typescript-loader',
        exclude: /node_modules/
      },
      {
        test: /\.jsx?$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      }
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env': {
        REACT_APP_API_ENTRYPOINT: JSON.stringify('http://cache.domain.com'),
        REACT_APP_DOMAIN: JSON.stringify('http://localhost:3000'),
        REACT_APP_NAME: JSON.stringify('APP name'),
      }
    }),
    new MiniCssExtractPlugin({
      // Options similar to the same options in webpackOptions.output
      // both options are optional
      filename: "[name].css",
      chunkFilename: "[id].css"
    })
  ],
  resolve: {
    extensions: [
      '.js',
      '.css',
      '.scss',
      '.tsx',
      '.ts'
    ]
  },
  output: {
    globalObject: 'typeof self !== \'undefined\' ? self',
    filename: 'server.js',
    path: path.resolve(__dirname)
  }
};
