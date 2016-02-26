<!DOCTYPE html>
<html lang="es"  >
<head>
    <title></title>

    <!-- CSS Bootstrap UI -->
    <!--<link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}"/>-->
    
    <!--CSS FontAwesome 4.0-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <!-- CSS Semantic -->
    <link rel="stylesheet" href="{{ asset('js/dist/semantic.min.css') }}">
    <!-- JQuery-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
    <!--para reportes morris-->
    <link rel="stylesheet" href="{{ asset('js/morris/morris.css') }}">
    <script src="{{ asset('js/morris/raphael-min.js') }}">
    </script>
    <script src="{{ asset('js/morris/morris.min.js') }}">
    </script>


    <!-- JS Semantic -->
    <script src="{{ asset('js/dist/semantic.js') }}"></script>

    <!-- My Style-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">



</head>
<body>
<nav class="ui inverted menu" id="menuP">
    <button class="item" id="btnHideShow" value="1" >
        <i class="unordered list icon"></i>
    </button>
    <a class="active item">
        <i class="home icon"></i> SYMI SRL
    </a>
    <a class="item">
        <i class="mail icon"></i> Messages
    </a>
    <a class="item">
        <i class="user icon"></i> Friends
    </a>
  <span id="avatarUser">
  	<a class="item" >
        <i class="user icon"></i> a
    </a>
  	<a class="item">
        <i class="user icon"></i> b
    </a>

  </span>

</nav>


<div class="ui grid" style="margin:0px;padding:0px;" >
    <div class="three wide column " id="menu-left">
        <div class="ui vertical menu" id="nav-left">
            <a class="item" id="logotipo">
                <img src="{{ asset('img/logo.jpg')}}" alt="">
            </a>

            <a class="active teal item">
                Inicio
                <div class="ui teal label">></div>
            </a>
            <div class="ui dropdown item pro" >
                Personal
                <i class="dropdown icon"></i>
                <div class="menu" >
                    <a href="{{route('personal')}}" class="item sub"><i class="grid layout icon"></i> Módulo Personal</a>
                    <a href="{{route('viewProfesiones','&')}}" class="item sub"><i class="grid layout icon"></i> Módulo Profesion</a>
                    <a href="{{route('viewAreas','&')}}" class="item sub"><i class="grid layout icon"></i> Módulo Area</a>
                </div>
            </div>
            <div class="ui dropdown item pro" >
                Proforma
                <i class="dropdown icon"></i>
                <div class="menu" >
                    <a href="{{route('viewProformas','1')}}" class="item sub"><i class="file icon"></i> Modulo Proforma</a>
                    <a href="{{route('viewTareo')}}" class="item sub"><i class="file icon"></i> Modulo Tareo</a>
                </div>
            </div>
            <div class="ui dropdown item pro" >
                Compras
                <i class="dropdown icon"></i>
                <div class="menu" >
                    <a class="item sub"><i class="users icon"></i> Gestion de <br>Proveedores</a>
                    <a class="item sub"><i class="file text outline icon"></i> Cotizaciones</a>
                    <a class="item sub"><i class="money icon"></i> Compras</a>
                    <a class="item sub"><i class="payment icon"></i> Notas de Credito</a>
                </div>
            </div>
            <div class="ui dropdown item pro" >
                EPP
                <i class="dropdown icon"></i>
                <div class="menu" >
                    <a class="item sub"><i class="edit icon"></i> Entregas </a>
                </div>
            </div>

            <div class="ui dropdown item pro" >
                Transporte Materiales
                <i class="dropdown icon"></i>
                <div class="menu" >
                    <a class="item sub"><i class="edit icon"></i> Guias</a>
                </div>
            </div>


        </div>


    </div>



    <div class="thirteen wide column" id="container-principal">


        <!--Aca empieza el container dinamico-->

        @yield('content')

        <!--Aca termina-->


    </div>



    <!--para prueba Menu-->
    <!--
    <div class="ui secondary vertical menu">
      <a class="active item">
        <i class="users icon"></i>
        Friends
      </a>
      <a class="item">
        <i class="mail icon"></i> Messages
      </a>
      <a class="item">
        <i class="user icon"></i> Friends
      </a>
      <div class="ui dropdown item " id="pro">
        More
        <i class="dropdown icon"></i>
        <div class="menu" >
          <a class="item sub"><i class="edit icon"></i> Edit Profile</a>
          <a class="item sub"><i class="globe icon"></i> Choose Language</a>
          <a class="item sub"><i class="settings icon"></i> Account Settings</a>
        </div>
      </div>
    </div>
    -->
    <!--prueba
    <div class="ui left pointing dropdown icon button">
        <i class="settings icon"></i>
        <div class="menu">
          <div class="ui transparent left icon input">
            <i class="search icon"></i>
            <input type="text" name="search" placeholder="Search issues...">
          </div>
          <div class="divider"></div>
          <div class="header">
            <i class="tags icon"></i>
            Filter by tag
          </div>
          <div class="item">
            <div class="ui red empty circular label"></div>
            Important
          </div>
          <div class="item">
            <div class="ui blue empty circular label"></div>
            Announcement
          </div>
          <div class="item">
            <div class="ui black empty circular label"></div>
            Discussion
          </div>
        </div>
      </div>-->





</div>





</body>

<!--Importacion de mod-->
<script src="{{ asset('js/mods/main/main.js') }}"></script>
<!--Global functions JS-->
<script src="{{ asset('js/global.js') }}"></script>

</html>





<style>


    
</style>