<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Symi SRL</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset('css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
    <!-- jQuery 2.0.2 -->
    <script src="{{ asset('js/jquery-2.0.2.min.js')}}"></script>

    <!--Angular JS 1.2.19 -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.js"></script>

    <!--Main JS del sistema -->
    <script src="{{ asset('js/main.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="../../index.html" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        SYMI SRL
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('img/avatar3.png') }}" class="img-circle" alt="User Image"/>
                                        </div>
                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li><!-- end message -->
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="user image"/>
                                        </div>
                                        <h4>
                                            AdminLTE Design Team
                                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('img/avatar.png') }}" class="img-circle" alt="user image"/>
                                        </div>
                                        <h4>
                                            Developers
                                            <small><i class="fa fa-clock-o"></i> Today</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="user image"/>
                                        </div>
                                        <h4>
                                            Sales Department
                                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('img/avatar.png') }}" class="img-circle" alt="user image"/>
                                        </div>
                                        <h4>
                                            Reviewers
                                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-warning"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users warning"></i> 5 new members joined
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ion ion-ios7-cart success"></i> 25 sales made
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="ion ion-ios7-person danger"></i> You changed your username
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tasks"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Create a nice theme
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Some task I need to do
                                            <small class="pull-right">60%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Make beautiful transitions
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>Jane Doe <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="{{ asset('img/avatar3.png') }}" class="img-circle" alt="User Image" />
                            <p>
                                Jane Doe - Web Developer
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('img/avatar3.png')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>Hello, Evhanz</p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <!--Menu right: option list-->
            <ul class="sidebar-menu">
                <li>
                    <a href="{{route('inicio')}}">
                        <i class="fa fa-dashboard"></i> <span>Inicio</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Personal</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    
                    
                
                    <ul class="treeview-menu">
                        <li><a href="{{route('personal')}}" class="item sub"><i class="fa fa-angle-double-right"></i>  Módulo Personal</a></li>
                        <li><a href="{{route('viewProfesiones','&')}}" class="item sub"><i class="fa fa-angle-double-right"></i>Módulo Profesion</a></li>
                        <li><a href="{{route('viewAreas','&')}}" class="item sub"><i class="fa fa-angle-double-right"></i>Módulo Area</a></li>
                        <li><a href="{{route('getAllContratos')}}" class="item sub"><i class="fa fa-angle-double-right"></i>Módulo Contratos</a></li>
                    </ul>
                </li><!--Personal-->


                    
                
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Proformas</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('viewProformas','1')}}" class="item sub"><i class="fa fa-angle-double-right"></i> Modulo Proforma</a></li>
                        <li><a href="{{route('viewTareo')}}" class="item sub"><i class="fa fa-angle-double-right"></i> Modulo Tareo</a></li>
                    </ul>
                </li><!--Proformas-->

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart"></i>
                        <span>Reportes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('getReporteByPersonal')}}" class="item sub"><i class="fa fa-angle-double-right"></i> Horas </a></li>
                        <li><a href="{{route('viewGetReportByProforms')}}" class="item sub"><i class="fa fa-angle-double-right"></i> Resumen Proformas</a></li>
                        <li><a href="{{route('viewGetProformaNoClosed')}}" class="item sub"><i class="fa fa-angle-double-right"></i> Proformas No Cerradas</a></li>

                    </ul>


                </li><!--Proformas-->


            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        @yield('content-header')
        @yield('content')
        <!-- Content Header (Page header) -->
        <!--
        <section class="content-header">
            <h1>
                Blank page
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>
        -->
        <!-- Main content -->
        <!--
        <section class="content">
            <div class="row">
                <h2>Hola</h2>
            </div>
        </section>
        -->
        <!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->



<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/AdminLTE/ej.js')}}" type="text/javascript"></script>

</body>
</html>


<style>

    /*todo esto pasar a un css externo*/
    #alert-success{
        position: absolute;
        right: 25px;
        top: 50px;
        width: 300px;
        z-index: 5;
    }
    #alert-error{
        position: absolute;
        right: 25px;
        top: 50px;
        width: 300px;
        z-index: 5;
    }
    .bs-callout {
        background-color: white;
        border-width: 1px 1px 1px 5px;
        border-style: solid;
        border-color: #EEE;
        -moz-border-top-colors: none;
        -moz-border-right-colors: none;
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        border-image: none;
        border-radius: 3px;
        padding: 20px;
        
    }
    .bs-callout-info {
        border-left-color: #1B809E;
    }

    .bs-callout-info h4 {
        color: #1B809E;
    }
    .bs-callout h4 {
        margin-top: 0px;
        margin-bottom: 5px;
    }

    /*Pagination*/
    
    #pagination > ul{

        display: inline-block;
        padding-left: 0px;
        margin: 20px 0px;
        border-radius: 4px;
        
    }

    #pagination >ul >li{
        display: inline;

    }

    #pagination > ul > li:first-child > a, .pagination > li:first-child > span {
    margin-left: 0px;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    }
    #pagination > ul > li > a, 
    #pagination > ul > li > span {
        cursor: pointer;
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857;
        color: #337AB7;
        text-decoration: none;
        background-color: #FFF;
        border: 1px solid #DDD;
    }

    #pagination > ul > .disabled > a,
    #pagination > ul > .disabled > a:focus, 
    #pagination > ul > .disabled > a:hover, 
    #pagination > ul > .disabled > span, 
    #pagination > ul > .disabled > span:focus, 
    #pagination > ul > .disabled > span:hover {
        color: #777;
        cursor: not-allowed;
        background-color: #FFF;
        border-color: #DDD;
    }

    #pagination > ul > .active > a,
    #pagination > ul> .active > a:focus,
    #pagination > ul > .active > a:hover,
    #pagination > ul > .active > span,
    #pagination > ul > .active > span:focus,
    #pagination > ul > .active > span:hover {
        z-index: 2;
        color: #FFF;
        cursor: default;
        background-color: #337AB7;
        border-color: #337AB7;
    }




    /*End - Pagination*/

    /*para el boton cargando*/
    .circle {
        background-color: rgba(0,0,0,0);
        border: 5px solid rgba(0,183,229,0.9);
        opacity: .9;
        border-right: 5px solid rgba(0,0,0,0);
        border-left: 5px solid rgba(0,0,0,0);
        border-radius: 50px;
        box-shadow: 0 0 35px #2187e7;
        width: 50px;
        height: 50px;
        margin: 0 auto;
        -moz-animation: spinPulse 1s infinite ease-in-out;
        -webkit-animation: spinPulse 1s infinite linear;
    }

    .circle1 {
        background-color: rgba(0,0,0,0);
        border: 5px solid rgba(0,183,229,0.9);
        opacity: .9;
        border-left: 5px solid rgba(0,0,0,0);
        border-right: 5px solid rgba(0,0,0,0);
        border-radius: 50px;
        box-shadow: 0 0 15px #2187e7;
        width: 30px;
        height: 30px;
        margin: 0 auto;
        position: relative;
        top: -40px;
        -moz-animation: spinoffPulse 1s infinite linear;
        -webkit-animation: spinoffPulse 1s infinite linear;
    }

    @-moz-keyframes spinPulse {
        0% {
            -moz-transform: rotate(160deg);
            opacity: 0;
            box-shadow: 0 0 1px #2187e7;
        }

        50% {
            -moz-transform: rotate(145deg);
            opacity: 1;
        }

        100% {
            -moz-transform: rotate(-320deg);
            opacity: 0;
        };
    }

    @-moz-keyframes spinoffPulse {
        0% {
            -moz-transform: rotate(0deg);
        }

        100% {
            -moz-transform: rotate(360deg);
        };
    }

    @-webkit-keyframes spinPulse {
        0% {
            -webkit-transform: rotate(160deg);
            opacity: 0;
            box-shadow: 0 0 1px #2187e7;
        }

        50% {
            -webkit-transform: rotate(145deg);
            opacity: 1;
        }

        100% {
            -webkit-transform: rotate(-320deg);
            opacity: 0;
        };
    }

    @-webkit-keyframes spinoffPulse {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        };
    }

    /*end cargando*/

        

</style>


