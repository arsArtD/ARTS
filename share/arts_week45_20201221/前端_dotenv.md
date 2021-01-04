```
let envOptions = {
     path:  './.env' ,  // load this now instead of the ones in '.env'
     safe:  true ,  // load '.env.example' to verify the '.env' variables are all set. Can also be a string to a different file.
     allowEmptyValues:  true ,  // allow empty variables (e.g. `FOO=`) (treat it as empty string, rather than missing)
     systemvars:  true ,  // load all the predefined 'process.env' variables which will trump anything local per dotenv specs.
     silent:  true ,  // hide any errors
     defaults:  false  // load '.env.defaults' as the default values if empty.
}

module.exports = {
  entry: {
    bundle: path.resolve(__dirname, '../src/index.js')
  },
  output: {
    path: path.resolve(__dirname, '../dist'),
    filename: '[name].[hash].js',
    publicPath:  function(){
        const dotenv = require('dotenv');
        console.log('================================================');
        console.log(dotenv.config(envOptions).parsed);
        return dotenv.config(envOptions).parsed.PUBLIC_PATH;
    }(),
  },
  resolve: {
    extensions: ['*', '.js', '.json', '.vue'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
      '@': path.resolve(__dirname, '../src'),
      'pages': path.resolve(__dirname, '../src/pages')
    }
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        use: ['babel-loader'],
        exclude: /node_modules/
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
      {
          test: /\.(png|jpg|gif|svg)$/,
          loader: 'file-loader',
          options: {
              name: '[name].[ext]?[hash]'
          }
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf|svg)$/,
        use: [
          //'file-loader'
            {loader:'file-loader',options:{name:'fonts/[name].[hash:8].[ext]'}}
        ]
      }
    ]
  },
  plugins: [
    new Dotenv(envOptions),
    new HtmlWebpackPlugin({
        template: path.resolve(__dirname, '../index.html')
    }),
    new AutoDllPlugin({
      inject: true, // will inject the DLL bundle to index.html
      debug: true,
      filename: '[name]_[hash].js',
      path: './dll',
      entry: {
        vendor: ['vue', 'vue-router', 'vuex']
      }
    }),
    new VueLoaderPlugin(),
    new webpack.optimize.SplitChunksPlugin()
  ]
}
```
