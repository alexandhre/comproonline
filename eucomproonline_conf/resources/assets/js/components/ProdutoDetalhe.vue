<template>
    <div>
            <MenuCategoria :cat="this.anuncio.DS_CATEGORIA_PRODUTO"></menucategoria>
        <!--------------------------------------breadcrumb--------------->
        <section class="section">
            <div class="container has-text-left">

                <nav class="breadcrumb"  aria-label="breadcrumbs">
                    <ul>
                        <li><a :href="'/eucomproonline/categoria/tipo/'+ anuncio.DS_CATEGORIA_PRODUTO">{{this.anuncio.DS_CATEGORIA_PRODUTO}}</a></li>
                        <li><a href="#" aria-current="page">{{this.anuncio.DS_TIPO_PRODUTO}}</a></li>
                    </ul>
                </nav>

                <div class="columns">

                    <div class="column" >
                        <div class="column" style="display: flex">
                            <!-- <div class="column is-2">
                                <div class="media" style="width: 100px;">
                                    <figure class="image">
                                        <div v-for="(item, index) in images.slice(1, 5)">
                                            <img style="height: 100%; width: 70%" :id="'img'+(index+1)" v-on:click="changeImg(index+1)"
                                                 :src="item" onerror="this.onerror=null;this.src='/eucomproonline/images/photo.png';" alt="">
                                            <br>
                                        </div>
                                    </figure>
                                </div>
                            </div> -->

                            <!--------------------------------------SELEÇÂO--------------->
                            <div class="column" style="margin-bottom: 20px;">
                                <div class="media-content">
                                    <div class="media-left">
                                        <figure class="image" v-for="item in images.slice(0, 1)">
                                            <img class="image is-2by3" id="imgP" style="height: auto;width: auto;margin: auto;"
                                                 :src="item" onerror="this.onerror=null; this.src='/eucomproonline/images/photo.png';" alt="">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <article class="media" style="width: 540px">
                            <div class="media-left">
                                <p class="title is-2 is-bold" style="color: #0092F6;">
                                    {{this.anuncio.DS_ANUNCIO_PRODUTO}}
                                </p>
                            </div>
                            <div class="media-content">
                            </div>
                            <div class="media-right">
                                <p class="buttons">
                                    <a class="button gradiente">
                                      <span class="icon" v-on:click="addFavarito(anuncio.ID_ANUNCIO_PRODUTO)">
                                        <div>
                                            <i class="far fa-heart" style="display: block; color: #0092f6" id="heart1" ></i>
                                            <i class="fas fa-heart" style="display: none;color: #0092f6" id="heart2"></i>
                                        </div>
                                    </span>
                                    </a>
                                    <a class="button gradiente">
                                        <span class="icon" v-on:click="copyTestingCode()">
                                          <i class="fas fa-share-alt"></i>
                                            <input type="hidden" id="testing-code" :value="anuncio.urlsearch">
                                        </span>
                                    </a>
                                </p>
                            </div>
                        </article>

                        <p class="subtitle is-7" style="width: 540px">
                            {{this.anuncio.DS_DETALHE_PRODUTO}}
                        </p>

                    </div>

                    <!--------------------------------------INFORMAÇÕES DO PRODUTO--------------->
                    <div class="column is-5" style="padding: 100px 40px;background: #fafafa;width: auto; margin-top: -8%;">
                        <article class="media">
                            <div class="media-left">
                                <a class="image"><img class="is-rounded" style="position:relative;top:10px;height: 72px; width:72px" :src="'/eucomproonline/images/usuarios/'+anuncio.ID_ANUNCIANTE+'/'+anuncio.DS_FOTO_COMPRADOR" onerror="this.onerror=null;this.src='/eucomproonline/images/photo.png';" alt=""></a>
                            </div>
                            <div class="media-right">
                                <p class="subtitle is-6 is-bold" style="position:relative;top:15px;">{{this.anuncio.DS_NOME}}</p>
                                <p class="subtitle is-7" style="position:relative;top:20px;">{{this.anuncio.DS_BAIRRO}}, Nº {{this.anuncio.NR_ENDERECO}}</p>

                                <figure style="position:relative;bottom:42px;right: 0px">
                                    <star-rating :rating="this.avaliacao"
                                                 :show-rating="false"
                                                 :read-only="true"
                                                 v-bind:increment="1"
                                                 v-bind:max-rating="5"
                                                 v-bind:star-size="20">
                                    </star-rating>
                                </figure>
                            </div>
                        </article>
                        <div class="media-content">
                            <img  src="http://eucompro.online/eucomproonline/images/eucompro.png"  alt="eucompro">
                            <!-- <p class="title is-3 is-bold" style="color: #23A7FB">Eucompro</p> -->
                            <p class="subtitle is-6 has-text-left is-bold">{{this.anuncio.DS_ANUNCIO_PRODUTO}}</p>
                            <p class="subtitle is-6 has-text-left is-bold" style="color: #23A7FB">R$ {{this.anuncio.VL_TIPO_ANUNCIO | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}</p>
                        </div>
                        <br><br>
                        <p class="control">
                            <button class="button gradiente" style="background-color: #23A7FB; color: #ffffff; height: 48px;width: 282px;" v-on:click="chatOpen(anuncio.ID_ANUNCIANTE)">Chat</button>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!--------------------------------------DEMANDAS--------------->
        <hr style="color: #D6DCE4; width: 1109px;margin-left: 10%;height: 2px;">
        <section class="section">
            <div class="container has-text-left">

                <h2 class="subtitle is-4 is-carvao">Outros interesses de {{this.anuncio.DS_NOME}}</h2>
            </div>
            <br>
            <section class="section" style="background: none">
                <div id="v-carousel" type="x/template">
                    <div class="card-carousel-wrapper">
                        <div class="card-carousel--nav__left" @click="moveCarousel(-1)" :disabled="atHeadOfList"></div>
                        <div class="card-carousel">
                            <div class="card-carousel--overflow-container">
                                <div class="card-carousel-cards" :style="{ transform: 'translateX' + '(' + currentOffset + 'px' + ')'}">
                                    <div class="column" v-for="item in outrosAnuncios">
                                        <div class="card" style="border-radius: 2%; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.2); height: 100%; cursor: pointer"  >
                                            <div class="card-image" style="height: 200px;" v-on:click="detalheOpen(item.ID_ANUNCIO_PRODUTO)">
                                                <figure class="image is-1by1">
                                                    <img :src="'http://eucompro.online/eucomproonline/images/anuncios/'+item.ID_ANUNCIO_PRODUTO+'/'+item.foto" onerror="this.onerror=null;this.src='/eucomproonline/images/photo.png';" style="margin: auto; width: auto; height: auto; max-height: 100%; max-width:240px;" alt="Placeholder image">
                                                </figure>
                                            </div>
                                            <div class="card-content" style="height:40%" v-on:click="detalheOpen(item.ID_ANUNCIO_PRODUTO)">
                                                <p class="subtitle is-bold is-6">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                                <p class="subtitle is-7" style="text-align: left">{{item.DS_DETALHE_PRODUTO}}</p>
                                            </div>
                                            <div class="card-footer">
                                                <button class="button gradiente" style=" background-color:#23A7FB; border-radius: 0 0 4px 4px; color:#ffffff; font-size: 14px; width:100%; height: 32px;" v-on:click="chatOpenMoreProdutos(item.ID_ANUNCIANTE, item.ID_ANUNCIO_PRODUTO)">CHAT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-carousel--nav__right" @click="moveCarousel(1)" :disabled="atEndOfList"></div>
                    </div>
                </div>
            </section>
        </section>

        <!--&lt;!&ndash; Modal &ndash;&gt;-->
        <!--<div class="modal" id="myModal" >-->
            <!--<div class="modal-card" style="width: 40%;">-->
                <!--<header class="rectangle-10" style=" width: 100%">-->

                <!--</header>-->
                <!--<section class="modal-card-body body-modal" style="width: 100%;">-->
                    <!--<div>-->
                        <!--<button class="button" id="close" style="float: right; background: rgba(89,93,102,0);border: transparent;"><i class="fa fa-times fa-1x" style="color: #888888;"></i></button>-->
                        <!--<div style="display: -webkit-inline-box; border: 1px solid black;">-->
                            <!--<div style="display: inline" >-->
                                <!--<div>-->
                                    <!--<p class="subtitle is-6" ref="copiar" id="link" style="padding: 2px; display: flex">-->
                                        <!--http://eucompro.online/eucomproonline{{this.urlpath}}-->
                                    <!--</p>-->
                                    <!--<input type="hidden" id="testing-code" :value="'http://eucompro.online/eucomproonline'+this.urlpath">-->
                                <!--</div>-->
                                    <!--<button class="button"  v-on:click="copyTestingCode" id="comprar" style="color:#3D455C; background: none; border none">-->
                                        <!--copiar-->
                                    <!--</button>-->

                            <!--</div>-->

                        <!--</div>-->
                    <!--</div>-->
                    <!--<hr/>-->
                <!--</section>-->

            <!--</div>-->
        <!--</div>-->


    </div>
</template>


<script>
    import Vue from 'vue'
    import carouselcategoria from './CarouselCategoria.vue'
    import MenuCategoria from './MenuCategoria.vue'
    Vue.component('CarouselCategoria', carouselcategoria);
    Vue.component('MenuCategoria', MenuCategoria);

    export default {
        data(){
            return{
                anuncio:[],
                images: [],
                outrosAnuncios: [],
                currentOffset: 0,
                windowSize: 3,
                paginationFactor: 220,
                fav: 0,
                urlpath: window.location.pathname,
                avaliacao:0,
                categoria: ''
            }
        },
        computed: {
            atEndOfList() {
                return this.currentOffset <= (this.paginationFactor * -1) * (this.outrosAnuncios.length - this.windowSize);
            },
            atHeadOfList() {
                return this.currentOffset === 0;
            },
        },
        mounted() {
            var aux = localStorage.getItem('ID_ANUNCIO_PRODUTO');
            axios.get('/eucomproonline/anuncio/produto/detalhe/' + aux ).then(resp =>{

                this.anuncio = resp.data['0'];
                //this.categoria = this.anuncio.DS_CATEGORIA_PRODUTO;
                this.avaliacao = this.anuncio.avaliacao[0].avaliacao
                this.favorito(this.anuncio.favorito);
                localStorage.setItem('categoriaMenu', this.anuncio.DS_CATEGORIA_PRODUTO)
                for (var i = 0; i < this.anuncio.foto.length; i++) {
                    this.images.push('http://eucompro.online/eucomproonline/images/anuncios/'+ this.anuncio.ID_ANUNCIO_PRODUTO+'/'+this.anuncio.foto[i].foto);
                }
               // console.log(this.images);
                var x = this.anuncio.ID_ANUNCIO_PRODUTO;
                //console.log(localStorage.getItem('VISITA'+x));
                if(!localStorage.getItem('VISITA'+x)){
                    axios.get('/eucomproonline/anuncio/visita/' + this.anuncio.ID_ANUNCIO_PRODUTO ).then(resp =>{
                        localStorage.setItem('VISITA'+x, 1)
                    });
                }
                
            });
            axios.get('/eucomproonline/anuncio/outros/produtos/' + aux).then(resp =>{
                console.log(resp.data);
                this.outrosAnuncios = resp.data;
            });
        },
        methods:{
            copyTestingCode () {
                let testingCodeToCopy = document.querySelector('#testing-code');
                testingCodeToCopy.setAttribute('type', 'text') ;   // 不是 hidden 才能複製
                testingCodeToCopy.select();
                console.log(testingCodeToCopy);
                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    alert('Link copiado!');
                } catch (err) {
                    alert('Oops, erro ao copiar link!');
                }

                /* unselect the range */
                testingCodeToCopy.setAttribute('type', 'hidden');
                window.getSelection().removeAllRanges()
            },
            chatOpen(id){

                localStorage.setItem('ID_ANUNCIANTE', id);
                window.open("/eucomproonline/usuario/chat",'_self');
            },
            chatOpenMoreProdutos(id, idProduto){
                localStorage.setItem('ID_ANUNCIANTE', id);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', idProduto);
                window.open("/eucomproonline/usuario/chat",'_self');
            },
            detalheOpen(id){
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id);
                window.open("/eucomproonline/anuncio/produto/detalhe",'_self');
            },
            changeImg(id){

                var imgatual =  this.images[id];

                this.images[id] = document.getElementById('imgP').src;

                var imganterior = document.getElementById('imgP').src;

                $('#imgP').attr('src', imgatual);
                $('#img'+id).attr('src', imganterior);
            },
            moveCarousel(direction) {
                // Find a more elegant way to express the :style. consider using props to make it truly generic
                if (direction === 1 && !this.atEndOfList) {
                    this.currentOffset -= this.paginationFactor;
                } else if (direction === -1 && !this.atHeadOfList) {
                    this.currentOffset += this.paginationFactor;
                }
            },
            addFavarito(id){

                axios.get('/eucomproonline/usuario/favorito/add/'+ id).then(res => {
                    console.log(res.data);

                    if(res.data === 0){
                        $('#heart1').css('display','block');
                        $('#heart2').css('display','none');

                    }else if(res.data === -1){
                        showlogin()
                    }else{
                        $('#heart1').css('display','none');
                        $('#heart2').css('display','block');
                    }

                })
                    .catch(e => {
                        console.log('deu erro');
                    });
            },
            favorito(fav){

                if(fav === null){
                    $('#heart1').css('display','block');
                    $('#heart2').css('display','none');

                }else{
                    $('#heart1').css('display','none');
                    $('#heart2').css('display','block');
                }
            }
        }
    }
</script>
