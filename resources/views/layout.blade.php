<!DOCTYPE html>
<html>
<head>
    <title></title>
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
                Alamacen
                <i class="dropdown icon"></i>
                <div class="menu" >
                    <a class="item sub" id="linkModProductos"><i class="cubes icon"></i> Modulo de Productos</a>
                    <a class="item sub"><i class="grid layout icon"></i> Almacenes</a>
                    <a class="item sub"><i class="archive icon"></i> Inventario</a>
                    <a class="item sub"><i class="newspaper icon"></i> Kardex</a>
                </div>
            </div>
            <div class="ui dropdown item pro" >
                Pedidos
                <i class="dropdown icon"></i>
                <div class="menu" >
                    <a class="item sub"><i class="file icon"></i> Requerimiento <br> de Materiales</a>
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
<script src="{{ asset('js/mods/main/main.js') }}">
</script>

</html>





<style>


    .avatar{

        position: relative;
        float: right;

    }


    .avatar img{
        cursor: pointer;
        position: relative;
        width: 60px;
        border-radius: 50%;
        margin-right: 10px;
        margin-top: 3px;
        border: 5px solid white;
        z-index: 3
    }

    .avatar i {
        background-color: white;
        position: relative;
        position: absolute;
        top: 25px;
        width: 80px;
        right: 6px;
        z-index: 1;
    }


    #avatarUser{
        position: relative;
        float: right;
    }
    #avatarUser a {
        cursor: pointer;
    }




    #container-principal{
        /*background-color: yellow;*/


    }



    div[data-styl='block-seccion']{
        /*background-color: blue;*/

        border: 20px solid rgb(255,255,255);
        border-radius: 15px;



    }
    div[data-styl='table']{
        /*background-color: blue;*/

        box-shadow: 11px 11px 13px 2px rgba(201,201,201,1);
        margin: `5px;



    }


    .fixed-header {
        position: fixed;
        top:0; left:0;
        width: 100%;
        z-index: 5;
        background-color: red;
    }

    #header{
        background-color: #20BDB7;
        color: white;
        border-bottom: 20px solid #FFFFFF;
        border-radius: 5px 5px 5px 15px;
        box-shadow: 11px 11px 13px 2px rgba(201,201,201,1);
        overflow: hidden;
        text-shadow: 2px 2px #B6B6B6;

    }



    #logotipo{
        /*background-color: green;*/
        margin: 0px;
        padding: 0px;

    }

    #logotipo img{
        width: 220px;
        padding: 0px;
        margin: 0px;
    }



    /*esto modifica el los items que son submenus*/
    #menu-left > div > div.ui.dropdown.item.pro.active.visible > div > a:hover{
        background-color: rgba(205, 90, 90, 0.71);
        color: white;
    }


    /*Esto modifica los iconos de los items del submenu */
    #menu-left > div > div.ui.dropdown.item.pro.active.visible > div > a:hover > i{
        color: #6070DB;
    }

    #menu-left{
        /*background-color: red;*/
        /* top , right, botton, lef  */

        border: 30px  solid rgba(128, 126, 126, 0.5);
        border-radius: 0px 0px 10px 0px;

        padding: 0px 0px 0px 0px;
    }
    #menu-left > div{
        box-shadow: 10px 10px 5px #;
    }




    #menuP{

        margin-bottom: 0px;
    }


    #nav-left{

        border-radius: 15px;
        box-shadow: 10px 10px 5px #888888;

    }


    .text-titulo{
        font-size: 50px;
    }


    #tableReq > thead > tr > th{

        background-color: #f43;
        color: #fff;
    }


    #tabla-mov-pro > thead > tr > th{

        background-color:  #3277BB;
        color: #fff;
    }


    .ui.inverted.menu{
        background: #3277BB;
    }

    .ui.menu .active.item:hover,
    .ui.vertical.menu .active.item:hover{

        background-color: rgba(205, 90, 90, 0.71);



    }
</style>