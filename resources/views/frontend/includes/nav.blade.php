<section class="header">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#frontend-navbar-collapse">
                    <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @roles('Raider')
                        @if(auth()->user()->pendingRaids)
                            <div class="hidden-sm hidden-md hidden-lg">
                                <a class="navbar-brand" href="/raids">Raids ({{auth()->user()->pendingRaids }})</a>
                            </div>
                        @endif
                @endauth
            </div><!--navbar-header-->

            <div class="collapse navbar-collapse" id="frontend-navbar-collapse">

                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>{!! link_to_route('frontend.index', 'Home') !!}</li>
                    <!--<li>{!! link_to_route('frontend.roster', 'Roster') !!}</li>-->
                    <li>{!! link_to('forums', 'Forums') !!}</li>
                    @roles('Raider')
                        <li>
                            @if(auth()->user()->pendingRaids)
                                <a href="/raids">Raids ({{auth()->user()->pendingRaids }})</a>
                            @else
                                {!! link_to('raids', 'Raids') !!}
                            @endif
                        </li>
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li>{!! link_to('login', trans('navs.frontend.login')) !!}</li>
                        <li>{!! link_to('register', trans('navs.frontend.register')) !!}</li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>{!! link_to_route('frontend.user.dashboard', trans('navs.frontend.dashboard')) !!}</li>

                                @if (access()->user()->canChangePassword())
                                    <li>{!! link_to_route('auth.password.change', trans('navs.frontend.user.change_password')) !!}</li>
                                @endif

                                @permission('view-backend')
                                    <li>{!! link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) !!}</li>
                                @endauth

                                <li>{!! link_to_route('auth.logout', trans('navs.general.logout')) !!}</li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div><!--navbar-collapse-->
        </div><!--container-->
    </nav>
    <div class="container">
        <div class="text-center">
            <img src="/images/weiwu.png" />
        </div>
    </div>
</section>
