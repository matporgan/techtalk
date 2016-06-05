<header>
    <div class="navbar-fixed">
        <nav @if(Request::is('home1')) class="home" @endif>
            <div class="nav-wrapper container">
                <ul class="hide-on-med-and-down">
                    <li {{ Request::is('/') ? 'class=active' : null }}><a href="/">Home</a></li>
                    <li {{ Request::is('orgs') ? 'class=active' : null }}><a href="/orgs">Find</a></li>
                    <li {{ Request::is('discussions') ? 'class=active' : null }}><a href="/discussions">Discuss</a></li>
                    <li {{ Request::is('orgs/create') ? 'class=active' : null }}><a href="/orgs/create">Contribute</a></li>
                </ul>
                <a href="/" class="brand-logo center" @if(Request::is('home1')) style="display: none;" @endif>
                    <div class="site-logo @unless(Request::is('home1')) alt @endunless">
                        <span>&lt;</span>tech talk<span>&gt;</span>
                    </div>
                </a>
                <ul class="right hide-on-med-and-down">
                    @if(Auth::check())
                        <li><a href="/discussions/12" target="_top">Feedback</a></li>
                        <li><a href="#!" class="dropdown-button" data-activates="user-dropdown" style="min-width: 160px">{{ Auth::user()->getName() }}<i class="material-icons right">arrow_drop_down</i></a></li>
                        <ul id="user-dropdown" class="dropdown-content">
                            <li><a href="/account">Account</a></li>
                            <li><a href="/user/{{ Auth::user()->id }}/orgs">My Organisations</a></li>
                            <li><a href="/user/{{ Auth::user()->id }}/discussions">My Discussions</a></li>
                            <li class="divider"></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    @else
                        <li><a href="/discussions/12">Feedback</a></li>
                        <li {{ Request::is('login') ? 'class=active' : null }}><a href="/login">Login</a></li>
                    @endif
                </ul>
                <a href="#" class="button-collapse" data-activates="nav-mobile"><i class="material-icons">menu</i></a>
                <ul class="side-nav" id="nav-mobile">
                    <li {{ Request::is('orgs') ? 'class=active' : null }}><a href="/orgs">Find</a></li>
                    <li {{ Request::is('discussions') ? 'class=active' : null }}><a href="/discussions">Discuss</a></li>
                    <li {{ Request::is('orgs/create') ? 'class=active' : null }}><a href="/orgs/create">Contribute</a></li>
                    <li class="divider"></li>
                    @if(Auth::check())
                        <li><a href="/account">Account</a></li>
                        <li><a href="/user/{{ Auth::user()->id }}/orgs">My Organisations</a></li>
                        <li><a href="/user/{{ Auth::user()->id }}/discussions">My Discussions</a></li>
                        <li class="divider"></li>
                        <li><a href="/logout">Logout</a></li>
                    @else
                        <li {{ Request::is('login') ? 'class=active' : null }}><a href="/login">Login</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>