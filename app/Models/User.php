<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;
class User extends Authenticatable implements MustVerifyEmail 
{
    use HasApiTokens, HasFactory, Notifiable,TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
      
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_expires_at' => 'datetime',
    ];
    public function generateTwoFactorCode()
    {
        $this->timestamps = false; // Désactive la mise à jour automatique des timestamps lors de la sauvegarde
        $this->two_factor_code = rand(100000, 999999); // Génère un code à 6 chiffres
        $this->two_factor_expires_at = now()->addMinutes(10); // Définit la date d'expiration du code à 10 minutes à partir de maintenant
        $this->save(); // Enregistre les modifications dans la base de données
    }
    
        public function resetTwoFactorCode()
            {
                $this->timestamps = false;
                $this->two_factor_code = null;
                $this->two_factor_expires_at = null;
                $this->save();
            }
}
