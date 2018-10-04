<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>CMS</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="/css/style2.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

</head>


        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>BRT</h3>
                </div>

                <ul class="list-unstyled components">
                    
                    <li><a href="/dashboard">HOME</a></li>
                    @if(Auth::user()->is_admin)
                    <li>
                        <a href="/show">ADD USAGE</a>
                    </li>
                    @endif
                    @if(Auth::user()->is_admin)
                    <li>
                        <a href="/addproduct">MANAGE PRODUCT</a>
                    </li>
                    @endif
                     @if(Auth::user()->is_admin)
                    <li>
                        <a href="/manageuser">MANAGE USER</a>
                    </li>
                    @endif

                    <!-- <li>
                      <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">PRODUCTS</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="/addproduct">ADD PRODUCTS</a></li>
                            <li><a href="/showproducts">SHOW PRODUCTS</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul>


                    </li> -->
                    <!-- display li if user i admin only -->
                    
                        <li>
                            <a href="/total">USAGE</a>
                        </li>
                    

                </ul>

                
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <!-- check if admin is logged in then display -->
                               
                                @if(Auth::check())   
                                 <li><!-- <font color="blue"> -->
                                    <a href="/logout">
                                        {{ Auth :: user()-> name }}
                                        <span class="glyphicon glyphicon-log-out"></span>
                                    </a>

                                    <!-- </font> -->
                                 </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>





        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar, #content').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>
   