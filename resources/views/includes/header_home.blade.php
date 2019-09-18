<header>
    <nav class="navbar navbar-default navbar-static navbar-fixed">
        <div class="navbar-header">
            @if(isTzSubDomain())
                <a href="{{ url('/') }}" class="navbar-brand" title="AidStream Tanzania"><img src="/images/ic_logo-aidstream-tz.svg" alt="AidStream Tanzania"></span></a>
            @else
                <a href="{{ url('/') }}" class="navbar-brand">@lang('title.aidstream')</a>
            @endif
            <button type="button" class="navbar-toggle collapsed">
                <span class="sr-only">@lang('global.toggle_navigation')</span>
                <span class="bar1"></span>
                <span class="bar2"></span>
                <span class="bar3"></span>
            </button>
        </div>
        <div class="navbar-collapse navbar-right">
            <div class="action-btn pull-left">
                @if(auth()->check())
                    <a href="{{ url((auth()->user()->role_id == 1 || auth()->user()->role_id == 2) ? config('app.admin_dashboard') : config('app.super_admin_dashboard'))}}"
                       class="btn btn-primary">
                        @lang('global.go_to_dashboard')
                    </a>
                @else
                    <a href="{{ url('/auth/login')}}" class="btn btn-primary">@lang('global.login')/@lang('global.register')</a>
                @endif
            </div>
        </div>
    </nav>
</header>