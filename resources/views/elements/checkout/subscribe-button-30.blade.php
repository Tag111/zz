    @if(Auth::check())
        <script 
            src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
            data-public-key="pk_live_ewoaQLn-qa7BkcUYbWE4owCy"
            data-transaction-amount="{{ $user->profile_access_price }}"
            data-button-text="Subscribe 100fcfa for 30 jours"
            data-currency-iso="XOF"
            data-transaction-description="Subscription for {{ $user->name }} : {{ \App\Providers\SettingsServiceProvider::getWebsiteFormattedAmount($user->profile_access_price) }} {{ __('for') }} {{ trans_choice('days', 30, ['number' => 30]) }}"
            data-customer-email="{{ Auth::user()->email }}"
            data-customer-firstname="{{ Auth::user()->name }}"
            data-customer-city="{{ Auth::user()->city ?? '' }}"
        ></script>
    @endif