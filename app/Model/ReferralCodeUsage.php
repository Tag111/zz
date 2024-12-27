<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ReferralCodeUsage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'used_by',
        'referral_code',
        'user_id',
        'code',
        'uses',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /*
     * Relationships
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by_code', 'referral_code');
    }

      // Codes de parrainage utilisés par cet utilisateur (en tant que filleul)
      public function usedReferralCodes()
      {
          return $this->hasMany(ReferralCodeUsage::class, 'used_by');
      }
  
      // Codes de parrainage possédés par cet utilisateur (en tant que parrain)
      public function referralCodeUsages()
      {
          return $this->hasMany(ReferralCodeUsage::class, 'user_id');
      }

    /* Autres */

    public function usedBy()
    {
        return $this->hasOne('App\User', 'id', 'used_by');
    }
}
