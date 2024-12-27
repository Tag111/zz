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
    <span class="d-flex">
        {{\App\Providers\SettingsServiceProvider::getWebsiteFormattedAmount($user->profile_access_price_3_months * 3)}}
        {{__('for')}}
        {{trans_choice('months', 3,['number'=>3])}}
        <span class="d-none d-md-flex ml-1">
            @if(isset($offer['discountAmount']['90']) && $offer['discountAmount']['90'] > 0)
                ({{round($offer['discountAmount']['90'])}}% {{__('off')}})
            @endif
        </span>
    </span>
</button>
<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
<script>
    @if (Auth::check() && GenericHelper::creatorCanEarnMoney($user))
        FedaPay.init('#pay-btn', {
            public_key: 'pk_live_lTg-wHw5W4Y3tb-t1k4vduQU',
            transaction: {
                amount: {{ $user->profile_access_price_3_months * 3 }},
                description: 'Subscription for {{ $user->name }}',
                custom_metadata: {
                    user_id: {{ Auth::id() }},
                    creator_id: {{ $user->id }},
                    amount: {{ $user->profile_access_price_3_months * 3 }},
                    type: 'three-month-subscription'
                }
            },
            customer: {
                email: '{{ Auth::user()->email }}',
                firstname: '{{ Auth::user()->name }}',
                lastname: '{{ Auth::user()->name }}',
                city: '{{ Auth::user()->city }}'
            },
            onComplete: function(transaction) {
                window.location.href = "";
            }
        });
    @endif
</script>
