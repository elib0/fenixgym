import Vue from 'vue';
import VueResource from 'vue-resource';

//Vue Strap
import alert from './components/Alert.vue';

Vue.use(VueResource);

var vm = new Vue({

	el: "#app",
	components:{
		alert
	},
	ready: function(){
		console.log('Esto es VUe')
	}

})