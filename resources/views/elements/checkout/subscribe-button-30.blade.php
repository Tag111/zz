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
            public_key: 'pk_sandbox_3FNICGLlL3bkbCblJXX-ZueD',
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
