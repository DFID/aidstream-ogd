<header>
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <a href="{{ url('/') }}" class="navbar-brand">Aidstream</a>
            <button type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="bar1"></span>
                <span class="bar2"></span>
                <span class="bar3"></span>
            </button>
        </div>
        <div class="navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a class="" href="/cookies">Cookies</a></li>
            </ul>
            <div class="action-btn pull-left">
                @if(auth()->check())
                    <a href="{{ (auth()->user()->isSuperAdmin() || auth()->user()->isGroupAdmin()) ? url(config('app.super_admin_dashboard')) : (auth()->user()->getSystemVersion() == 2) ? url(config('app.admin_lite_dashboard')) : url(config('app.admin_dashboard')) }}"
                       class="btn btn-primary">
                        @lang('global.go_to_dashboard')
                    </a>
                @else
                    <a href="{{ url('/auth/login')}}" class="btn btn-primary">@lang('global.login')/@lang('global.register')</a>
                @endif
                {{--<select id="languages">
                    @foreach(Config::get('languages') as $key => $language)
                        <option value="{{$key}}" {{(Request::cookie('language') == $key) ? 'selected' : ''}}>{{$language}}</option>
                    @endforeach
                </select>--}}
            </div>
        </div>
    </nav>
</header>
