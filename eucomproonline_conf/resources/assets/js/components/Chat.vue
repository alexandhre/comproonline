<template>
    <!--------------------------------------FILTRO--------------->
    <section class="section">

        <div class="container has-text-centered">
            <div class="columns">

                <usuario-menu></usuario-menu>

                <!-- Chat Pessoa-->


                <div class="column is-4 is-paddingless list-pessoas" style="background:#F5F6F7; height:100vh; overflow-y: auto;"  v-if="this.itensList[0].menssagem !== 'sem conversa' ||  this.id !== null">
                    <div class="card-content" style="padding: 5%">
                        <article class="media" style="border-top: 0px; background-color: rgb(233, 234, 239); cursor: pointer; padding-top: 0rem;" v-for="(item, index) in list" v-on:click="showMessage(item.colletctionId, item.nome, item.usuarioId, item.foto, index, item.avaliacao)">
                            <div class="media" style="border-top: 1px solid rgba(255, 255, 255, 0); width: 100%;"
                                 v-bind:style=" (item.usuarioId === ''+sender) ? 'border-bottom: 1px solid #0092F6;' : 'border: none;' ">
                                <div class="media-left">
                                    <a class="image"><img class="is-rounded" style="position:relative;top:10px;left:10px; height: 55px; width:55px" :src="item.foto" onerror="this.onerror=null;this.src='/eucomproonline/images/uploadImage.png';"> </a>
                                    <br>
                                </div>
                                <div class="media-content" style="margin-top: 15px; margin-left: 3%;">
                                    <div class="content" style="display: flex">
                                      
                                        <p style="max-height: 57px;max-width: 100%;overflow-y: hidden; width:100%">
                                            <strong class="subtitle is-5 is-danger" style="color: #2764AC">{{item.nome}} </strong>
                                             <small class="subtitle is-8" style="margin-left: 15%;">{{item.dataMensagem}}</small>
                                            <br>
                                            <strong class="subtitle is-7">{{item.mensagem}}</strong>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="column"  v-if="this.id">
                    <div class="card" style="width: 540px;border-radius: 5px;box-shadow: 0 1px 0 rgba(10, 10, 10, 0.1), 0 0 1px 1px rgba(10, 10, 10, 0.1)">
                        <div class="card-content">
                            <div class="media"  style="border-top: 1px solid rgba(255, 255, 255, 0);">
                                <div class="media-left">
                                    <a class="image">
                                        <!--<img class="is-rounded" style="position:relative;top:10px;max-height:72PX; height: 72px; width:72px" :src="foto"  onerror="this.onerror=null;this.src='/clubeatacado/images/uploadImage.png';"/>-->
                                        <img class="is-rounded" style="position:relative;top:10px;max-height:72PX; height: 72px; width:72px" :src="foto" onerror="this.onerror=null;this.src='/eucomproonline/images/uploadImage.png';">
                                    </a>
                                    <br>
                                </div>
                                <div class="media-right">
                                    <h4 class="subtitle is-6 is-bold" style="position:relative;top:15px;" id="nomeanunciante"></h4>
                                    <!--<p class="subtitle is-6 is-bold" style="position:relative;top:15px;">{{list[0].nome}}</p>-->
                                    <figure style="bottom:85px;right: 100px">
                                        <star-rating :rating="this.avaliacao"
                                                     :show-rating="false"
                                                     :read-only="true"
                                                     v-bind:increment="1"
                                                     v-bind:max-rating="5"
                                                     v-bind:star-size="20">
                                        </star-rating>
                                    </figure>
                                </div>
                                <div class="dropdown is-hoverable" style="position: relative; left: 250px;top: 30px">
                                    <div class="dropdown-trigger">
                                        <button class="button gradiente" aria-haspopup="true" aria-controls="dropdown-menu">
                                              <span class="icon is-small">
                                                <i class="fas fa-bars" aria-hidden="true"></i>
                                              </span>
                                        </button>
                                    </div>
                                    <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                        <div class="dropdown-content" style="margin-left: -80px;width: 67%;">
                                            <a href="#" class="dropdown-item" v-on:click="removeMessage">
                                                Apagar conversa
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Conversa -->
                    <section id="main " class="card" style="width: 100%; margin-top: 2%; margin-bottom: 2%; border-radius: 5px;box-shadow: 0 1px 0 rgba(10, 10, 10, 0.1), 0 0 1px 1px rgba(10, 10, 10, 0.1); ">
                        <section id="messages" v-chat-scroll>

                            <div v-for="message in messages">
                                <article v-if="message.usuarioLogin!==message.senderId">
                                    <div class="msg">
                                        <div class="tri" style="transform: rotateX(0deg);"></div>
                                        <div class="msg_inner" style="word-wrap: break-word;max-width: 350px;">{{message.content}}</div>
                                    </div>
                                </article>
                                <article class="right"  v-if="message.usuarioLogin===message.senderId">
                                    <div class="msg">
                                        <div class="tri" style="height: 100%"></div>
                                        <div class="msg_inner green" style="word-wrap: break-word;max-width: 350px;">{{message.content}}</div>
                                    </div>
                                </article>
                            </div>
                        </section>
                    </section>
                    <div class="send-msg">
                        <textarea placeholder="Digite aqui..." v-model="newMessage"></textarea>
                        <a class="btnSend  " v-on:click="addMessage">
                                <span class="icon">
                                    <i class="far fa-paper-plane fa-3x" style="margin-top: 40%; margin-right: 10%;" aria-hidden="true"></i>
                                </span>
                        </a>
                    </div>

                </div >


                <div class="columns is-centered" style="margin-top: 13%; margin-bottom: 6%" v-else>
                    <div class="column" style="text-align:center">

                        <h2>Você nao possui nenhum chat</h2>

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
    // Your web app's Firebase configuration

    import Firebase from 'firebase'

    var config = {
        apiKey: "AIzaSyAn0DeZ8vcSxHjzxWKFl862vGrkvBgn0Bw",
        authDomain: "eucompronline-fa251.firebaseapp.com",
        databaseURL: "https://eucompronline-fa251.firebaseio.com",
        projectId: "eucompronline-fa251",
        storageBucket: "eucompronline-fa251.appspot.com",
        messagingSenderId: "1016597419649",
        // appId: "1:1016597419649:web:d80035efd9331c37bc5f80",
        // measurementId: "G-MX30KPSFRX"
    };

    let app = Firebase.initializeApp(config);
    let db = app.database();
    let msgRef = db.ref('message');

    export default {
        name: 'NewMessage',
        props: ['list'],

        data() {
            return {
                newMessage: null,
                itensList: '',
                feedback: null,
                userReceiverId: '',
                newChat: {},
                messages: [],
                name: '',
                child: '',
                idSender: 0,
                foto:'',
                sender: 0,
                id_user:0,
                idAnuncio: 0,
                urlpath: window.location.pathname,
                avaliacao:0
            }
        },

        mounted(){
            this.itensList = this.list;
          
            this.usuarioLogin = this.itensList[0].usuarioLogin;
            this.id = localStorage.getItem('ID_ANUNCIANTE');

            axios.get('/eucomproonline/usuario/chat/' + this.id).then(res => {
               //     console.log(res.data[0].foto);
                    $('#nomeanunciante').text(res.data[0].nome);
                    $("#imagemanunciante").attr('src', res.data[0].foto);
                    this.id_user = res.data[0].id_user;
                    this.foto = '/eucomproonline/images/usuarios/'+this.id+'/'+res.data[0].foto;
                    this.avaliacao = res.data[0].avaliacao[0].avaliacao;
                    this.avaliacao = res.data[0].VL_AVALIACAO_ANUNCIANTE;
                    // //id="imagemanunciante"
                });

                console.log();
                if (parseInt(this.itensList[0].usuarioLogin) < parseInt(this.id)) {
                    this.child = this.itensList[0].usuarioLogin + "_" + this.id;
                   
                } else {
                    this.child = this.id + "_" + this.itensList[0].usuarioLogin;
                    
                }
               
                msgRef.child(this.child).on('child_added', (data) => {
          //          console.log(data.val());
                    this.messages.push({
                        content: data.val().chatMessage,
                        senderId: data.val().senderId,
                        chatId: data.val().chatId,
                        receiverId: data.val().receiverId,
                        usuarioLogin: this.usuarioLogin
                    });

                    if(data.val().senderId === this.usuarioLogin ){
                        this.sender =   data.val().receiverId;
              //          console.log(this.messages);
                    }else{
                        this.sender =  data.val().senderId;
             //           console.log(this.sender);
                    }
             //       console.log(this.messages);
             //       console.log(this.messages['0'].usuarioLogin !== this.messages['0'].senderId);

                });
            //}

        },
        methods: {

            addMessage() {
                this.newChat = {};
                //console.log(this.itensList[0]);
                //console.log(this.newMessage);
                if (this.newMessage) {

                    this.id = localStorage.getItem('ID_ANUNCIANTE');
                    this.idAnuncio = localStorage.getItem('ID_ANUNCIO_PRODUTO');

                    if(localStorage.getItem('COLATION') !== null){
                        this.itensList[0].colletctionId = localStorage.getItem('COLATION');
                    }
                    // var index = 0;
                    // if(localStorage.getItem('index') !== null){
                    //      index = localStorage.getItem('index');
                    // }
                    // this.itensList[index].mensagem = this.newMessage;
                    // this.itensList[index].dataMensagem = "agora";
                
                
                    if (this.id === null) {
                        

                        this.newChat = {
                            senderId: this.itensList[0].usuarioLogin,
                            chatId: this.itensList[0].colletctionId,
                            chatMessage: this.newMessage,
                            timestamp: Firebase.database.ServerValue.TIMESTAMP,
                            receiverId: this.id

                        };
                        let ref = msgRef.child(this.itensList[0].colletctionId);
                        ref.push(this.newChat);
                        this.newMessage = null;
                        this.feedback = null;

                    } else {
                        if (parseInt(this.itensList[0].usuarioLogin) < parseInt(this.id)) {
                            this.child = this.itensList[0].usuarioLogin + "_" + this.id;
                            

                        } else {
                            this.child = this.id + "_" + this.itensList[0].usuarioLogin;
                        
                        }
                        console.log(this.child);
                        this.input = [
                            this.itensList[0].usuarioLogin,
                            this.id,
                            this.child,
                            this.idAnuncio
                        ];

                        axios.post('/eucomproonline/usuario/chat/novo', {
                            input: this.input

                        })
                            .then(response => {
                            
                            })
                            .catch(e => {
                                console.log('deu erro');
                            });


                        this.newChat = {
                            senderId: this.itensList[0].usuarioLogin,
                            chatId: this.child,
                            chatMessage: this.newMessage,
                            timestamp: Firebase.database.ServerValue.TIMESTAMP,
                            receiverId: this.id

                        };
                        let ref = msgRef.child(this.child);
                        ref.push(this.newChat);
                        this.newMessage = null;
                        this.feedback = null;
                    }
                    axios.post('/eucomproonline/usuario/chat/notification', {
                        input:  this.newChat

                    })
                        .then(response => {
                            
                        })
                        .catch(e => {
                            console.log('deu erro');
                        });

                } else {
                    this.feedback = "Escreva uma mensagem"

                }
            },
            showMessage(colletctionId, nome, usuarioId, foto, index, avaliacao) {
                localStorage.setItem('ID_ANUNCIANTE', usuarioId);
                localStorage.setItem('COLATION',colletctionId);
                localStorage.setItem('index',index);
                this.id = usuarioId;
                this.messages = [];
                this.avaliacao = avaliacao['0'].avaliacao;
               
                msgRef.child(colletctionId).off();

                msgRef.child(colletctionId).on('child_added', (data) => {
                    
                    this.messages.push({
                        content: data.val().chatMessage,
                        senderId: data.val().senderId,
                        chatId: data.val().chatId,
                        receiverId: data.val().receiverId,
                        usuarioLogin: this.usuarioLogin
                    });
                    if(data.val().senderId === this.usuarioLogin ){
                        this.sender =   data.val().receiverId;
                        
                    }else{
                        this.sender =  data.val().senderId;
                    }
                    $('#nomeanunciante').text(nome);
                    $("#imagemanunciante").attr('src', data.val().foto);
                    this.foto =foto;
                    
                });

            },
            removeMessage(){
                axios.post('/eucomproonline/usuario/chat/delete', {
                    input: this.child

                }).then(res => {
                    if(res.data !== 0 ){
                        localStorage.setItem('ID_ANUNCIANTE', null);
                        localStorage.setItem('ID_ANUNCIO_PRODUTO', null);
                        window.open(this.urlpath,'_self')
                    }


                });
            }
        },
    }
</script>
