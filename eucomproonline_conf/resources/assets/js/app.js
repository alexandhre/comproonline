
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueFire from 'vuefire'
Vue.use(VueFire);
import vSelect from "vue-select";

Vue.component("v-select", vSelect);


import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll);

import InfiniteScroll from 'v-infinite-scroll';
Vue.use(InfiniteScroll);

import StarRating from 'vue-star-rating';
Vue.component('star-rating', StarRating);

import money from 'v-money'

// register directive v-money and component <money>
Vue.use(money, {precision: 4});

import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'

Vue.use(Autocomplete);

import Vue2Filters from 'vue2-filters'
Vue.use(Vue2Filters)



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));


import carouselcategoria from './components/CarouselCategoria.vue'
import produto from './components/Produto.vue'
import demanda from './components/Demandas.vue'
import menucategoria from './components/MenuCategoria.vue'
import funcionamento from './components/Funcionamento.vue'
import categorias from './components/Categorias.vue'
import tipocategoria from './components/TipoCategoria.vue'
import detalhe from './components/ProdutoDetalhe.vue'
import chat from './components/Chat.vue'
import favoritos from './components/Favoritos.vue'
import editarperfil from './components/EditarPerfil.vue'
import menuusuario from './components/UsuarioMenu.vue'
import anuncie from './components/Anuncie.vue'
import meusanuncios from './components/MeusAnuncios.vue'
import busca from './components/Busca.vue'
import login from './components/Login.vue'
import produtosearch from './components/Produtosearch.vue'
import produtoeditar from './components/ProdutoEditar.vue'

const app = new Vue({
    el: '#app',
    components:{
        carouselcategoria,
        produto,
        demanda,
       
        funcionamento,
        categorias,
        tipocategoria,
        detalhe,
        chat,
        favoritos,
        editarperfil,
        menuusuario,
        anuncie,
        meusanuncios,
        login,
        produtosearch,
        produtoeditar
    }
});
const topo = new Vue({
    el: '#topo',
    components:{
        busca
    }
});
const menu = new Vue({
    el: '#menu',
    components:{
        menucategoria
    }
});