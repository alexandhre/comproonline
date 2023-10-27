<!DOCTYPE html>
<html lang="en">
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eu compro online</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <!-- Bulma Version 0.7.1-->
    <link rel="stylesheet" href="\eucomproonline\css\eucomproonline.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/eucomproonline.css') }}" rel="stylesheet">
</head>

<body>

<!--------------------------------------NAV BAR-------------->
<nav class="navbar" id="topo" style="background-color: #23A7FB;min-height: 80px;">
    <div class="navbar-menu" style="width: 15%;     margin-left: -5%;">
        <a class="navbar-item" href="/eucomproonline/home">
            <img src="\eucomproonline\css\img\logo_eucompro.png" alt="" style="padding-left: 180px;max-height: 40px;">
        </a>
        <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start">

            <div   class="navbar-menu">
                <busca></busca>
               
            </div>

        </div>
    </div>

    <div class="navbar-end" style="position: relative;right: 10%;">
        <div class="navbar-item">
            <div class="field">
                <div class="control" style="display: flex">

                   @if(!key_exists('email',session()->all()))
                    <div class="field">
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                <div class="control">
                                    <a class="button gradiente is-rounded" href="/eucomproonline/funcionamento" style= "background-color: #23A7FB; color: #FFFFFF;font-size: 14px">
                                        Como funciona
                                    </a>
                                    <a class="button gradiente is-rounded" onclick="showlogin()"  style= "background-color: #23A7FB; color: #FFFFFF;font-size: 14px">
                                        Iniciar Sessão
                                    </a>
                                    <a class="button is-white is-rounded" onclick="show()"  style= "color:#2764AC;font-size: 14px"> Registro
                                    </a>
                                </div>
                            </ul>
                        </div>
                    @else
                        <div class="image-wrap-perfil">
                            <a href="/eucomproonline/usuario/perfil"><img class="is-rounded" style="max-height:52PX; height: 52px; width:52px;    border-radius: 50%;" src="/eucomproonline\images\usuarios\{{session()->all()['id']}}\{{session()->all()['photo']}}" onerror="this.onerror=null;this.src='/eucomproonline/images/uploadImage.png';"></a>
                        </div>
                        <div class="dropdown is-hoverable " >
                            <div class="dropdown-trigger"  style="padding-top:20px">

                                <li class="button" aria-haspopup="true" aria-controls="dropdown-menu4" style="    background-color: rgba(255, 255, 255, 0); border-color: rgba(255, 255, 255, 0);color: #2b478a;">

                                    <span class="is-size-6" style="font-size: 14px; padding-left: 10px; color: #ffffff;">{{session()->all()['nome']}}</span>
                                    <span class="icon is-small ">
                                        <i class="fa fa-angle-down " aria-hidden="true"></i>
                                    </span>
                                </li>
                            </div>

                            <div class="dropdown-menu" id="dropdown-menu4" role="menu" style="background: #fafafa;">
                                <a href="/eucomproonline/usuario/perfil" class="dropdown-item" style="border: none">
                                    Perfil
                                </a>
                                <a class="dropdown-item"  style="border: none" href="{{ route('logout') }}">
                                    Sair
                                </a>
                                {{--<a href="{{ route('logout') }}" class="dropdown-item" style="border: none"--}}
                                   {{--onclick="event.preventDefault();--}}
                                                  {{--document.getElementById('logout-form').submit();">--}}
                                    {{--Logout--}}
                                {{--</a>--}}

                                {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                    {{--{{ csrf_field() }}--}}
                                {{--</form>--}}
                                <hr class="dropdown-divider">

                            </div>

                        </div>

                    @endguest

                </div>
            </div>
        </div>
    </div>
   
</nav>
<div id="menu">
    @if("$_SERVER[REQUEST_URI]" !== "/eucomproonline/anuncio/produto/detalhe")
    <menucategoria></menucategoria>
    
    @endif
</div>

<div id="app" style="margin-bottom: 2%; max-height: 100%; height: auto">
    <!--------------------------------------MODAL-------------->

        <div class="modal" id="modalRegistar" style="background-color: rgba(86, 86, 86, 0.46);">
            <div class="modal-card" style="height: 617px; width: 419px;background-color: #FFFFFF;">

                <section class="modal-card-body" >
                    {{--@if("$_SERVER[REQUEST_URI]" === "/eucomproonline/" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/home" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/usuario/recuperasenha")--}}
                        <button class="delete" aria-label="close" style="margin-left: 360px"></button>
                    {{--@endif--}}

                    <div class="container has-content-centered">


                        <div class="card" style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">

                            <div class="card-content">
                                <div class="content">
                                    <div class="card-image">
                                        <figure class="image">
                                            <img src="/eucomproonline/css/img/Group 3.png" style="height: 57px; width: 200px;" alt="Placeholder image">
                                        </figure>
                                    </div>
                                </div>
                                <p class="subtitle is-4 is-bold"> Seja bem vindo</p>

                                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">

                                    @csrf

                                    <div class="form-group row" style="margin: 5% 0%;">
                                        <div class="col-md-6">
                                            <div class="field" style="width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                                <div class="control has-icons-left">
                                                    <input id="name" type="text" style="box-shadow: inset 0 0px 0px #ffffff00;border-color:#ffffff00; padding-left:50px;font-size: 14px; width: 100%;" placeholder="Nome" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus >
                                                    <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                  <i class="fas fa-user"></i>
                                                </span>
                                                </div>
                                            </div>


                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin: 5% 0%;">
                                        <div class="col-md-6">
                                            <div class="field" style="width: 290px; border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                                <div class="control has-icons-left">
                                                    <input id="email" type="email" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px; width: 100%;" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                                    <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                  <i class="fas fa-envelope"></i>
                                                </span>
                                                </div>
                                            </div>


                                            @if ($errors->has('emailRegistro'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('emailRegistro') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin: 5% 0%;">
                                        <div class="col-md-6">
                                            <div class="field" style="display: flex; width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                                <div style="width: 100%">
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="password" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px; width: 100%;" type="password" placeholder="Senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                        <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                          <i class="fas fa-lock"></i>
                                                        </span>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong style="color:black">{{ $errors->first('password') }}</strong>
                                                            </span>
                                                    @endif
                                                </div>
                                                <div class="icon is-small" style="position: relative;  margin-left: -8%">
                                                    <a onclick="showpassword()"><i class="fa fa-eye-slash"  id="eyeslash"></i></a>
                                                    <a onclick="showpassword()"><i class="fa fa-eye"  id="eye" style="display: none"></i></a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group row" style="margin: 5% 0%;">
                                        <div class="col-md-6">
                                            <div class="field" style="width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                                <div class="control has-icons-left">
                                                    <input id="password-confirm" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px;color:#868C99; width: 100%;" placeholder="Confirme a senha" type="password" class="form-control" name="password_confirmation" required>
                                                    <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                      <i class="fas fa-lock"></i>
                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="control" style="font-size:12px;color:#868C99">
                                            <label class="checkbox">
                                                <input type="checkbox" required autofocus>&nbsp&nbsp&nbsp Registrando, aceito as <a style="color: #23A7FB" href="#" data-toggle="modal" data-target="#termo"><u>Termos de uso</u></a>.
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="buttons has-addons is-centered">
                                        <div class="control">
                                            <button type="submit" class="button gradiente" style="background-color: #23A7FB; color:#ffffff;font-weight: bold;width:290px; height: 52px;">Registrar</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="buttons has-addons is-centered" style="margin-top: 5%;">
                                    <div class="control">
                                        <button class="button gradiente" style="color: #23A7FB; background-color: #FFFFFF; box-shadow: 1px 1px #23A7FB, 0px 0px 0 1px #23A7FB; width:290px; height: 49px;" onclick="showlogin()">Já estou registrado</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </div >
        <div class="modal"  id="modalLogin" style="background-color: rgba(86, 86, 86, 0.46);">
            <div class="modal-card" style="height: 617px; width: 419px;background-color: #FFFFFF;">
                <section class="modal-card-body" >
                    {{--@if("$_SERVER[REQUEST_URI]" === "/eucomproonline/" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/home" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/usuario/recuperasenha")--}}
                        <button class="delete " aria-label="close" style="margin-left: 360px"></button>
                    {{--@endif--}}

                    <div class="container has-content-centered">
                        <div class="content">
                            <div class="card-image">
                                <figure class="image">
                                    <img src="/eucomproonline/css/img/Group 3.png" style="height: 57px; width: 200px;" alt="Placeholder image">
                                </figure>
                            </div>
                        </div>

                        <div class="card" style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">
                            <div class="card-content">
                                <p class="subtitle is-4 is-bold">Olá outra vez :)</p>
                                <?php
                                if(isset($validacao)){
                                    echo '<h3 style="text-align: center;">' . ' Cadastro validado com sucesso!' . '</h1>'; ;
                
                                    }
                                ?>
                                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                    @csrf

                                    <div class="form-group row" style="margin: 5% 0%;">

                                        <div class="col-md-6">
                                            <div class="field" style="width: 290px; border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                                <div class="control has-icons-left">
                                                    <input id="email" type="email" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px; width: 100%;" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                                    <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                  <i class="fas fa-envelope"></i>
                                                </span>
                                                </div>
                                            </div>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong style="color:black">{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin: 5% 0%;">

                                        <div class="col-md-6">
                                            <div class="field" style="width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                                <div style="width: 95%; display: inline-flex">
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="pass" type="password" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px; width: 100%;" placeholder="Senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                        <span class="icon is-small is-left" style="height: 27px; width: 20px; ">
                                                          <i class="fas fa-lock"></i>
                                                        </span>
                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback" role="alert" >
                                                                <strong style="color:black">{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="icon is-small" style="position: absolute; margin-left: -5%">
                                                    <a onclick="showpasswordlogin()"><i class="fa fa-eye-slash"  id="eyeslashlogin"></i></a>
                                                    <a onclick="showpasswordlogin()"><i class="fa fa-eye"  id="eyelogin" style="display: none"></i></a>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="field">
                                        @if (session('alert'))
                                            <div class="message is-warning" id="alerta">
                                                <div class="message-header" >
                                                    {{ session('alert') }}
                                                </div>

                                            </div>
                                        @endif
                                        <div class="control" style="font-size:12px;color:#868C99">
                                            <label class="checkbox">
                                                <a style="color: #23A7FB" onclick="showsenha()" >Esqueci a minha senha</a>.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                                {{--<label class="form-check-label" for="remember">--}}
                                                    {{--{{ __('Remember Me') }}--}}
                                                {{--</label>--}}
                                            </div>
                                        </div>
                                    </div>


                                    <br>
                                    <div class="buttons has-addons is-centered">
                                        <div class="control">
                                            <button type="submit" class="button gradiente" style="background-color: #23A7FB; color:#ffffff;font-weight: bold;width:290px; height: 52px;">
                                                login
                                            </button>
                                        </div>
                                    </div>

                                </form>
                                <div class="buttons has-addons is-centered" style="margin-top: 5%">
                                    <div class="control">
                                        <button class="button gradiente" style="color: #23A7FB; background-color: #FFFFFF; box-shadow: 1px 1px #23A7FB, 0px 0px 0 1px #23A7FB; width:290px; height: 49px;" onclick="show()" >Não estou registrado</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="modal"  id="modalSenha" style="background-color: rgba(86, 86, 86, 0.46);">
            <div class="modal-card" style="height: 617px; width: 419px;background-color: #FFFFFF;">

                <section class="modal-card-body" >
                    {{--@if("$_SERVER[REQUEST_URI]" === "/eucomproonline/" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/usuario/recuperasenha" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/home")--}}
                        <button class="delete" aria-label="close" style="margin-left: 360px"></button>
                    {{--@endif--}}

                    <div class="container has-content-centered">

                        <div class="card" style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">

                            <div class="card-content">
                                <div class="content">
                                    <div class="card-image">
                                        <figure class="image">
                                            <img src="http://eucompro.online/eucomproonline/css/img/Group 3.png" style="height: 57px; width: 200px;" alt="Placeholder image">
                                        </figure>
                                    </div>
                                </div>
                                <p class="subtitle is-prata is-3 has-text-centered">Recuperar a senha</p>
                                <p class="subtitle is-8 has-text-left" style="line-height: 20px;color:#525763; width: 100%;">Introduza o e-mail que você se registrou e nós enviaremos
                                    um enlace para que você possa mudar a sua senha. Não te enviaremos a senha antiga, porque nosso sistema está
                                    encriptado e não temos acesso a sua informação privada.
                                    A segurança da sua informação, em primeiro lugar!</p>

                                <form method="POST" action="{{ route('recuperasenha') }}" aria-label="{{ __('recuperasenha') }}">

                                    @csrf

                                    <div class="field" style="width: 290px; border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                        <div class="form-group{{ $errors->has('emailSenha') ? ' has-error' : '' }}">
                                            <p class="control has-icons-left">
                                                <input class="input" type="email" id="email" placeholder="Email" name="email"
                                                       value="{{ old('email') }}" required style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px;">
                                                <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                @if ($errors->has('emailSenha'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('emailSenha') }}</strong>
                                                    </span>
                                                @endif
                                            </p>
                                        </div>

                                    </div>
                                    <div class="notification" style="display: {{(isset($senha)) && "$_SERVER[REQUEST_URI]" === "/eucomproonline/usuario/recuperasenha" ?"block":"none" }}; width:100%; padding: 0px; background-color: #00ff5500; color: #000;">
                                        <span id="texto">Uma nova senha foi enviada ao seu email</span>
                                    </div>

                                    <div class="buttons has-addons is-centered">
                                        <div class="control">
                                            <button  type="submit" class="button" style="color: #FFFFFF; background-color:#23A7FB; border-color:#23A7FB; font-weight: bold;width:290px; height: 52px;">Recuperar senha</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="buttons has-addons is-centered" style="margin-top: 5%;">
                                    <div class="control">
                                        <button class="button gradiente" style="color: #23A7FB; background-color: #FFFFFF; box-shadow: 1px 1px #23A7FB, 0px 0px 0 1px #23A7FB; width:290px; height: 49px;" onclick="showlogin()">Já estou registrado</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


<!--------------------------------------HEROOOOOOO-------------->
   
   


@yield('content')

</div>


<!--------------------------------------FOOTER--------------->
<footer class="footer" style="width: 100%;text-align: center; position:fixed ; bottom:0; background: linear-gradient(#ffffff00, #00000000);">
    {{--<div class="card" style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, #00000000 100%);">--}}
        {{--<div class="card-content">--}}
            {{--<div class="media">--}}


            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <a href="#topo" class="button is-small is-rounded" style="position: absolute;
    left: 2%;
    bottom: 55%;
    color: #2764AC;
    height: 48px;
    width: 48px;
    border-color: #FFFFFF;
    background-color: #FFFFFF;">
        <span><img src="/eucomproonline/css/img/file_upload - material.png" style="margin-bottom: 12px;  margin-left:15px" alt="retorno"></span>
        <p style="margin-top: 15px; font-size: 10px; font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, 'sans-serif'; position: relative; left: -7px">subir</p>
    </a>
    <nav class="" style="display:flex; background: #2764AC; height: 50px; box-shadow: -2px -9px 18px 12px #d3d4d4c7;">

        <!-- Left side -->
        <div class="level-left" style="padding-left: 180px">
        <div class="level-item"> <!-- data-toggle="modal" data-target="#politica" -->
                <a class="has-text-white" style="font-size: 14px" href="politica_privacidade.pdf" target="_blank" >
                    POLÍTICAS DE PRIVACIDADE
                </a>
            </div>
            <div class="level-item"> <!-- data-toggle="modal" data-target="#cookie" -->
                <a class="has-text-white" style="font-size: 14px" href="cookies.pdf" target="_blank" >
                    POLÍTICAS DE COOKIES
                </a>
            </div>
            <div class="level-item"> <!-- data-toggle="modal" data-target="#aviso" -->
                <a class="has-text-white" style="font-size: 14px" href="aviso_legal.pdf" target="_blank" >
                    AVISO LEGAL
                </a>
            </div>
        </div>

        <!-- Right side -->
        <div class="level-right" style="padding-left: 30%">
    <span class="icon is-medium">
   						 <i class="far fa-envelope"></i>
					</span>
            <a class="has-text-white" style="font-size: 14px" href="mailto: eucompronline2019@gmail.com">
                CONTATO
            </a>
        </div>
    </nav>

</footer>
<!-- Modal -->
<div class="modal"  id="politica" tabindex="-1" role="dialog" aria-labelledby="politica" aria-hidden="true" style="background-color: rgba(86, 86, 86, 0.46);">
    <div class="modal-card" style="height: 617px; width: 419px;background-color: #FFFFFF;">

        <section class="modal-card-body" >
            {{--@if("$_SERVER[REQUEST_URI]" === "/eucomproonline/" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/usuario/recuperasenha" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/home")--}}
            {{--<button class="delete" aria-label="close" style="margin-left: 360px"></button>--}}
            {{--@endif--}}
            <header class="rectangle-10" style=" width: 100%; display:flex">
                <h5 style="margin-left: auto"> POLÍTICAS DE PRIVACIDADE</h5>
                <button class="close" onclick="closemodal(1)" id="close" data-dismiss="modal" aria-label="Close" style="margin-top: -2%;
    float: right;
    background: #d6dce400;
    border: transparent;
    align-items: end;
    margin-left: auto;"><i class="fa fa-times fa-1x" style="color: #808080;"></i></button>

            </header>
            <hr style="margin: 0px;" />
            <div>
                <div style="display: flex">
                    <div style="margin: 1%">
                        <p class="subtitle ">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse molestie orci sed rutrum tempor. Aliquam aliquet auctor lectus, non lobortis libero bibendum id. Suspendisse et egestas libero. Nullam sapien eros, viverra eget nunc sit amet, mollis bibendum nibh. Nullam ornare turpis purus, ac ultricies justo pulvinar a. Sed tristique volutpat tincidunt. Aenean mauris ante, efficitur ut risus eget, rhoncus commodo orci. Fusce ut nunc sit amet justo hendrerit fermentum. Etiam non accumsan purus. Phasellus pulvinar nunc consectetur justo scelerisque, ac mollis ipsum pulvinar. Donec turpis enim, varius id nulla ac, lobortis venenatis odio
                            <br/>
                            Morbi nec nisi sapien. Pellentesque condimentum neque vel neque faucibus, ut faucibus sem fermentum. Integer bibendum leo urna, vitae ornare dolor dictum volutpat. Nullam sed ipsum felis. Vivamus sed tincidunt ipsum. Donec id sapien felis. Sed tempor lacus felis, id tempor quam viverra id. Suspendisse lobortis nisi dolor, in aliquet odio semper vehicula.
                            <br/>
                            Phasellus ac enim maximus neque facilisis maximus. Cras sit amet mauris tristique lorem sodales egestas eu molestie leo. Pellentesque iaculis nibh id nibh volutpat suscipit. Cras et accumsan nibh. Fusce erat est, auctor sit amet mattis sed, consequat eu velit. Ut dictum pellentesque imperdiet. In sit amet lectus in ipsum tempus pellentesque. Morbi nulla turpis, pretium convallis mi ut, ultrices malesuada tortor. Vivamus ac accumsan augue. In ut fringilla dui. Nunc nec enim justo. Curabitur suscipit ante erat, et consectetur augue porta pretium. Proin egestas porta mi, ac eleifend sapien. Quisque viverra ac eros id vulputate.
                        </p>
                    </div>

                </div>
            </div>
            <hr style="margin: 0px;" />

        </section>
    </div>
</div>
<div class="modal"  id="cookie" tabindex="-1" role="dialog" aria-labelledby="politica" aria-hidden="true" style="background-color: rgba(86, 86, 86, 0.46);">
    <div class="modal-card" style="height: 617px; width: 419px;background-color: #FFFFFF;">

        <section class="modal-card-body" >
            {{--@if("$_SERVER[REQUEST_URI]" === "/eucomproonline/" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/usuario/recuperasenha" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/home")--}}
            {{--<button class="delete" aria-label="close" style="margin-left: 360px"></button>--}}
            {{--@endif--}}
            <header class="rectangle-10" style=" width: 100%; display:flex">
                <h5 style="margin-left: auto"> POLÍTICAS DE COOCKIES</h5>
                <button class="close" onclick="closemodal(1)" id="close" data-dismiss="modal" aria-label="Close" style="margin-top: -2%;
    float: right;
    background: #d6dce400;
    border: transparent;
    align-items: end;
    margin-left: auto;"><i class="fa fa-times fa-1x" style="color: #808080;"></i></button>

            </header>
            <hr style="margin: 0px;" />
            <div>
                <div style="display: flex">
                    <div style="margin: 1%">
                        <p class="subtitle ">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse molestie orci sed rutrum tempor. Aliquam aliquet auctor lectus, non lobortis libero bibendum id. Suspendisse et egestas libero. Nullam sapien eros, viverra eget nunc sit amet, mollis bibendum nibh. Nullam ornare turpis purus, ac ultricies justo pulvinar a. Sed tristique volutpat tincidunt. Aenean mauris ante, efficitur ut risus eget, rhoncus commodo orci. Fusce ut nunc sit amet justo hendrerit fermentum. Etiam non accumsan purus. Phasellus pulvinar nunc consectetur justo scelerisque, ac mollis ipsum pulvinar. Donec turpis enim, varius id nulla ac, lobortis venenatis odio
                            <br/>
                            Morbi nec nisi sapien. Pellentesque condimentum neque vel neque faucibus, ut faucibus sem fermentum. Integer bibendum leo urna, vitae ornare dolor dictum volutpat. Nullam sed ipsum felis. Vivamus sed tincidunt ipsum. Donec id sapien felis. Sed tempor lacus felis, id tempor quam viverra id. Suspendisse lobortis nisi dolor, in aliquet odio semper vehicula.
                            <br/>
                            Phasellus ac enim maximus neque facilisis maximus. Cras sit amet mauris tristique lorem sodales egestas eu molestie leo. Pellentesque iaculis nibh id nibh volutpat suscipit. Cras et accumsan nibh. Fusce erat est, auctor sit amet mattis sed, consequat eu velit. Ut dictum pellentesque imperdiet. In sit amet lectus in ipsum tempus pellentesque. Morbi nulla turpis, pretium convallis mi ut, ultrices malesuada tortor. Vivamus ac accumsan augue. In ut fringilla dui. Nunc nec enim justo. Curabitur suscipit ante erat, et consectetur augue porta pretium. Proin egestas porta mi, ac eleifend sapien. Quisque viverra ac eros id vulputate.
                        </p>
                    </div>

                </div>
            </div>
            <hr style="margin: 0px;" />

        </section>
    </div>
</div>
<div class="modal"  id="aviso" tabindex="-1" role="dialog" aria-labelledby="politica" aria-hidden="true" style="background-color: rgba(86, 86, 86, 0.46);">
    <div class="modal-card" style="height: 617px; width: 419px;background-color: #FFFFFF;">

        <section class="modal-card-body" >
            {{--@if("$_SERVER[REQUEST_URI]" === "/eucomproonline/" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/usuario/recuperasenha" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/home")--}}
            {{--<button class="delete" aria-label="close" style="margin-left: 360px"></button>--}}
            {{--@endif--}}
            <header class="rectangle-10" style=" width: 100%; display:flex">
                <h5 style="margin-left: auto"> AVISO LEGAL</h5>
                <button class="close" onclick="closemodal(1)" id="close" data-dismiss="modal" aria-label="Close" style="margin-top: -2%;
    float: right;
    background: #d6dce400;
    border: transparent;
    align-items: end;
    margin-left: auto;"><i class="fa fa-times fa-1x" style="color: #808080;"></i></button>

            </header>
            <hr style="margin: 0px;" />
            <div>
                <div style="display: flex">
                    <div style="margin: 1%">
                        <p class="subtitle ">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse molestie orci sed rutrum tempor. Aliquam aliquet auctor lectus, non lobortis libero bibendum id. Suspendisse et egestas libero. Nullam sapien eros, viverra eget nunc sit amet, mollis bibendum nibh. Nullam ornare turpis purus, ac ultricies justo pulvinar a. Sed tristique volutpat tincidunt. Aenean mauris ante, efficitur ut risus eget, rhoncus commodo orci. Fusce ut nunc sit amet justo hendrerit fermentum. Etiam non accumsan purus. Phasellus pulvinar nunc consectetur justo scelerisque, ac mollis ipsum pulvinar. Donec turpis enim, varius id nulla ac, lobortis venenatis odio
                            <br/>
                            Morbi nec nisi sapien. Pellentesque condimentum neque vel neque faucibus, ut faucibus sem fermentum. Integer bibendum leo urna, vitae ornare dolor dictum volutpat. Nullam sed ipsum felis. Vivamus sed tincidunt ipsum. Donec id sapien felis. Sed tempor lacus felis, id tempor quam viverra id. Suspendisse lobortis nisi dolor, in aliquet odio semper vehicula.
                            <br/>
                            Phasellus ac enim maximus neque facilisis maximus. Cras sit amet mauris tristique lorem sodales egestas eu molestie leo. Pellentesque iaculis nibh id nibh volutpat suscipit. Cras et accumsan nibh. Fusce erat est, auctor sit amet mattis sed, consequat eu velit. Ut dictum pellentesque imperdiet. In sit amet lectus in ipsum tempus pellentesque. Morbi nulla turpis, pretium convallis mi ut, ultrices malesuada tortor. Vivamus ac accumsan augue. In ut fringilla dui. Nunc nec enim justo. Curabitur suscipit ante erat, et consectetur augue porta pretium. Proin egestas porta mi, ac eleifend sapien. Quisque viverra ac eros id vulputate.
                        </p>
                    </div>

                </div>
            </div>
            <hr style="margin: 0px;" />

        </section>
    </div>
</div>
<div class="modal"  id="termo" tabindex="-1" role="dialog" aria-labelledby="politica" aria-hidden="true" style="background-color: rgba(86, 86, 86, 0.46);">
    <div class="modal-card" style="height: 617px; width: 419px;background-color: #FFFFFF;">

        <section class="modal-card-body" >
            {{--@if("$_SERVER[REQUEST_URI]" === "/eucomproonline/" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/usuario/recuperasenha" || "$_SERVER[REQUEST_URI]" === "/eucomproonline/home")--}}
            {{--<button class="delete" aria-label="close" style="margin-left: 360px"></button>--}}
            {{--@endif--}}
            <header class="rectangle-10" style=" width: 100%; display:flex">
                <h5 style="margin-left: auto"> TERMO DE USO</h5>
                <button class="close" onclick="closemodal(1)" id="close" data-dismiss="modal" aria-label="Close" style="margin-top: -2%;
    float: right;
    background: #d6dce400;
    border: transparent;
    align-items: end;
    margin-left: auto;"><i class="fa fa-times fa-1x" style="color: #808080;"></i></button>

            </header>
            <hr style="margin: 0px;" />
            <div>
                <div style="display: flex">
                    <div style="margin: 1%">
                        <p class="subtitle ">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse molestie orci sed rutrum tempor. Aliquam aliquet auctor lectus, non lobortis libero bibendum id. Suspendisse et egestas libero. Nullam sapien eros, viverra eget nunc sit amet, mollis bibendum nibh. Nullam ornare turpis purus, ac ultricies justo pulvinar a. Sed tristique volutpat tincidunt. Aenean mauris ante, efficitur ut risus eget, rhoncus commodo orci. Fusce ut nunc sit amet justo hendrerit fermentum. Etiam non accumsan purus. Phasellus pulvinar nunc consectetur justo scelerisque, ac mollis ipsum pulvinar. Donec turpis enim, varius id nulla ac, lobortis venenatis odio
                            <br/>
                            Morbi nec nisi sapien. Pellentesque condimentum neque vel neque faucibus, ut faucibus sem fermentum. Integer bibendum leo urna, vitae ornare dolor dictum volutpat. Nullam sed ipsum felis. Vivamus sed tincidunt ipsum. Donec id sapien felis. Sed tempor lacus felis, id tempor quam viverra id. Suspendisse lobortis nisi dolor, in aliquet odio semper vehicula.
                            <br/>
                            Phasellus ac enim maximus neque facilisis maximus. Cras sit amet mauris tristique lorem sodales egestas eu molestie leo. Pellentesque iaculis nibh id nibh volutpat suscipit. Cras et accumsan nibh. Fusce erat est, auctor sit amet mattis sed, consequat eu velit. Ut dictum pellentesque imperdiet. In sit amet lectus in ipsum tempus pellentesque. Morbi nulla turpis, pretium convallis mi ut, ultrices malesuada tortor. Vivamus ac accumsan augue. In ut fringilla dui. Nunc nec enim justo. Curabitur suscipit ante erat, et consectetur augue porta pretium. Proin egestas porta mi, ac eleifend sapien. Quisque viverra ac eros id vulputate.
                        </p>
                    </div>

                </div>
            </div>
            <hr style="margin: 0px;" />

        </section>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    window.onload = function(){

        @if ($show === 1 || $errors->has('email'))
            $("#modalLogin").addClass("is-active");
            $(".delete").click(function() {
                $(".modal").removeClass("is-active");
            });
            $("#modalRegistar").removeClass("is-active");
            $("#modalSenha").removeClass("is-active");
        @elseif($show === 2)
            $("#modalRegistar").addClass("is-active");
            $(".delete").click(function() {
                $(".modal").removeClass("is-active");
            });
            $("#modalRegistar").removeClass("is-active");
            $("#modalLogin").removeClass("is-active");
        @elseif($show === 3)
            $("#modalSenha").addClass("is-active");
            $(".delete").click(function() {
                $(".modal").removeClass("is-active");
            });
            $("#modalLogin").removeClass("is-active");
            $("#modalRegistar").removeClass("is-active");
        @endif
    }

    function show() {
        $("#modalRegistar").addClass("is-active");
        $(".delete").click(function() {
            $(".modal").removeClass("is-active");
        });
        $("#modalLogin").removeClass("is-active");
        $("#modalSenha").removeClass("is-active");

    }
    function showlogin() {
        $("#modalLogin").addClass("is-active");
        $(".delete").click(function() {
            $(".modal").removeClass("is-active");
        });
        $("#modalRegistar").removeClass("is-active");
        $("#modalSenha").removeClass("is-active");

    }
    function showsenha() {
        $senha = null;
        $("#modalSenha").addClass("is-active");
        $(".delete").click(function() {
            $(".modal").removeClass("is-active");
        });
        $("#modalLogin").removeClass("is-active");

    }

    function showpassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            $("#eyeslash").css('display','none');
            $("#eye").css('display','block');
            x.type = "text";
        } else {
            $("#eyeslash").css('display','block');
            $("#eye").css('display','none');
            x.type = "password";
        }
    }
    function showpasswordlogin() {
        var x = document.getElementById("pass");
        console.log("ASDASDASDASD");
        if (x.type === "password") {
            $("#eyeslashlogin").css('display','none');
            $("#eyelogin").css('display','block');
            x.type = "text";
        } else {
            $("#eyeslashlogin").css('display','block');
            $("#eyelogin").css('display','none');
            x.type = "password";
        }
    }
    function myFunction() {
        alert($("#pass").type);
        if ($("#pass").type === "password") {

            $("#pass").removeAttr("type");
            $('#pass').prop('type', 'text');
        } else {

            $('#pass').removeAttr("type");
            $('#pass').prop('type', 'text');
        }
    }
    function closemodal(id){
        $("#politica").click(function() {
            $(".modal").removeClass("is-active");
        });
    }
</script>