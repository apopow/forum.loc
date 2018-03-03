<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Темы форума <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="/threads/create">Новая тема</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/">Все темы</a></li>

                        @if (auth()->check())
                            <li><a href="/?by={{ auth()->user()->name }}">Мои темы</a></li>
                        @endif

                        <li><a href="/?popular=1">Популярные темы</a></li>
                        <li><a href="/?answered=1">Темы с сообщениями</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Рубрики <span class="caret"></span></a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuDivider">
                    <li>
                        <a href="/channels/create">Новая рубрика</a>
                    </li>
                    <li role="separator" class="divider"></li>
                        @foreach ($channels as $channel)
                            <li><a href="/threads/{{ $channel->slug }}">{{ $channel->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Войти</a></li>
                    <li><a href="{{ route('register') }}">Зарегистрироваться</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false" style="position: relative; padding-left: 50px">
                           <img style="width:32px; height:32px; position:absolute; top: 10px; left: 10px; border-radius: 50%;"src="/uploads/avatars/{{ Auth::user()->avatar }}">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('profile', Auth::user()) }}">Мой профиль</a>
                            </li>
                            <li>
                                <a href="{{ route('form.password')}}">Сменить пароль</a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Выйти
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>