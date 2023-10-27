<template>
    <!--------------------------------------FILTRO--------------->
    <section class="section">

        <div class="container has-text-centered">
            <div class="columns">

                <usuario-menu></usuario-menu>


                <div class="column has-text-left" v-if="this.anuncio.length !== 0" >
                    <div class="container has-text-left" style="margin-top: 1%;margin-left: -8%;">
                        <div class="columns is-multiline is-center" style="width: 1200px"  >
                            <div class="columns is-3" style="width: 25%; height: 25%; margin: 1%;"  v-for="item in this.anuncios">
                                <div class="card" style="border-radius: 4px; background-color: #FFFFFF;	box-shadow: 0 1px 2px 0 rgba(0,0,0,0.2);}">
                                    <div style="cursor: pointer" v-on:click="editar(item.ID_ANUNCIO_PRODUTO)">
                                        <div class="card-image" >
                                            <figure class="image is-2by1" style="width: 100%;">
                                                <img :src="'http://eucompro.online/eucomproonline/images/anuncios/'+item.ID_ANUNCIO_PRODUTO+'/'+item.foto" onerror="this.onerror=null;this.src='/eucomproonline/images/photo.png';" style="margin: auto; width: auto; height: auto; max-height: 100%; max-width:240px" alt="Placeholder image">
                                            </figure>
                                        </div>
                                        <div class="card-content" style="margin-left: -20px; height: 200px; width: 270px;">

                                            <p class="subtitle is-carvao is-5 is-bold">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                            <p class="subtitle is-7">{{item.DS_DETALHE_PRODUTO}}</p>
                                            <p class="subtitle is-carvao is-8">Disposto a pagar até</p>
                                            <p class="subtitle is-5 is-bold" style="color: #23A7FB">R$ {{(item.VL_TIPO_ANUNCIO - item.VL_DESCONTO) | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  })}}</p>
                                        </div>
                                    </div>
                            <button class="button gradiente" style=" background-color:#23A7FB; border-radius: 0 0 4px 4px; color:#ffffff; font-size: 14px; width:255px; height: 32px;" v-on:click="chatOpen(item.ID_ANUNCIANTE, item.ID_ANUNCIO_PRODUTO)">CHAT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns is-centered" style="margin-top: 13%; margin-bottom: 6%" v-else>
                    <div class="column" style="padding-left:260px; text-align:center">

                        <h2>Você nao possui nenhum item favoritado</h2>

                        <figure style="width: 500px; margin-top: 5%">
                            <img class="image is-2by3" src="\eucomproonline\css\img\ilu_1.png" alt="ilu_1">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Vue from 'vue'
    import menuusario from './UsuarioMenu.vue'

    Vue.component('UsuarioMenu', menuusario);
    export default {
        props:['anuncio'],
        mounted() {
            // axios.get('/usuario/favorito/listar').then(resp =>{
            //     this.anuncios = resp.data;
            // });
            console.log( this.anuncio.length);
            this.anuncios = this.anuncio;
        },
        data(){
            return {
                anuncios:[]
            }
        },
        methods:{
            detalheOpen(id){
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id);
                window.open("/eucomproonline/anuncio/produto/detalhe",'_self');
            },
            chatOpen(id, idProduto){
                this.anuncio = $('#' + id).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIANTE', id);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', idProduto);
                window.open("/eucomproonline/usuario/chat",'_self');
            },
        }
    }
</script>
