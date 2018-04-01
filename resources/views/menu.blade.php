<div id="menuDiv">
    <nav class="navbar navbar-fixed-top affix-top" id="menu" data-spy="affix" data-offset-top="20">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" id="menuButton" data-toggle="collapse"
                        data-target="#navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-th"></span>
                </button>
                @if (Auth::guest())
                    <a class="navbar-brand" href="{{ route('index') }}/">{{ config('app.name') }}</a>
                @else
                    <a class="navbar-brand" href="{{ route('afterLogin') }}/">{{ config('app.name') }}</a>
                @endif

            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                {{-- --------------------------------- Guest Part --------------------------------------------- --}}
                @if (Auth::guest())
                    <!--<li><a href="{{ url('/register') }}">Register</a></li>-->
                        <li><a href="{{ route('dashboard') }}">Admin</a></li>
                    @else
                        {{-- --------------------------------- Organizer Part ------------------------------------------ --}}

                        <li><a href="{{ route('organizers.index') }}">Organizers</a></li>
                        <li><a href="{{ route('participants.index') }}">Participants</a></li>


                    <!--<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                Face API <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('index') }}">Groups</a></li>
                                <li><a href="{{ route('index') }}">Create person</a></li>
                                <li><a href="{{ route('index') }}">List people</a></li>
                            </ul>
                        </li>-->

                        <li>
                            <a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>