<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="true"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                           placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link @if ($pageSlug == 'dashboard') {{'active text-primary'}} @endif"
                       href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a class="nav-link @if (str_starts_with($pageSlug, "user")) {{'active text-primary'}} @endif"
                       href="#navbar-examples" data-toggle="collapse"
                       aria-expanded="{{str_starts_with($pageSlug, "user")?'true':'false'}}"
                       aria-controls="navbar-examples">
                        <i class="fab fa-laravel"></i>
                        <span class="nav-link-text">{{ __('Laravel Examples') }}</span>
                    </a>

                    <div class="collapse @if (str_starts_with($pageSlug, "user")) {{'show'}} @endif"
                         id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a class="nav-link @if ($pageSlug=="user-edit") {{'active text-primary'}} @endif"
                                   href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a class="nav-link @if ($pageSlug=="user-index") {{'active text-primary'}} @endif"
                                   href="{{ route('user.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Clients--}}

                <li>
                    <a class="nav-link @if (str_starts_with($pageSlug, "client")) {{'active text-primary'}} @endif"
                       href="#navbar-client" data-toggle="collapse"
                       aria-expanded="{{str_starts_with($pageSlug, "client")?'true':'false'}}"
                       aria-controls="navbar-client">
                        <i class="ni ni-single-02"></i>
                        <span class="nav-link-text">{{ __('Clients') }}</span>
                    </a>

                    <div class="collapse @if (str_starts_with($pageSlug, "client")) {{'show'}} @endif"
                         id="navbar-client">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a class="nav-link @if ($pageSlug=="client-create") {{'active text-primary'}} @endif"
                                   href="{{ route('clients.create') }}">
                                    <i class="ni ni-fat-add"></i>
                                    {{ __('New Client') }}
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a class="nav-link @if ($pageSlug=="client-manager") {{'active text-primary'}} @endif"
                                   href="{{ route('clients.index') }}">
                                    <i class="ni ni-badge"></i>
                                    {{ __('Our Clients') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{--            Invoice--}}

                {{--                For Top Nav Link--}}

                @if (str_starts_with($pageSlug, "invoices"))
                    @push('top-nav-link')
                        <li class="breadcrumb-item"><a href="#">{{ __('Invoices') }}</a></li>
                    @endpush
                @endif
                @if ($pageSlug == 'invoices-create')
                    @push('top-nav-link')
                        <li class="breadcrumb-item active" aria-current="page">{{ __('New Invoice') }}</li>
                    @endpush
                @endif
                @if ($pageSlug == 'invoices-manage')
                    @push('top-nav-link')
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Manage Invoice') }}</li>
                    @endpush
                @endif

                <li class="nav-item">
                    <a class="nav-link @if (str_starts_with($pageSlug, "invoices")) {{'active text-primary'}} @endif"
                       href="#navbar-invoices" data-toggle="collapse"
                       aria-expanded="{{str_starts_with($pageSlug, "invoices")?'true':'false'}}"
                       aria-controls="navbar-invoices">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span class="nav-link-text">{{ __('Invoices') }}</span>
                    </a>

                    <div class="collapse @if (str_starts_with($pageSlug, "invoices")) {{'show'}} @endif"
                         id="navbar-invoices">
                        <ul class="nav nav-sm flex-column">
{{--                            New Invoice--}}
                            <li class="nav-item">
                                <a class="nav-link @if ($pageSlug == 'invoices-create') {{'active text-primary'}} @endif"
                                   href="{{ route('invoices.create') }}">
                                    <i class="far fa-plus-square"></i>
                                    {{ __('New Invoice') }}
                                </a>
                            </li>
{{--                            Manage Invoice--}}
                            <li class="nav-item">
                                <a class="nav-link @if ($pageSlug == 'invoices-manage') {{'active text-primary'}} @endif"
                                   href="{{ route('invoices.index') }}">
                                    <i class="fas fa-tasks"></i>
                                    {{ __('Manage Invoice') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{--            Drivers Section--}}

                {{--                For Top Nav Link--}}

                @if (str_starts_with($pageSlug, "drivers"))
                    @push('top-nav-link')
                        <li class="breadcrumb-item"><a href="{{route('drivers.index')}}">{{ __('Drivers') }}</a></li>
                    @endpush
                @endif
                @if ($pageSlug == 'drivers-create')
                    @push('top-nav-link')
                        <li class="breadcrumb-item active" aria-current="page">{{ __('New Driver') }}</li>
                    @endpush
                @endif
                @if ($pageSlug == 'drivers-manager')
                    @push('top-nav-link')
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Manage Driver') }}</li>
                    @endpush
                @endif

                <li class="nav-item">
                    <a class="nav-link @if (str_starts_with($pageSlug, "drivers")) {{'active text-primary'}} @endif"
                       href="#navbar-drivers" data-toggle="collapse"
                       aria-expanded="{{str_starts_with($pageSlug, "drivers")?'true':'false'}}"
                       aria-controls="navbar-drivers">
                        <i class="ni ni-bus-front-12"></i>
                        <span class="nav-link-text">{{ __('Drivers') }}</span>
                    </a>

                    <div class="collapse @if (str_starts_with($pageSlug, "drivers")) {{'show'}} @endif"
                         id="navbar-drivers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link @if ($pageSlug == 'drivers-create') {{'active text-primary'}} @endif"
                                   href="{{ route('drivers.create') }}">
                                    <i class="ni ni-fat-add"></i>
                                    {{ __('New Driver') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($pageSlug == 'drivers-manager') {{'active text-primary'}} @endif"
                                   href="{{ route('drivers.index') }}">
                                    <i class="ni ni-circle-08"></i>
                                    {{ __('Our Drivers') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('icons') }}">
                        <i class="ni ni-planet text-blue"></i> {{ __('Icons') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($pageSlug == 'tables') {{'active text-primary'}} @endif"
                       href="{{ route('table') }}">
                        <i class="ni ni-bullet-list-67 text-default"></i>
                        <span class="nav-link-text">Tables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html"
                       target="_blank">
                        <i class="ni ni-ui-04"></i>
                        <span class="nav-link-text">Components</span>
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Documentation</h6>
            <!-- Navigation -->
        </div>
    </div>
</nav>
