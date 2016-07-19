import Vue from 'vue';
import VueResource from 'vue-resource';

Vue.use(VueResource);

var vm = new Vue({

	el: "#app",
	ready: function(){
		console.log('Esto es VUe')
	}

})