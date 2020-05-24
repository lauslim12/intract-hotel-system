module.exports = {
  mode: 'development',
	entry: "./assets/js/react.js",
	output: {
		path: __dirname + "/assets/js",
		publicPath: "/",
		filename: "bundle.js",
	},
	module: {
		rules: [
			{
				test: /\.(js|jsx)$/,
				exclude: /node_modules/,
				use: ["babel-loader"],
			},
		],
	}
};
