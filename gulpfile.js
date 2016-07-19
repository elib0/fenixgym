var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

//Contantes
const paths = {
	vendor: {
		css:'public/css/vendor/',
		js:'public/js/vendor/'
	},
	src: {
		css: 'public/css/',
		js: 'public/js/'
	},
	modules:'node_modules/'
};

//Tareas
elixir(function(mix) {
    mix.copy(paths.modules+'bootstrap/dist/css/*.min.css', paths.vendor.css+'bootstrap.css')
       .copy(paths.modules+'vue/dist/*.min.js', paths.vendor.js+'vue.js')
       .copy(paths.modules+'vue-resource/dist/*.min.js', paths.vendor.js+'vueresource.js')
       .copy(paths.modules+'vue-strap/dist/*.min.js', paths.vendor.js+'vuestrap.js')
       .sass('app.sass')
       .browserify('app.js',paths.src.js+'app.js')
	   .browserSync({
	        proxy: 'fenix_gym.dev'
	   });
});