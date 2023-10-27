<template>
    <div class="column is-3">
        <table class="table">
            <tr v-if="urlpath === '/eucomproonline/anuncio/subir'" class="title is-6"><td  style="border: 0px"><span class="icon" style="color: #0092F6;position: relative;top:6px;right: 18px;box-shadow: 3px 3px 4px 0px rgba(10, 10, 10, 0.25);
    border-radius: 50px;"><i class="fas fa-plus-circle fa-2x"></i></span><a style="color: #2764AC;font-weight: bold;" href="/eucomproonline/anuncio/subir">Subir demanda</a></td></tr>
            <tr v-else  class="title is-6"><td  style="border: 0px"><span class="icon" style="color: #0092F6;position: relative;top:6px;right: 18px;box-shadow: 3px 3px 4px 0px rgba(10, 10, 10, 0.25);
    border-radius: 50px;"><i class="fas fa-plus-circle fa-2x"></i></span><a href="/eucomproonline/anuncio/subir">Subir demanda</a></td></tr>
        </table>
        <table class="table">
            <tr v-if="urlpath === '/eucomproonline/anuncio/meus/produtos/page'"  class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6;position: relative;top:6px;right: 18px;"><i class="fas fa-gift"></i></span><a href="/eucomproonline/anuncio/meus/produtos/page" style="color: #2764AC;font-weight: bold;">Eu compro...</a></td></tr>
            <tr v-else class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6;position: relative;top:6px;right: 18px;"><i class="fas fa-gift"></i></span><a href="/eucomproonline/anuncio/meus/produtos/page">Eu compro...</a></td></tr>

            <tr v-if="urlpath === '/eucomproonline/usuario/favorito/page'" class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6; position: relative;top:6px;right: 18px;"><i class="fas fa-heart"></i></span><a href="/eucomproonline/usuario/favorito/page" style="color: #2764AC;font-weight: bold;">Favoritos</a></td></tr>
            <tr v-else class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6; position: relative;top:6px;right: 18px;"><i class="fas fa-heart"></i></span><a href="/eucomproonline/usuario/favorito/page" >Favoritos</a></td></tr>

            <tr v-if="urlpath === '/eucomproonline/usuario/chat'" class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6; position: relative;top:6px;right: 18px;"><i class="far fa-comment-alt"></i></span><a href="/eucomproonline/usuario/chat" style="color: #2764AC;font-weight: bold;">Chats</a></td></tr>
            <tr v-else class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6; position: relative;top:6px;right: 18px;"><i class="far fa-comment-alt"></i></span><a href="/eucomproonline/usuario/chat">Chats</a></td></tr>

            <tr v-if="urlpath === '/eucomproonline/usuario/perfil'" class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6; position: relative;top:6px;right: 18px;"><i class="fas fa-user"></i></span><a href="/eucomproonline/usuario/perfil" style="color: #2764AC;font-weight: bold;">Perfil</a></td></tr>
            <tr v-else class="title is-6"><td  style="border: 0px"><span class="icon is-small" style="color: #0092F6; position: relative;top:6px;right: 18px;"><i class="fas fa-user"></i></span><a href="/eucomproonline/usuario/perfil">Perfil</a></td></tr>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            console.log(this.urlpath)
        },
        data(){
            return{
                urlpath: window.location.pathname,
            }
        },
    }
</script>
