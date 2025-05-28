const path = require("path")
const { merge } = require("webpack-merge")
const defaultConfig = require("@wordpress/scripts/config/webpack.config")
const MiniCssExtractPlugin = require("mini-css-extract-plugin")

module.exports = merge(defaultConfig, {
  entry: async () => {
    const defaultEntry = await defaultConfig.entry()

    return {
      ...defaultEntry,
      "custom/format-types": path.resolve(__dirname, "src/custom/index.js"),
    }
  },
  output: {
    ...defaultConfig.output,
    filename: "[name].js",
    path: path.resolve(__dirname, "build"),
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "styles/[name].css", // relative to output.path
    }),
  ],
})
