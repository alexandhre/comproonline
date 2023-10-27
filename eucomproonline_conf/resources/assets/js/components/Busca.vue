<template>

    <div id="navbarExampleTransparentExample" v-if="'/usuario/perfil' !== urlpath
                                                                    && '/usuario/chat' !== urlpath && '/anuncio/subir' !== urlpath
                                                                    && '/anuncio/meus/produtos/page' !== urlpath && '/usuario/favorito/page' !== urlpath">

        <!--<div class="navbar-start" style="display: block">-->
        <!--<slot name="buscar"></slot>-->

        <p class="control has-icons-left" style="top:15px">
            <autocomplete style="font-size:14px;width:450px; background-color: rgba(255, 255, 255, 0); height:40px; !important;background-image: none"
                          :search="search"
                          placeholder="Quero comprar..."
                          aria-label="Quero comprar..."
                          @submit="handleSubmit"
            ></autocomplete>
            <span class="icon is-large has-text">
                    <i class="fas fa-5x fa-search" aria-hidden="true" style="color: #2764AC"></i>
                  </span>
        </p>

        <!--</div>-->
    </div>

</template>
<style>

</style>
<script>
    export default {
        mounted() {

            axios.post('/eucomproonline/anuncio/buscar', {
                cat: this.cat
            }).then((response) => {
                //console.log(response.data);
                for (var i = 0; i < response.data[0].length; i++) {
                    this.result.push(response.data[0][i].DS_CATEGORIA_PRODUTO);
                }
                for (var i = 0; i < response.data[1].length; i++) {
                    this.result.push(response.data[1][i].DS_ANUNCIO_PRODUTO);
                }

            });
        },
        data: function(){
            return {
                result:[],
                urlpath: window.location.pathname,
                cat: ''
            }
        },
        methods: {
            search(input) {
                this.cat = input;

                    if (input.length < 2) {
                        return []
                    }
                    return  this.result.filter( result => {
                        return  result.toLowerCase()
                            .startsWith(input.toLowerCase())
                    })
            },

            handleSubmit(result){

                localStorage.setItem('produto',result);
                localStorage.setItem('categoria',result);

                window.open('/eucomproonline/anuncio/produto/type')

            }
        }
    }
</script>
