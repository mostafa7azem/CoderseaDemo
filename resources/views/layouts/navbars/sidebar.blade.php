<div class="sidebar" data-color="orange" data-background-color="white"
     data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="https://creative-tim.com/" class="simple-text logo-normal">
            {{ __('Creative Tim') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#laravelExample1" aria-expanded="true">
                    <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                    <p>{{ __(' ADMIN') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExample1">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini"> UP </span>
                                <span class="sidebar-normal">{{ __('User profile') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <span class="sidebar-mini"> UM </span>
                                <span class="sidebar-normal"> {{ __('User Management') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($activePage == 'company') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#laravelExample2" aria-expanded="true">
                    <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                    <p>{{ __('Companies') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExample2">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'company' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('company.create') }}">
                                <span class="sidebar-mini"> CC </span>
                                <span class="sidebar-normal">{{ __('create company') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'company' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('company.index') }}">
                                <span class="sidebar-mini"> AC </span>
                                <span class="sidebar-normal"> {{ __('all companies') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($activePage == 'employee') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#laravelExample3" aria-expanded="true">
                    <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                    <p>{{ __('employees') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExample3">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'employee' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('employee.create') }}">
                                <span class="sidebar-mini"> CE </span>
                                <span class="sidebar-normal">{{ __('create employee') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'employee' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('employee.index') }}">
                                <span class="sidebar-mini"> AE </span>
                                <span class="sidebar-normal"> {{ __('all employees') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

