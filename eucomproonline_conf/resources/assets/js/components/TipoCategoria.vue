<template>
    <div>
        <div v-if="this.categoria.length !== 0">
            <!--------------------------------------TENIS FILTRO--------------->

            <section class="section" id="filtoButtom">
                <nav class="level">
                    <!-- Left side -->
                    <div class="level-left" style="padding-left: 150px">
                        <div class="level-item" style="height: 48px;
    width: 212px;
    border: 1px solid #A3ACBD;
    border-radius: 4px;
    background-color: #FFFFFF;
    box-shadow: 0 1px 2px 0 rgba(82,87,99,0.4);">
                            <a v-on:click="showFilter()" class="button is-medium " style="font-size: 16px; background-color: transparent; border-color: #ffffff; color: rgb(82, 87, 99);">
                        <span class="icon">
                             <i class="fas fa-sliders-h"></i>
                        </span>&nbsp&nbsp&nbsp&nbsp
                                Filtrar resultados</a>
                        </div>
                    </div>

                    <!-- Right side -->
                    <div class="level-right" style="padding-right:40px">
                        <div class="tabs is-centered" style="border-bottom-color:#ffffff">
                            <ul style="border-bottom-color:#ffffff">
                                <li>Ordenar por:&nbsp </li>

                                <div class="select">
                                    <select class="is-focused" style="border-color:#ffffff00;color:#23A7FB" v-model="sortBy">
                                        <option  value="lowestPrice"> menor preço</option>
                                        <option value="highestPrice"> maior preço</option>
                                    </select>
                                    <!--<select class="is-focused" style="border-color:#ffffff00;color:#23A7FB">-->
                                    <!--<option>preço</option>-->

                                    <!--</select>-->
                                </div>
                            </ul>
                        </div>

                    </div>
                </nav>
            </section>

            <section class="section" style="display: none" id="filto">
                <p class="container has-text-left" style="font-size: 18px; color: #23A7FB">Filtros</p>
                <br>

                <div class="container has-text-left">
                    <div class="columns">
                        <div class="column" style="padding-left: 68px;">
                            <p class="subtitle is-6 is-carvao is-bold">Tipo</p>
                            <div class="field has-text-left" style="width: 290px;background-color: #f9f9f9">
                                <div class="" style="margin-top: 25px; " id="Produtos">
                                    <v-select style="border: solid 1px #c1c1c1;"
                                              placeholder="Produtos"
                                              id="prod"
                                              :options="resultProd"
                                              @input="addCat"
                                    ></v-select>
                                </div>
                            </div>
                        </div>


                        <div class="column" style="padding-left: 35%; margin-block-start: -35px;">
                        <span v-on:click="backFilter()">
                            <button style="background-color:rgba(245,166,35,0); margin-left: 321px">
                                 <i class="fas fa-times" ></i>
                            </button>

                        </span>

                            <p class="subtitle is-6 is-carvao is-bold">Preço</p>
                            <section style="margin-top: 10px">
                                <div class="">
                                    <div class="range">
                                        <!--ATIVIAR DEPOIS -->
                                        <span style="" v-text="'R$ '+total"></span>
                                        <span style="margin-left: 25%;" v-text="'R$ '+total2" ></span><br/>
                                        <div class="columns is-multiline is-center" style="width: 1400px; margin-top:15px">
                                            <div class="columns is-2" style="width: 25%; margin-left: 1px;">
                                                <input type="range" min="0" :max="categoria['0'].VL_TIPO_ANUNCIO" step="1" v-model="value2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <section class="section has-text-centered">

                    <div class="buttons has-addons is-right" style="margin-right: 65px">
                        <span class="button is-medium is-outlined is-link" style="width: 212px;margin-right: 25px"  v-on:click="clearFilter()">Limpar filtro</span>

                        <span class="button gradiente is-medium" style="background-color: #0092F6; color: #ffffff;width: 212px"  v-on:click="selectedList()">Aplicar filtro</span>
                    </div>
                </section>
            </section>
            <!-----------------------------DEMANDAS--------------->

            <section class="section"  style="background:#ffffff; margin-top: -80px">
                <div class="container has-text-left" style="margin-top: 1%;">
                    <div class="columns is-multiline is-center"  style="width: 1200px" >
                        <div class="columns is-4" style="width: 25%; height: 25%; margin-left: 1px; margin-top: 1px;"  v-for="(item, index) in filterProduct">
                            <div class="card" style="border-radius: 4px; background-color: #FFFFFF;	box-shadow: 0 1px 2px 0 rgba(0,0,0,0.2); cursor: pointer">
                                <div class="card-image" style="height: 200px;" >
                                    <figure class="image is-2by1" style="width: 100%;">
                                        <img v-on:click="detalheOpen(item.ID_ANUNCIO_PRODUTO)" :src="'http://eucompro.online/eucomproonline/images/anuncios/'+item.ID_ANUNCIO_PRODUTO+'/'+item.foto" onerror="this.onerror=null;this.src='http://eucompro.online/eucomproonline/images/photo.png';" style="margin: auto; width: auto; height: auto; max-height: 100%; max-width:240px" alt="Placeholder image">
                                    </figure>
                                </div>
                                <div class="card-content" style="margin-left: -20px; height: 200px; width: 270px;">

                                    <p class="subtitle is-carvao is-5 is-bold">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                    <p class="subtitle is-7">{{item.DS_DETALHE_PRODUTO}}</p>
                                    <p class="subtitle is-carvao is-8">Disposto a pagar até</p>
                                    <p class="subtitle is-5 is-bold" style="color: #23A7FB">R$  {{(item.VL_TIPO_ANUNCIO - item.VL_DESCONTO) | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  })}}</p>

                                </div>
                                <button class="button gradiente" style=" background-color:#23A7FB; border-radius: 0 0 4px 4px; color:#ffffff; font-size: 14px; width:255px; height: 32px;" v-on:click="chatOpen(item.ID_ANUNCIANTE, item.ID_ANUNCIO_PRODUTO)">CHAT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>



        <div class="section" v-else>
            <div class="column" style="text-align:center">

                <h2>Esta categoria ainda não possui nenhum Produto</h2>

                <figure style="margin-left: 30%; margin-top: 5%">
                    <img class="image is-2by3" src="\eucomproonline\css\img\ilu_1.png" alt="ilu_1">
                </figure>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        props:['categoria'],
        mounted() {
            this.itensList = this.categoria;
            console.log(this.itensList);
            axios.post('/eucomproonline/categoria/produtos',{
                cat: this.categoria['0'].DS_CATEGORIA_PRODUTO
            }).then((response)=>{
                for(var i =0; i< response.data.length; i++){
                    this.resultProd.push( response.data[i].DS_TIPO_PRODUTO);
                }
                console.log(this.resultProd)
            });

            var vm = this;
            window.addEventListener('scroll', function(e){
                var scrollPos = window.scrollY;

                var winHeight = window.innerHeight;
                var docHeight = document.documentElement.scrollHeight;
                //console.log((docHeight-winHeight));
                var cat = window.location.pathname.split("/");
                if(scrollPos === (docHeight-winHeight)) {

                    //vm.anuncio = [];
                    vm.cont = vm.inicio + vm.cont;
                    axios.get('/eucomproonline/categoria/showmore/'+cat[4]+'/' + vm.cont).then(res => {

                        for (var i = 0; i < res.data.length; i++) {
                            //console.log(res.data);
                            vm.categoria.push(res.data[i]);

                        }
                        //vm.anuncio =   vm.item;
                        console.log(vm.anuncio);

                    });
                }

            })
        },
        data(){
            return{
                value: 0,
                value2: 0,
                resultProd:[],
                cat:'',
                itensList:[],
                search: '',
                cont : 0,
                inicio: this.categoria.length,
                sortBy: 'lowestPrice',
                urlpath: window.location.pathname,
            }
        },
        computed: {
            total: function () {
                return this.value
            },
            total2: function () {
                return this.value2
            },
            filterProduct: function () {
                return this.itensList.filter(res => {

                    return (this.search.length === 0 || res.DS_ANUNCIO_PRODUTO.toLowerCase().includes(this.search.toLowerCase()))

                }).sort((a, b) => {
                    if (this.sortBy === 'lowestPrice') {
                        return (a.VL_TIPO_ANUNCIO - a.VL_DESCONTO) - (b.VL_TIPO_ANUNCIO - b.VL_DESCONTO);

                    } else if (this.sortBy === 'highestPrice') {
                        return (b.VL_TIPO_ANUNCIO - b.VL_DESCONTO) - (a.VL_TIPO_ANUNCIO - a.VL_DESCONTO);

                    } else if (this.sortBy === 'betterRated') {
                        return b.VL_AVALIACAO_USUARIO_ANUNCIO - a.VL_AVALIACAO_USUARIO_ANUNCIO;
                    }
                })

            },
        },
        methods:{
            chatOpen(idAnudiante, idProduto){
                this.anuncio = $('#' + idProduto).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', idProduto);
                localStorage.setItem('ID_ANUNCIANTE', idAnudiante);
                window.open("/eucomproonline/usuario/chat",'_self');
            },
            showFilter: function(){
                $('#filtoButtom').css('display', 'none');
                $('#filto').css('display', 'block');
            },
            backFilter: function(){
                $('#filto').css('display', 'none');
                $('#filtoButtom').css('display', 'block');
            },
            detalheOpen(id){
                this.anuncio = $('#' + id).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id);
                window.open("/eucomproonline/anuncio/produto/detalhe",'_self');
            },
            selectedList: function() {
                if(this.cat !== ''){
                    this.itensList = [];
                    console.log(this.cat);
                    for(var i =0; i < this.categoria.length; i++) {

                        if ((this.categoria[i].VL_TIPO_ANUNCIO - this.categoria[i].VL_DESCONTO) >= this.value2) {
                            if(this.categoria[i].DS_TIPO_PRODUTO === this.cat){
                                this.itensList.push(this.categoria[i]);
                                console.log( this.itensList);
                            }
                        }
                    }
                }else{
                    this.itensList = [];
                    console.log(this.cat);
                    for(var i =0; i < this.categoria.length; i++) {

                        if ((this.categoria[i].VL_TIPO_ANUNCIO - this.categoria[i].VL_DESCONTO) >= this.value2) {
                                this.itensList.push(this.categoria[i]);
                                console.log( this.itensList);
                        }
                    }
                }
                return this.itensList;
            },
            addCat(cat){
                if(cat != null){
                    this.cat = cat;
                }else{
                    this.cat = ''
                }

            },
            clearFilter: function() {
                this.itensList = this.categoria;
            }
        }
    }
</script>
