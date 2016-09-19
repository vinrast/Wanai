<!-- begin #header -->
    <div id="header" class="header navbar navbar-transparent navbar-fixed-top">
        <!-- begin container -->
        <div class="container">
            <!-- begin navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ url ('/') }}" class="navbar-brand">
                    <img class="wanai-nav-cliente-logo" src="{{ url('img/wanai.png') }}">
                    <span class="brand-text" style="color:#2d353c;">
                        <span class="text-theme">Wanai</span> Travel
                    </span>
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- begin navbar-collapse -->
            <div class="collapse navbar-collapse" id="header-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url ('/hoteles') }}">HOTELES</a></li>
                    <li><a href="{{ url ('/boletos') }}">BOLETERIA</a></li>
                    <li><a href="{{ url ('/paquetes') }}">PAQUETES</a></li>
                </ul>
            </div>
            <!-- end navbar-collapse -->
        </div>
        <!-- end container -->
    </div>
<!-- end #header -->