<?php

return [
    'environment' => env('FEDAPAY_ENVIRONMENT', 'live'),
    'fedapay_public_key' => env('PAYMENTS_FEAPAY_PUBLIC_KEY'),
    'fedapay_secret_key' => env('PAYMENTS_FEAPAY_SECRET_KEY'),
];
