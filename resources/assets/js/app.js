import Vue from 'vue';
import VueResource from 'vue-resource';

//Vue Strap
import alert from './components/Alert.vue';

Vue.use(VueResource);

var app = new Vue({

	el: "#app",
	components:{
		alert
	},
	data:{
		showModal: false,
		response: {message:null,title:null}
	},
	ready: function(){
		console.log('Aplicacion lista Laravel + Vue!')
	}

})

window.vm = app;