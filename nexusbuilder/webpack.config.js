const path = require('path');

module.exports = {
  entry: {
    index: './assets/editor/index.tsx',
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'assets/editor'),
  },
  resolve: {
    extensions: ['.ts', '.tsx', '.js'],
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        use: 'ts-loader',
        exclude: /node_modules/,
      },
    ],
  },
};
