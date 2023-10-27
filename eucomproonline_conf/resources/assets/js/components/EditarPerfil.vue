<template>
    <!--------------------------------------FILTRO--------------->
    <section class="section">

        <div class="container has-text-centered">
            <div class="columns">

                <usuario-menu></usuario-menu>

                <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;" v-for="item in user">
                    <div class="card" style="width: 825px; background:#fafafa; box-shadow: 0 0px 0 rgba(10, 10, 10, 0.1), 0 0 1px 0 rgba(10, 10, 10, 0.1);">
                        <div class="card-content">
                            <div class="circulo" style="height: 81px;width: 81px;background:#fafafa;position:relative; top: 30px; left:40px;border:none">
                                <img  v-if="item.DS_FOTO_COMPRADOR === item.DS_FOTO_COMPRADOR && !url"  :src="'/eucomproonline\\images\\usuarios\\'+item.ID_ANUNCIANTE+'\\'+item.DS_FOTO_COMPRADOR"
                                      alt="" onerror="this.onerror=null;this.src='/eucomproonline/images/uploadImage.png';" style="border-radius: 50%;"/>
                                <img v-if="url" :src="url" alt="" />
                            </div>
                            <div class="file is-boxed" style="left: 200px; bottom: 50px;">
                                <label class="file-label" style="border-radius: 30px; ">
                                    <input class="file-input" @change="onFileChanged" type="file" name="resume" id="foto">
                                    <span class="file-cta" style="background-color: #2764AC">
                                      <span class="file-label">
                                        SUBIR UMA FOTO
                                      </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="width: 825px; background:#fafafa; margin-top: 20px">
                        <div class="card-content">
                            <div class="field has-text-left">
                                <label class="label" style="color:#525763; font-weight:normal">DADOS PESSOAIS</label>
                                <div class="control">
                                    <input class="input" style="font-size: 16px; background-color:#E5E8ED; width:60%" type="text" placeholder="Nome *" id="nome" :value="item.DS_NOME">
                                </div>
                            </div>

                            <div class="field has-text-left">
                                <div class="control">
                                    <input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED;width:60%" placeholder="Sobrenome*" id="sobrenome" :value="item.DS_SOBRENOME">
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="field has-text-left">
                                        <div class="control">
                                            <div class="select" style="width:19%" >
                                                <select style="font-size: 16px; color:#868C99;background-color:#E5E8ED;" id="ddd" :value="item.NR_DDD_TELEFONE">
                                                    <option v-for="item in ddd" :value="item"  >{{item}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field has-text-left" style="position:relative; right:300px;">
                                        <div class="control">
                                            <input class="input" type="tel" id="telefone" style="font-size: 16px; background-color:#E5E8ED;width:70%" placeholder="Telefone*" :value="item.NR_TELEFONE">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field has-text-left">
                                <div class="control">
                                    <input class="input" type="email"  id="mail" style="font-size: 16px; background-color:#E5E8ED;width:60%" placeholder="E-mail*" :value="item.DS_EMAIL">
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr class="dropdown-divider" style="width: 50%">
                    <div class="card" style="width: 825px; background:#fafafa; margin-top: 20px">
                        <div class="card-content">
                            <div class="field has-text-left">
                                <label class="label" style="color:#525763; font-weight:normal">ENDEREÇO</label>
                                <div class="control">
                                    <input class="input" style="font-size: 16px; background-color:#E5E8ED; width:60%" type="text" id="endereco" placeholder="Endereço*"  :value="item.endereco['0'].DS_BAIRRO">
                                </div>
                            </div>
                            <div class="field has-text-left">
                                <div class="control">
                                    <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:60%" id="complemento" placeholder="Complemento" :value="item.endereco['0'].DS_COMPLEMENTO">
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <div class="field has-text-left ">
                                        <div class="control">
                                            <input class="input" type="email" style="font-size: 16px; background-color:#E5E8ED;width:35%" id="numero" placeholder="Número*" :value="item.endereco['0'].NR_ENDERECO">
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field has-text-left" style="width: 82%;position:relative; right:250px;">
                                        <div class="control">
                                            <input class="input" type="text" style="font-size: 16px; background-color:#E5E8ED; width: 70%" id="cep" placeholder="CEP*" :value="item.endereco['0'].DS_CEP">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 30%;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                    <div class="" style="margin-top: 25px;" id="categoria">
                                        <v-select   placeholder="UF"
                                                    id="cat"
                                                    :options="result"
                                                    @input="autCcomleteProd"
                                                    v-model="item.endereco['0'].uf"
                                        ></v-select>
                                    </div>
                                </div>
                                <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb;margin-bottom: 0.75em;">
                                    <div class="" style="margin-top: 25px; " id="Produtos">
                                        <v-select   placeholder="Cidade"
                                                    id="prod"
                                                    :options="resultProd"
                                                    @input="addProd"
                                                    v-model="item.endereco['0'].cidade"
                                        ></v-select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr class="dropdown-divider" style="width: 50%">

                    <div class="card" style="width: 825px; background:#fafafa;">
                        <div class="card-content">
                            <div class="field has-text-left">
                                <label class="label" style="color:#525763; font-weight:normal">Senha</label>
                                <div class="control">
                                    <input class="input" style="font-size: 16px; background-color:#E5E8ED; width:60%" type="password" id="senha" placeholder="Nova senha">
                                </div>
                            </div>
                            <div class="field has-text-left">
                                <div class="control">
                                    <input class="input" type="password"  style="font-size: 16px; background-color:#E5E8ED;width:60%" id="senhaconf" placeholder="Confirme a senha">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-grouped" style="margin-top: 80px;margin-bottom: 80px">
                        <p class="control">
                            <a class="button gradiente" style="color:#525763;background-color:#FFFFFF;box-shadow:1px 1px #A8ABB1, 0px 0px 0 1px #A8ABB1; width:281px; height: 48px;" href="/eucomproonline/usuario/perfil">Cancelar</a>
                        </p>
                        <p class="control">
                            <a class="button gradiente" style="background-color: #2764AC; color:#ffffff;font-weight: bold;width:281px; height: 48px;margin-left:96px;" v-on:click="updateUser" id="salvar1">Guardar mudanças</a>
                        </p>
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
        mounted() {
            axios.get('/eucomproonline/usuario/detail').then(resp =>{

                this.user = resp.data;
                console.log(this.user[0]);
                for(var i =0; i< this.user['0'].estados.length; i++){

                    this.result.push( this.user['0'].estados[i]);
                    this.uf = this.user['0'].endereco['0'].uf;
                    this.cidade = this.user['0'].endereco['0'].cidade;
                }
                console.log(this.result)
            });

        },
        data(){
            return{
                selectFile:{name: null},
                url: null,
                senha: '',
                confsenha: '',
                ddd:['11', '21','27', '31','41','48','51','61','62','63','65','67','68','69','71','79','81','82','83','84','85','86','91','92','95','96','98'],
                user:[],
                result:[],
                resultProd:[],
                uf: '',
                cidade:''
            }
        },
        methods:{
            autCcomleteProd(c){
                console.log(c);
                this.resultProd= [];
                axios.post('/eucomproonline/enderecos/cidade',{
                    uf: c
                }).then((response)=>{
                    //console.log(response.data[0].cidade);

                    for(var i =0; i< response.data.length; i++){
                        this.resultProd.push((response.data[i].cidade));
                    }
                });

                this.uf = c;
            },
            addProd(cidade){
                this.cidade= cidade;

            },


            onFileChanged: function (event) {
                this.selectFile = event.target.files[0];
               
                // if(this.selectFile.size < 2000000) {
                     
                    this.url = URL.createObjectURL(this.selectFile);
                    const formData = new FormData();
                    if (this.selectFile.name !== null) {
                        formData.append('myFile', this.selectFile, this.selectFile.name);
                        axios.post('/eucomproonline/usuario/foto/update', formData);
                    } else {
                        axios.post('/eucomproonline/usuario/foto/update', null);
                    }
                // }else{
                //     alert("Imagem selecionada é muito grande");
                // }
            },
            updateUser: function () {

                var formData = new FormData();
                if(this.selectFile.name!==null) {
                    formData.append('myFile', this.selectFile, this.selectFile.name);
                    axios.post('/eucomproonline/usuario/foto/update', formData);
                    console.log(formData);
                }else{
                    console.log(formData);
                    axios.post('/eucomproonline/usuario/foto/update', 0);
                    this.url = 0;
                }
                this.input = [
                    $('#nome').val(),
                    $('#telefone').val(),
                    $('#ddd').val(),
                    $('#mail').val(),
                    $('#sobrenome').val(),
                    $('#complemento').val(),
                    $('#endereco').val(),
                    $('#numero').val(),
                    $('#cep').val(),
                    this.uf,
                    this.cidade,
                    $('#senha').val(),
                    this.selectFile.name,
                    this.url,

                ];
                console.log(this.selectFile);
                console.log(this.input);

                $('#salvar1').removeClass('button  is-block has-button-yellow');
                $('#salvar1').addClass('button  is-block has-button-yellow is-loading');

                axios({
                    method: 'post', // verbo http
                    url: '/eucomproonline/usuario/update', // url
                    data: {
                        input:  this.input, // Parâmetro 1 enviado
                    }
                }).then(response => {
                    console.log(response);

                    alert("Informações alteradas com sucesso");
                    window.open('/eucomproonline/usuario/perfil', '_self');
                    $('#salvar1').removeClass('button  is-block has-button-yellow is-loading');
                    $('#salvar1').addClass('button  is-block has-button-yellow');
                }).catch(e => {
                    console.log('deu erro');
                });
            },
        }
    }
</script>
