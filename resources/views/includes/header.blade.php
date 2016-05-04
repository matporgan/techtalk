<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Tech Talk</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li {{ Request::is('/') ? 'class=active' : null }}><a href="/">Home</a></li>
                <li {{ Request::is('orgs') ? 'class=active' : null }}><a href="/orgs">Organisations</a></li>
                {{Request::is('/orgs')}}
                <li {{ Request::is('orgs/create') ? 'class=active' : null }}><a href="/orgs/create">Add</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">My Organisations</a></li>
                            <li><a href="#">My Discussions</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li {{ Request::is('login') ? 'class=active' : null }}><a href="/login">Login</a></li>
                    <li {{ Request::is('register') ? 'class=active' : null }}><a href="/register">Register</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

