<header>
    <nav>
        <div class="nav-wrapper container">
            <ul class="hide-on-med-and-down">
                <li {{ Request::is('/') ? 'class=active' : null }}><a href="/">Home</a></li>
                <li {{ Request::is('orgs') ? 'class=active' : null }}><a href="/orgs">Organisations</a></li>
                <li {{ Request::is('discussions') ? 'class=active' : null }}><a href="/discussions">Discussions</a></li>
            </ul>
            <a href="/" class="brand-logo center valign-wrapper"><img class="valign" src="/img/TechTalkLogo.png" alt="Logo" /></a>
            <ul class="right hide-on-med-and-down">
                @if(Auth::check())
                    <li><a href="mailto:patrick.morgan@advisian.com?Subject=Tech%20Talk" target="_top">Bugs/Suggestions</a></li>
                    <li><a href="#!" class="dropdown-button" data-activates="user-dropdown" style="min-width: 160px">{{ Auth::user()->getName() }}<i class="material-icons right">arrow_drop_down</i></a></li>
                    <ul id="user-dropdown" class="dropdown-content">
                        <li><a href="/user/{{ Auth::user()->id }}/orgs">My Organisations</a></li>
                        <li><a href="/user/{{ Auth::user()->id }}/discussions">My Discussions</a></li>
                        <li class="divider"></li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                @else
                    <li><a href="mailto:patrick.morgan@advisian.com?Subject=Tech%20Talk" target="_top">Bugs/Suggestions</a></li>
                    <li {{ Request::is('register') ? 'class=active' : null }}><a href="/register">Register</a></li>
                    <li {{ Request::is('login') ? 'class=active' : null }}><a href="/login">Login</a></li>
                @endif
            </ul>
            <a href="#" class="button-collapse" data-activates="nav-mobile"><i class="material-icons">menu</i></a>
            <ul class="side-nav" id="nav-mobile">
                <li {{ Request::is('/') ? 'class=active' : null }}><a href="/">Home</a></li>
                <li {{ Request::is('orgs') ? 'class=active' : null }}><a href="/orgs">Organisations</a></li>
                <li {{ Request::is('discussions') ? 'class=active' : null }}><a href="/discussions">Discussions</a></li>
                <li class="divider"></li>
                @if(Auth::check())
                    <li><a href="/user/{{ Auth::user()->id }}/orgs">My Organisations</a></li>
                    <li><a href="/user/{{ Auth::user()->id }}/discussions">My Discussions</a></li>
                    <li class="divider"></li>
                    <li><a href="/logout">Logout</a></li>
                @else
                    <li {{ Request::is('register') ? 'class=active' : null }}><a href="/register">Register</a></li>
                    <li {{ Request::is('login') ? 'class=active' : null }}><a href="/login">Login</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>