<template>
    <section class="section" style="background: #54BAFB;padding: 0rem 0rem;">

        <div class="tabs is-centered">

            <ul style="border-bottom-color: #ffffff00;">
                <li class="is-active a" v-if="urlpath === '/eucomproonline/home'">
                    <a href="/eucomproonline/home">
                        <span>Popular</span>
                    </a>
                </li>
                <li class="" v-else>
                    <a href="/eucomproonline/home">
                        <span style="color: #2764AC">Popular</span>
                    </a>
                </li>

                <li class="is-active a" style="padding-left: 50px;"  v-if="urlpath === '/eucomproonline/categoria/todas'">
                    <a href="/eucomproonline/categoria/todas">
                        <span >Categorias</span>
                    </a>
                </li>
                <li style="padding-left: 50px;" v-else>
                    <a href="/eucomproonline/categoria/todas">
                        <span style="color: #2764AC" >Categorias</span>
                    </a>
                </li>

                <div v-for="item in categoria.slice(0,4)" >

                    <li class="is-active a" style="padding-left: 50px;"  v-if='urlpath === "/eucomproonline/categoria/tipo/"+item.DS_CATEGORIA_PRODUTO || item.DS_CATEGORIA_PRODUTO == cat'>
                        <a :href='"/eucomproonline/categoria/tipo/"+item.DS_CATEGORIA_PRODUTO'>
                            <span >{{item.DS_CATEGORIA_PRODUTO}}</span>
                        </a>
                    </li>
                    <li class="" style="padding-left: 50px;" :id="item.DS_CATEGORIA_PRODUTO" :ref="item.DS_CATEGORIA_PRODUTO" v-else>
                        <a :href='"/eucomproonline/categoria/tipo/"+item.DS_CATEGORIA_PRODUTO'>
                            <span style="color: #2764AC">{{item.DS_CATEGORIA_PRODUTO}}</span>
                        </a>
                    </li>
                </div>

                <li style="padding-left: 50px;">
                    <div class="dropdown is-hoverable">
                        <div class="dropdown-trigger">
                            <button class="button gradiente" style="background-color: #54BAFB">
                                <span class="dropdown-item is-active a" style="color: #2764AC">Mais</span>
                            </button>
                        </div>
                        <div class="dropdown-menu" style="margin-left: -170%;">
                            <div class="dropdown-content">
                                
                                <div  v-for="(item, index) in categoria.slice(4)"  :key="index">
                                        <a :href='"/eucomproonline/categoria/tipo/"+item.DS_CATEGORIA_PRODUTO' style="border-bottom-color: #ffffff00; justify-content: flex-end">
                                            {{item.DS_CATEGORIA_PRODUTO}}
                                        </a>
                                        <a v-if="item.DS_CATEGORIA_PRODUTO == cat">
                                            {{selectPosition(cat)}}
                                        </a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        
    </section>
</template>

<script>


    export default {
         props: {
            cat: {
                type: String,
                default: ''
            }
        },
        created() {
            this.urlpath = decodeURIComponent(this.urlpath);
            
            axios.get('/eucomproonline/categoria/menu').then(resp =>{
                this.categoria = resp.data;
                
                  
                for(var i=0; i < this.categoria.length; i++){   
                   
                    if('/eucomproonline/categoria/tipo/'+this.categoria[i].DS_CATEGORIA_PRODUTO === this.urlpath){
                         this.changePosition(this.categoria, i,0)
                    }
                }
            });
        },
        
        data(){
            return{
                urlpath: window.location.pathname,
                categoria:[],
                categ: this.cat
            }
        },
         methods:{
           changePosition : function (arr, from, to) {
                    
                    arr.splice(to, 0, arr.splice(from, 1)[0]);
                    //this.categoria =arr;
                    return  arr;
            },
            selectPosition(catg){
              
                for(var i=0; i < this.categoria.length; i++){
                    
                    if(this.categoria[i].DS_CATEGORIA_PRODUTO == catg){
                          this.changePosition(this.categoria, i,0)
                    }
                }
                
            }

        }
    }
</script>


