var config = {
	del: {
		src: './web/dist/'
	},

	watch: {
		scss: './web/src/scss/**/**',
		js: './web/src/js/**/**'
	},

	scss: {
		src: './web/src/scss/app.scss',
		outputStyle: 'compressed',
		dest: './web/dist/css/'
	},

	js: {
		src: [
			'./web/src/js/app.js',
			'./web/src/js/initializers/**',
			'./web/src/js/components/**',
			'./web/src/js/pages/**',
			'./web/src/js/init.js'
		],
		outputName: 'app.js',
		dest: './web/dist/js/'
	}
};

module.exports = config;
