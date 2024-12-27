<?php

namespace App\Providers;

use App\User;
use Carbon\Carbon;
use App\Model\UserCode;
use App\Model\UserDevice;
use App\Model\ReferralCodeUsage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\EmailsServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public const ALPHABET = '0123456789ACDEFGHKMNPQRTVWXY';

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }

    /**
     * Function used to create an user
     * Used in the register function & installer process.
     * @param $data
     * @return mixed
     */
    public static function createUser($data)
    {
        // Préparation des données utilisateur
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => 'u' . time(),
            'password' => isset($data['password']) ? Hash::make($data['password']) : '',
            'settings' => collect([
                'notification_email_new_sub' => 'true',
                'notification_email_new_message' => env('notification_email_new_message', 'false'),
                'notification_email_expiring_subs' => 'true',
                'notification_email_renewals' => 'false',
                'notification_email_new_tip' => 'true',
                'notification_email_new_comment' => 'false',
                'notification_email_new_post_created' => getSetting('profiles.default_new_post_notification_setting') ? 'true' : 'false',
                'locale' => getSetting('site.default_site_language'),
                'notification_email_new_ppv_unlock' => 'true',
                'notification_email_creator_went_live' => 'false',
            ]),
            'enable_2fa' => getSetting('security.default_2fa_on_register', false),
            'public_profile' => getSetting('profiles.default_user_privacy_setting_on_register') === 'private' ? false : true,
            'open_profile' => getSetting('profiles.default_profile_type_on_register') === 'open',
        ];

        // Si un prix par défaut est défini
        if (getSetting('payments.default_subscription_price')) {
            $price = str_replace(',', '.', getSetting('payments.default_subscription_price'));
            $userData['profile_access_price'] = $price;
            $userData['profile_access_price_6_months'] = $price;
            $userData['profile_access_price_12_months'] = $price;
        }

        // Générer un code unique pour l'utilisateur
        try {
            $code = self::generateReferralCode(8);
            $userData['referral_code'] = $code;
        } catch (\Exception $exception) {
            // Log ou gestion d'erreur
        }

        // Créer l'utilisateur
        $user = User::create($userData);

        // Gestion du code de parrainage transmis via $data
        if (isset($data['referral_code']) && $data['referral_code']) {
            $referrer = User::where('referral_code', $data['referral_code'])->first();
            if ($referrer) {
                // Enregistrer dans referral_code_usages
                ReferralCodeUsage::create([
                    'user_id' => $referrer->id, // Parrain
                    'used_by' => $user->id, // Filleul
                    'referral_code' => $data['referral_code'], // Code utilisé
                ]);
            }
        }

        // Envoyer un email de vérification si nécessaire
        if (isset($data['auth_provider']) && isset($data['auth_provider_id'])) {
            $user->sendEmailVerificationNotification();
        }

        return $user;
    }


    /**
     * Function that generates new 2FA codes and emails them.
     */
    public static function generate2FACode()
    {
        try {
            $user = Auth::user();
            $code = rand(100000, 999999);
            UserCode::updateOrCreate(
                ['user_id' => $user->id],
                ['code' => $code]
            );
            try {
                App::setLocale($user->settings['locale']);
            } catch (\Exception $e) {
                App::setLocale('en');
            }
            EmailsServiceProvider::sendGenericEmail(
                [
                    'email' => $user->email,
                    'subject' => __('Verify your new device'),
                    'title' => __('Hello, :name,', ['name' => $user->name]),
                    'content' => __('Your verification code is:') . ' ' . $code,
                    'button' => [
                            'text' => __('Go to site'),
                            'url' => route('feed'),
                        ],
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Generates new string for current addr&agent.
     * @return string
     */
    public static function generate2FaDeviceSignature()
    {
        return sha1(request()->ip() . request()->header('User-Agent'));
    }

    /**
     * Adds a new user device.
     * @param $userID
     * @param bool $verified
     * @return mixed
     */
    public static function addNewUserDevice($userID, $verified = false)
    {
        $signature = self::generate2FaDeviceSignature();
        if (!UserDevice::where('signature', $signature)->where('user_id', $userID)->first()) {
            $data = [
                'user_id' => $userID,
                'address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'signature' => $signature,
            ];
            if ($verified) {
                $data['verified_at'] = Carbon::now();
            }
            return UserDevice::create($data);
        }
        return false;
    }

    /**
     * Gets validated user devices.
     * @param $userID
     * @return mixed
     */
    public static function getUserDevices($userID)
    {
        return UserDevice::where('user_id', $userID)->where('verified_at', '<>', null)->select('signature')->pluck('signature')->toArray();
    }

    /**
     * @param $length
     * @return string
     * @throws \Exception
     */
    public static function generateReferralCode($length, $prefix = null)
    {
        $code = '';
        while (strlen($code) < $length || User::query()->where('referral_code', $code)->first() != null) {
            $code .= substr(self::ALPHABET, (random_int(1, 28) - 1), 1);
        }

        if (!empty($prefix)) {
            $code = $prefix . $code;
        }

        return $code;
    }
}
