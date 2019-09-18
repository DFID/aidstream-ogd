<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    {{ header("Cache-Control: no-cache, no-store, must-revalidate")}}
    {{ header("Pragma: no-cache") }}
    {{ header("Expires: 0 ")}}
    <title>@lang('title.aidstream')</title>
    <link rel="shortcut icon" type="image/png" sizes="16*16" href="images/devflow/favicon.png"/>
    <link rel="apple-touch-icon" sizes="57x57" href="/images/devflow/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/devflow/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/devflow/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/devflow/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/devflow/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/devflow/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/devflow/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/devflow/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/devflow/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/devflow/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/devflow/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/devflow/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/devflow/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/devflow/ms-icon-144x144.png">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/style.min.css">
</head>
<body>
@include('includes.header')
<section class="main-container">
    <div class="introduction-wrapper bottom-line">
        <div class="col-md-12 text-center">
            {{--<h1>Publish your Aid data in <a href="http://iatistandard.org/">IATI format</a> effortlessly</h1>--}}

            <h1>@lang('home.effortlessly_publish_your_aid_data',['route' => 'http://iatistandard.org/'])</h1>

            {{--<p>DevFlow is an online platform for organisations that wish to publish aid data in the International Aid--}}
            {{--Transparency Initiative(IATI) format without getting into complexities of IATI. </p>--}}

            <p>
                @lang('home.aidstream_is_online_platform')
            </p>

            @if(auth()->user())
                <a href="{{ route('registration') }}" class="btn btn-primary get-started-btn">@lang('global.get_started')</a>
            @else
                
            @endif

            <div class="screenshot">
                <img src="images/screenshot.png" alt="">
            </div>
        </div>
    </div>
    
    @if(!auth()->user())
    @endif
</section>

@if(session()->has('secondary_contact_name'))
    <div class="modal fade recovery-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body clearfix text-center ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <div class="col-md-12 text-center verification-wrapper">
                        <img src={{ url('/images/ic-sent-mail.svg') }} alt="mail" width="88" height="94">
                        <h1>@lang('global.thank_you')!</h1>
                        <p>
                            @lang('home.an_email_containing_your_account')
                        </p>
                        <p>
                            @lang('home.if_you_need_any_help',['route' => route('contact', ['has-secondary-contact-support'])])
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(session('message'))
    <div class="modal fade message-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body clearfix">
                    <div class="col-md-12 text-center verification-wrapper">
                        <img src={{ url('/images/ic-sent-mail.svg') }} alt="mail" width="88" height="94">
                        <h1>@lang('global.thank_you')!</h1>
                        <p>{!! session('message') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(session('verification_message'))
    <div class="modal fade verification-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-verify-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('registration.email_verification')</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="col-md-12 text-center verification-wrapper">
                        <img src={{ url('/images/ic-sent-mail.svg') }} alt="mail" width="88" height="94">
                        <h1>@lang('global.thank_you')!</h1>
                        <p>{!! session('verification_message') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


<script src="js/jquery.js"></script>
<script src="js/modernizr.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        function hamburgerMenu() {
            $('.navbar-toggle.collapsed').click(function () {
                $('.navbar-collapse').toggleClass('out');
                $(this).toggleClass('collapsed');
            });
        }
        hamburgerMenu();

        if ($('.modal').length > 0) {
            $('.modal').modal('show')
        }

        $('#languages').change(function () {
            window.location.href = '/switch-language/' + $(this).val();
        });

        $(document).on('click', '.get-started-btn', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1000);
            event.preventDefault();
        });
    });
</script>
</body>
</html>
