<?php

namespace App\Services;

use App\Model\ReferralCodeUsage;
use App\Models\User;

class ReferralService
{
    public function processReferral($user, $referralCode)
    {
        $referrerCode = ReferralCodeUsage::where('code', $referralCode)
            ->where('is_active', true)
            ->first();

        if ($referrerCode) {
            // Mettre à jour le nouveau user
            $user->update([
                'referred_by_code' => $referralCode
            ]);

            // Incrémenter le compteur d'utilisation
            $referrerCode->increment('uses');

            // Si le parrain atteint 2 parrainages
            if ($referrerCode->uses >= 2) {
                $referrerCode->user->update([
                    'has_referral_discount' => true
                ]);
            }

            return true;
        }

        return false;
    }
}