<template>
    <!--------------------------------------FILTRO--------------->
    <section class="section">

        <div class="container has-text-centered">
            <div class="columns">

                <usuario-menu></usuario-menu>

                <div class="column" style="border: 0px solid #4d4f6845; border-width: 0px 0px 0px 0px;">
                    <p class="subtitle is-carvao is-4 is-bold has-text-left" style="margin-top: 15px">Informação básica</p>

                    <div class="card" style="width: 920px; background:#fafafa;">
                        <div class="card-content">
                            <div class="field has-text-centered" style="margin-top: 20px">
                                <label class="label has-text-left" style="color:#525763; font-weight:normal">Pode subir até 5 fotografias</label>
                                <div class="file is-white is-boxed" style="margin-top: 25px;margin-left: 60px">
                                    <div class="upload-image is-pulled-left  " >
                                        <label for="file" class="label-file-img" >
                                            <img id="uploadicon1" class="upload-icon" src="/eucomproonline/images/photo.png">
                                            <div class="image-wrapper">

                                                <img id="imagem1" src="">
                                            </div>
                                            <a id="close1" class="button-close close" name="uploadImage"
                                               style="display:none; position: static; margin-top: -110px;margin-left: 110px;"><i class="fa fa-times-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                            <a id="open1" class="button-open open" name="uploadImage"
                                            style="position: static; margin-top: -20px; margin-left: 110px;"
                                            ><i class="fa fa-plus-circle fa-2x"
                                                aria-hidden="true"></i></a>
                                        </label>
                                        <p id="filename1" class="file-name"></p>
                                        <input id="file" name="image1" type="file" class="input-file"
                                               @change="onFileChanged1">
                                        <div id="horizontal1" class="horizontal-line"></div>
                                        <div class="under-block">
                                            <input id="input1" type="submit" value="Upload" class="input-submit" style="display:none;">
                                        </div>
                                    </div>
                                    <div class="upload-image is-pulled-left " >
                                        <label for="file2" class="label-file-img">
                                            <img id="uploadicon2" class="upload-icon" src="/eucomproonline/images/photo.png">

                                            <div class="image-wrapper">
                                                <img id="imagem2" src="">
                                            </div>
                                            <a id="close2" class="button-close close" name="uploadImage"
                                               style="display:none; position: static; margin-top: -110px;margin-left: 110px;"><i class="fa fa-times-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                            <a id="open2" class="button-open open" name="uploadImage"
                                               style="position: static; margin-top: -20px; margin-left: 110px;"><i class="fa fa-plus-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                        </label>

                                        <p class="file-name"></p>
                                        <input id="file2" name="image2" type="file" class="input-file"
                                               @change="onFileChanged2">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block">
                                            <input type="submit" value="Upload" class="input-submit" style="display:none;">
                                        </div>
                                    </div>
                                    <div class="upload-image is-pulled-left " >
                                        <label for="file3" class="label-file-img" >
                                            <img id="uploadicon3" class="upload-icon" src="/eucomproonline/images/photo.png">
                                            <div class="image-wrapper">
                                                <img id="imagem3" src="">
                                            </div>
                                            <a id="close3" class="button-close close" name="uploadImage"
                                               style="display:none; position: static; margin-top: -110px;margin-left: 110px;"><i class="fa fa-times-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                            <a id="open3" class="button-open open" name="uploadImage"
                                               style="position: static; margin-top: -20px; margin-left: 110px;"><i class="fa fa-plus-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                        </label>
                                        <p class="file-name"></p>
                                        <input id="file3" type="file" class="input-file" name="image3"
                                               @change="onFileChanged3">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block">
                                            <input type="submit" value="Upload" class="input-submit" style="display:none;">
                                        </div>
                                    </div>
                                    <div class="upload-image is-pulled-left " >
                                        <label for="file4" class="label-file-img">
                                            <img id="uploadicon4" class="upload-icon" src="/eucomproonline/images/photo.png">
                                            <div class="image-wrapper">
                                                <img id="imagem4" src="">
                                            </div>
                                            <a id="close4" class="button-close close" name="uploadImage"
                                               style="display:none; position: static; margin-top: -110px;margin-left: 110px;"><i class="fa fa-times-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                            <a id="open4" class="button-open open" name="uploadImage"
                                               style="position: static; margin-top: -20px; margin-left: 110px;"><i class="fa fa-plus-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                        </label>
                                        <p class="file-name"></p>
                                        <input id="file4" type="file" class="input-file" name="image4"
                                               @change="onFileChanged4">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block">
                                            <input type="submit" value="Upload" class="input-submit"style="display:none;">
                                        </div>
                                    </div>
                                    <div class="upload-image is-pulled-left "  >
                                        <label for="file5" class="label-file-img">
                                            <img id="uploadicon5" class="upload-icon" src="/eucomproonline/images/photo.png">
                                            <div class="image-wrapper">
                                                <img id="imagem5" src="">
                                            </div>
                                            <a id="close5" class="button-close close" name="uploadImage"
                                               style="display:none; position: static; margin-top: -110px;margin-left: 110px;"><i class="fa fa-times-circle fa-2x"
                                                                        aria-hidden="true"></i></a>
                                            <a id="open5" class="button-open open" name="uploadImage"
                                               style="position: static; margin-top: -20px; margin-left: 110px;"><i class="fa fa-plus-circle fa-2x"
                                                                         aria-hidden="true"></i></a>
                                        </label>
                                        <p class="file-name"></p>
                                        <input id="file5" type="file" class="input-file" name="image5"
                                               @change="onFileChanged5">
                                        <div class="horizontal-line"></div>
                                        <div class="under-block">
                                            <input type="submit" value="Upload" class="input-submit" style="display:none;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="width: 920px; background:#fafafa;">

                        <div class="card-content">
                            <div class="field has-text-left" style="margin-left: 30px; margin-top: 24px; width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#525763; font-weight:normal">Eu compro...</label>
                                 <div class="control has-icons-left" style="margin-top: 25px">
                                       <span class="icon is-small is-left" style="height: 27px; width: 20px; position:static;">
                                      <i class="fas fa-star" style="position:absolute; margin-top: 20%"></i>
                                    </span>
                                    <input class="input" style="position:static;box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;" type="text" id="titulo" required autofocus>
                                 
                                </div>
                            </div>

                            <div class="field has-text-left" style="padding-left: 30px;width: 55%;margin-top: 48px">
                                <label class="label" style="color:#525763; font-weight:normal">Descrição</label>
                                <div class="control">
                                    <textarea class="textarea" style="background-color:#E5E8ED;" id="descricao" required autofocus></textarea>
                                </div>
                            </div>

                            <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#525763; font-weight:normal">Categoria</label>
                                <div class="" style="margin-top: 25px; " id="categoria">
                                    <v-select   placeholder="Categorias"
                                                id="cat"
                                                :options="result"
                                                @input="autCcomleteProd"
                                    ></v-select>
                                </div>
                            </div>
                            <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                <label class="label has-text-left" style="color:#525763; font-weight:normal">Produtos</label>
                                <div class="" style="margin-top: 25px; " id="Produtos">
                                    <v-select   placeholder="Produtos"
                                                id="prod"
                                                :options="resultProd"
                                                @input="addProd"
                                    ></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="width: 920px; background:#fafafa;">
                            <div class="card-content">
                                <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 597px">
                                    <p class="subtitle is-6" style="color:#525763; font-weight:bold">Preço</p>
                                    <p class="subtitle is-7" style="color:#868C99; font-weight:normal">Diga pra gente até quanto você estaría disposto a pagar perlo produto. O ideal é que seja um preço realista e de acordo com o mercado.</p>
                                </div>
                                <div class="field has-text-left" style="margin-left: 30px; margin-top: 25px; width: 290px;">
                                    <label class="label has-text-left" style="color:#525763; font-weight:normal">Preço unitario </label>
                                    <div class="control has-icons-left" style="margin-top: 25px">
                                        <!--<input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;" type="text" placeholder="R$20,00" id="preco" required autofocus>-->
                                        <money  class="input" style="position:static; box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;background-color: #fafafa; font-size: 14px;border-width: 0px 0px 1px 0px;border-color:#dbdbdb;" placeholder="R$20,00" id="preco" v-model="price" v-bind="money"></money>
                                         <span class="icon is-small is-left" style="height: 27px; width: 20px; position:static;">
                                            <i class="far fa-money-bill-alt" style="position: absolute;margin-top: -20%;"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <div class="buttons has-addons is-centered" style="margin-top: 90px;margin-bottom: 100px">
            <div class="control">
                <button type="submit" class="button gradiente" style="background-color: #0092F6; color:#ffffff;font-weight: bold;width:283px; height: 48px;margin-inline-end: 80px;" v-on:click="concluir">Subir anuncio</button>
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
            axios.get('/eucomproonline/categoria/menu').then((response)=>{

                for(var i =0; i< response.data.length; i++){
                    this.result.push( response.data[i].DS_CATEGORIA_PRODUTO);
                }

            });

        },
        data(){
            return{
                result: [],
                resultProd:[],
                url1:'',
                url2:'',
                url3:'',
                url4:'',
                url5:'',
                selectedFile1: {name: null},
                selectedFile2: {name: null},
                selectedFile3: {name: null},
                selectedFile4: {name: null},
                selectedFile5: {name: null},
                cat:'',
                prod:'',
                foto:[],
                price: 0.00,
                money: {
                    decimal: ',',
                    thousands: '',
                    prefix: 'R$ ',
                    precision: 2,
                    masked: false
                }
            }
        },
        methods:{
            autCcomleteProd(c){
                console.log(c);
                this.resultProd= [];
                axios.post('/eucomproonline/categoria/produtos',{
                    cat: c
                }).then((response)=>{
                    for(var i =0; i< response.data.length; i++){
                        this.resultProd.push( response.data[i].DS_TIPO_PRODUTO);
                    }
                });

                this.cat = c;
            },
            addProd(prod){
                this.prod= prod;

            },
            onFileChanged1: function (event) {
                this.selectedFile1 = event.target.files[0];
                this.url1 = URL.createObjectURL(this.selectedFile1);
               
                if(this.selectedFile1.size < 2000000) {
                    if (this.selectedFile1) {
                        $('#filename1').removeClass("bad-input");
                        $('#close1').css('display', 'block');
                        $('#open1').css('display', 'none');
                        $('#uploadicon1').css('display', 'none');
                        $('#imagem1').css('display', 'block');
                        $('#imagem1').attr('src', this.url1);
                    }

                    const formData = new FormData();
                    if (this.selectedFile1 !== null) {
                        formData.append('myFile', this.selectedFile1, this.selectedFile1.name);
                        axios.post('/eucomproonline/anuncio/foto', formData);
                    } else {
                        axios.post('/eucomproonline/anuncio/foto', null);
                    }
                    console.log(this.selectedFile1.name);
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            onFileChanged2: function (event) {
                this.selectedFile2 = event.target.files[0];
                this.url2 = URL.createObjectURL(this.selectedFile2);
                
                if(this.selectedFile2.size < 2000000) {
                    if (this.selectedFile2) {
                        $('#filename2').removeClass("bad-input");
                        $('#close2').css('display', 'block');
                        $('#open2').css('display', 'none');
                        $('#uploadicon2').css('display', 'none');
                        $('#imagem2').css('display', 'block');
                        $('#imagem2').attr('src', this.url2);
                    }

                    const formData = new FormData();
                    if (this.selectedFile2 !== null) {
                        formData.append('myFile', this.selectedFile2, this.selectedFile2.name);
                        axios.post('/eucomproonline/anuncio/foto', formData);
                    } else {
                        axios.post('/eucomproonline/anuncio/foto', null);
                    }
                    console.log(this.selectedFile2.name);
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            onFileChanged3: function (event) {
                this.selectedFile3 = event.target.files[0];
                this.url3 = URL.createObjectURL(this.selectedFile3);
                if(this.selectedFile3.size < 2000000) {

                    if (this.selectedFile3) {
                        $('#filename3').removeClass("bad-input");
                        $('#close3').css('display', 'block');
                        $('#open3').css('display', 'none');
                        $('#uploadicon3').css('display', 'none');
                        $('#imagem3').css('display', 'block');
                        $('#imagem3').attr('src', this.url3);
                    }

                    const formData = new FormData();
                    if (this.selectedFile3 !== null) {
                        formData.append('myFile', this.selectedFile3, this.selectedFile3.name);
                        axios.post('/eucomproonline/anuncio/foto', formData);
                    } else {
                        axios.post('/eucomproonline/anuncio/foto', null);
                    }
                    console.log(this.selectedFile3.name);
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            onFileChanged4: function (event) {
                this.selectedFile4 = event.target.files[0];
                this.url4 = URL.createObjectURL(this.selectedFile4);
                if(this.selectedFile4.size < 2000000) {

                    if (this.selectedFile4) {
                        $('#filename4').removeClass("bad-input");
                        $('#close4').css('display', 'block');
                        $('#open4').css('display', 'none');
                        $('#uploadicon4').css('display', 'none');
                        $('#imagem4').css('display', 'block');
                        $('#imagem4').attr('src', this.url4);
                    }

                    const formData = new FormData();
                    if (this.selectedFile4 !== null) {
                        formData.append('myFile', this.selectedFile4, this.selectedFile4.name);
                        axios.post('/eucomproonline/anuncio/foto', formData);
                    } else {
                        axios.post('/eucomproonline/anuncio/foto', null);
                    }
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            onFileChanged5: function (event) {
                this.selectedFile5 = event.target.files[0];
                this.url5 = URL.createObjectURL(this.selectedFile5);
                if(this.selectedFile5.size < 2000000) {

                    if (this.selectedFile5) {
                        $('#filename5').removeClass("bad-input");
                        $('#close5').css('display', 'block');
                        $('#open5').css('display', 'none');
                        $('#uploadicon5').css('display', 'none');
                        $('#imagem5').css('display', 'block');
                        $('#imagem5').attr('src', this.url5);
                    }

                    const formData = new FormData();
                    if (this.selectedFile5 !== null) {
                        formData.append('myFile', this.selectedFile5, this.selectedFile5.name);
                        axios.post('/eucomproonline/anuncio/foto', formData);
                    } else {
                        axios.post('/eucomproonline/anuncio/foto', null);
                    }
                
                }else{
                    alert("Imagem selecionada é muito grande");
                }

            },
            concluir() {
                if (this.selectedFile1.name === null &&
                    this.selectedFile2.name === null &&
                    this.selectedFile3.name === null &&
                    this.selectedFile4.name === null &&
                    this.selectedFile5.name === null) {
                    alert("Selecione no mínimo uma foto");
                    return false
                }

                if (!$('#titulo').val()) {
                    alert("campos em branco");
                    $('#titulo').css('border-bottom', '1px solid red');
                } else if (!$('#descricao').val()) {
                    alert("campos em branco");
                    $('#descricao').css('border-bottom', '1px solid red');
                } else if (this.cat === '') {
                    alert("campos em branco");
                    $('#cat').css('border-bottom', '1px solid red');
                } else if (this.prod === '') {
                    alert("campos em branco");
                    $('#pord').css('border-bottom', '1px solid red');
                } else if ($('#preco').val() === 'R$ 0,00') {
                    alert("campos em branco");
                    $('#preco').css('border-bottom', '1px solid red');
                }
                this.input = [

                    $('#titulo').val(),
                    $('#descricao').val(),
                    $('#preco').val(),
                    this.cat,
                    this.prod,
                    this.foto=[
                        this.selectedFile1.name,
                        this.selectedFile2.name,
                        this.selectedFile3.name,
                        this.selectedFile4.name,
                        this.selectedFile5.name,

                    ]

                ];

                console.log(this.input);

                axios.post('/eucomproonline/anuncio/novo', {
                    input: this.input

                })
                    .then(response => {
                        console.log(response);
                        this.id_anuncio = response.data;
                        console.log(this.id_anuncio);
                        localStorage.setItem('ID_ANUNCIO_PRODUTO', this.id_anuncio);
                        window.open("/eucomproonline/anuncio/produto/detalhe",'_self');
                    })
                    .catch(e => {
                        console.log('deu erro');
                    });
            }
        }
    }
</script>
