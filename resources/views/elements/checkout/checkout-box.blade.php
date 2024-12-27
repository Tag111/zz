<div class="row checkout-dialog">
    <div class="col-lg-6 mx-auto">
        {{-- FedaPay actual buttons --}}
        <div class="paymentOption paymentFedaPay">
            <form id="fedapay-buyItem" method="post" action="{{ route('payment.initiatePayment') }}">
                @csrf
                <input type="hidden" name="amount" id="fedapay-amount" value="">
                <input type="hidden" name="transaction_type" id="fedapay-transaction-type" value="">
                <input type="hidden" name="recipient_user_id" id="fedapay-recipient" value="">
                <input type="hidden" name="description" id="fedapay-description" value="Description du paiement">
                {{-- <button class="payment-button" type="submit">{{ __('Pay with FedaPay') }}</button> --}}
            </form>
        </div>

        <!-- Modal for FedaPay payment -->
        <div class="checkout-popup modal fade" id="checkout-center" tabindex="-1" role="dialog"
            aria-labelledby="checkout" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="payment-title">{{ __('Payment Details') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="payment-body">
                            <div class="d-flex flex-row">
                                <div class="ml-0 ml-md-2 mb-2">
                                    <img src="" class="rounded-circle user-avatar">
                                </div>
                                <div class="d-lg-block">
                                    <div class="pl-2 d-flex justify-content-center flex-column">
                                        <div class="ml-2">
                                            <div class="text-bold name"></div>
                                            <div class="text-muted username"><span>@</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-description mb-3 d-none"></div>
                            <div class="input-group mb-3 checkout-amount-input d-none">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="amount-label">
                                        @include('elements.icon', [
                                            'icon' => 'cash-outline',
                                            'variant' => 'medium',
                                            'centered' => false,
                                        ])
                                    </span>
                                </div>
                                <input class="form-control uifield-amount"
                                    placeholder="{{ __('Amount ($5 min, $500 max)') }}" aria-label="Amount"
                                    aria-describedby="amount-label" id="checkout-amount" type="number" min="5"
                                    step="1" max="500">
                                <div class="invalid-feedback">{{ __('Please enter a valid amount.') }}</div>
                            </div>
                        </div>

                        <div>
                            <h6>{{ __('Payment method') }}</h6>
                            <div class="d-flex text-left radio-group row px-2">
                                @if (config('feda.fedapay_public_key') && config('feda.fedapay_secret_key'))
                                    <div class="p-1 col-6 col-md-3 col-lg-3 fedapay-payment-method">
                                        <div class="radio mx-auto fedapay-payment-provider checkout-payment-provider d-flex align-items-center justify-content-center"
                                            data-value="fedapay">
                                            <img src="{{ asset('/img/logos/fedapay.png') }}" alt="FedaPay">
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="payment-error error text-danger text-bold d-none mb-1">
                            {{ __('Please select your payment method') }}
                        </div>
                        <p class="text-muted mt-1">
                            {{ __('Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website.') }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary checkout-continue-btn">{{ __('Continue') }}
                            <div class="spinner-border spinner-border-sm ml-2 d-none" role="status">
                                <span class="sr-only">{{ __('Loading...') }}</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
