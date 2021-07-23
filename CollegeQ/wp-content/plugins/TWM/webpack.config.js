const path = require("path");
const OptimizeCssAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

module.exports = (env, argv) => {
  let production = argv.mode === "production";

  return {
    entry: {
      "js/admin": path.resolve(__dirname, "app/admin.js"),
      "js/shortcode": path.resolve(__dirname, "app/shortcode.js"),
      "js/widget": path.resolve(__dirname, "app/widget.js"),
    },

    output: {
      filename: "main.js",
      path: path.resolve(__dirname, "/dist"),
    },

    devtool: production ? "" : "source-map",

    resolve: {
      extensions: [".js", ".jsx", ".json"],
    },

    module: {
      rules: [
        {
          test: /\.jsx?$/,
          exclude: /node_modules/,
          loader: "babel-loader",
        },
        {
          test: /\.sass$/i,
          use: [
            { loader: "style-loader" },
            { loader: "css-loader", options: { sourceMap: true } },
            {
              loader: "postcss-loader",
              options: { sourceMap: true, plugins: [require("autoprefixer")] },
            },
            {
              loader: "sass-loader",
              options: {
                sourceMap: true,
                implementation: require("sass"),
                sassOptions: { outputStyle: "compressed" },
              },
            },
          ],
        },
        {
          test: /\.(gif|png|jpe?g|svg)$/i,
          use: [
            {
              loader: "file-loader",
              options: {
                esModule: false,
              },
            },
            {
              loader: "url-loader",
              options: {
                limit: 8192,
                fallback: require.resolve("image-webpack-loader"),
                mozjpeg: {
                  progressive: true,
                  quality: 65,
                },
                optipng: {
                  enabled: false,
                },
                pngquant: {
                  quality: [0.65, 0.9],
                  speed: 4,
                },
              },
            },
          ],
        },
      ],
    },
    plugins: [
      new CleanWebpackPlugin(),
      new OptimizeCssAssetsPlugin({
        cssProcessorOptions: {
          map: {
            inline: false,
            annotation: true,
          },
        },
      }),
    ],
  };
};
