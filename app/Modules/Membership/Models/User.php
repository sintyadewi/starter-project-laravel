<?php

namespace App\Modules\Membership\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use App\Modules\Membership\Traits\Fcmable;
use App\Modules\Shared\Traits\HasRoleAndPermissionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\CausesActivity;
use Timedoor\Filter\FilterTrait;

/**
 * @method \Illuminate\Database\Eloquent\Collection<int, \jeremykenedy\LaravelRoles\Models\Role> getRoles()
 */
class User extends Authenticatable
{
    use Fcmable,
        CausesActivity,
        FilterTrait,
        HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoleAndPermissionTrait;

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
    ];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    /**
     * Hash the user's password automatically.
     */
    protected function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::needsRehash($password)
            ? Hash::make($password)
            : $password;
    }

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        // SINGLE
        // $user = $this->load('fcmToken');
        // $this->withFcmToken($user->fcmToken);
        // return $this->currentFcmToken()->fcm_token;

        // MULTIPLE
        $user = $this->load('fcmTokens');

        $this->initializeHasFcmTokens();

        foreach ($user->fcmTokens as $fcmToken) {
            $this->addFcmToken($fcmToken);
        }

        return $this->getFcmTokens()->pluck('fcm_token')->toArray();
    }
}
