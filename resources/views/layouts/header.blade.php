<header>
    <div class="navbar-fixed">
        <nav @if(Request::is('home1')) class="home" @endif>
            <div class="nav-wrapper container">
                <ul class="hide-on-med-and-down">
                    <li {{ Request::is('/') ? 'class=active' : null }}><a href="/">Home</a></li>
                    <li {{ Request::is('find') ? 'class=active' : null }}><a href="/find">Find</a></li>
                    <li {{ Request::is('discuss') ? 'class=active' : null }}><a href="/discuss">Discuss</a></li>
                    <li {{ Request::is('orgs/create') ? 'class=active' : null }}><a href="/orgs/create">Contribute</a></li>
                    <!--<li><a href="/"><i class="material-icons">home</i></a></li>-->
                    <!--<li><a id="nav-search" href="#!"><i class="material-icons">search</i></a></li>-->
                    <!--<li id="nav-search-form" style="display:none;">-->
                    <!--    <form>-->
                    <!--        <div class="input-field">-->
                    <!--            <input id="search" type="search" required>-->
                    <!--            <label for="search"><i class="material-icons">search</i></label>-->
                    <!--            <i id="search-cancel" class="material-icons">close</i>-->
                    <!--        </div>-->
                    <!--    </form>-->
                    <!--</li>-->
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
                    <li {{ Request::is('find') ? 'class=active' : null }}><a href="/find">Find</a></li>
                    <li {{ Request::is('discuss') ? 'class=active' : null }}><a href="/discuss">Discuss</a></li>
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

<script type="text/javascript">
    $('#nav-search').click(function() {
        $('#nav-search-form').toggle();
        $('#search').focus();
        $('#nav-search').toggle();
    });
    $('#search-cancel').click(function() {
        $('#nav-search-form').toggle();
        $('#nav-search').toggle();
    });
</script>