<div class="profile-widgets-area pb-3">

    <div class="card recent-media rounded-lg">
        <div class="card-body m-0 pb-0">
        </div>
        <h5 class="card-title pl-3 mb-0">{{ __('Recent') }}</h5>
        <div class="card-body {{ $recentMedia ? 'text-center' : '' }}">
            @if ($recentMedia && count($recentMedia) && Auth::check())
                @foreach ($recentMedia as $media)
                    <a href="{{ $media->path }}" rel="mswp" class="mr-1">
                        <img src="{{ AttachmentHelper::getThumbnailPathForAttachmentByResolution($media, 150, 150) }}"
                            class="rounded mb-2 mb-md-2 mb-lg-2 mb-xl-0 img-fluid">
                    </a>
                @endforeach
            @else
                <p class="m-0">{{ __('Latest media not available.') }}</p>
            @endif

        </div>
    </div>

    @if (
        $user->paid_profile &&
            (!getSetting('profiles.allow_users_enabling_open_profiles') ||
                (getSetting('profiles.allow_users_enabling_open_profiles') && !$user->open_profile)))
        <button id="pay-btn"
            class="btn btn-round btn-lg btn-primary btn-block d-flex justify-content-between mt-3 mb-2 px-5 to-tooltip {{ (Auth::check() && !GenericHelper::isEmailEnforcedAndValidated()) || (Auth::check() && !GenericHelper::creatorCanEarnMoney($user)) ? 'disabled' : '' }}"
            @if (Auth::check()) @if (!Auth::user()->email_verified_at && getSetting('site.enforce_email_validation'))
           data-placement="top"
           title="{{ __('Please verify your account') }}"
       @elseif(!GenericHelper::creatorCanEarnMoney($user))
           data-placement="top" 
           title="{{ __('This creator cannot earn money yet') }}" @endif
        @else data-toggle="modal" data-target="#login-dialog" @endif
            >
            <span>{{ __('Subscribe') }}</span>
            <span>
                {{ \App\Providers\SettingsServiceProvider::getWebsiteFormattedAmount($user->profile_access_price) }}
                {{ __('for') }}
                {{ trans_choice('days', 30, ['number' => 30]) }}
            </span>
        </button>
        <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
        <script>
            @if (Auth::check() && GenericHelper::creatorCanEarnMoney($user))
                FedaPay.init('#pay-btn', {
                    public_key: 'pk_sandbox_7LHxNerPU_4y1nYG3MDaLHeY',
                    transaction: {
                        amount: {{ $user->profile_access_price }},
                        description: 'Subscription for {{ $user->name }}',
                        custom_metadata: {
                            user_id: {{ Auth::id() }},
                            creator_id: {{ $user->id }},
                            amount: {{ $user->profile_access_price }},
                            type: 'one-month-subscription'
                        }
                    },
                    customer: {
                        email: '{{ Auth::user()->email }}',
                        firstname: '{{ Auth::user()->name }}',
                        city: '{{ Auth::user()->city }}'
                    },
                    onComplete: function(transaction) {
                        window.location.href = "";
                    }
                });
            @endif
        </script>
    @elseif(!Auth::check() || (Auth::check() && Auth::user()->id !== $user->id))
        @if (Auth::check())
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Follow this creator') }}</h5>
                    <button class="btn btn-round btn-outline-primary btn-block mt-3 mb-0 manage-follow-button"
                        onclick="Lists.manageFollowsAction('{{ $user->id }}')">
                        <span
                            class="manage-follows-text">{{ \App\Providers\ListsHelperServiceProvider::getUserFollowingType($user->id, true) }}</span>
                    </button>
                </div>
            </div>
        @else
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Follow this creator') }}</h5>
                    <button class="btn btn-round btn-outline-primary btn-block mt-3 mb-0 text-center"
                        data-toggle="modal" data-target="#login-dialog">
                        <span class="d-none d-md-block d-xl-block d-lg-block">{{ __('Follow') }}</span>
                    </button>
                </div>
            </div>
        @endif
    @endif

    @if (getSetting('custom-code-ads.sidebar_ad_spot'))
        <div class="mt-3">
            {!! getSetting('custom-code-ads.sidebar_ad_spot') !!}
        </div>
    @endif

    @include('template.footer-feed')

</div>
