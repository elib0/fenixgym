var elixir = require('laravel-elixir');
var paths = {
	vendor: {
		css:'public/css/vendor/',
		js:'public/js/vendor/'
	},
	modules: 'node_modules/'
};

//TAREAS

//Moviendo vendors(Bootstrap,Vue,etc)
elixir(function(mix) {
    mix.copy(paths.modules+'bootstrap/dist/css/*.min.css', paths.vendor.css+'bootstrap.css'); //BootStrap
    mix.copy(paths.modules+'vue/dist/*.min.js', paths.vendor.js+'vue.js');					  //Vue
    mix.copy(paths.modules+'vue-resource/dist/*.min.js', paths.vendor.js+'vueresourse.js');   //Vue Resource
    mix.copy(paths.modules+'vue-strap/dist/*.min.js', paths.vendor.js+'vuestrap.js');		  //Vue Strap
});
//Compilando hoja de estilos principal
elixir(function(mix) {
    mix.sass('app.sass');
});
//Viendo cambios en archivos
elixir(function(mix) {
    mix.browserSync({
        proxy: 'fenix_gym.dev'
    });
});