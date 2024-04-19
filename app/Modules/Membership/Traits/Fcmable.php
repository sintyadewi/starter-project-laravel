<?php

namespace App\Modules\Membership\Traits;

use App\Modules\Membership\Models\FcmToken;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Fcmable
{
    protected ?FcmToken $fcmToken;

    public function currentFcmToken(): ?FcmToken
    {
        return $this->fcmToken;
    }

    public function withFcmToken(?FcmToken $fcmToken): static
    {
        $this->fcmToken = $fcmToken;

        return $this;
    }

    /**
     * @return MorphOne<FcmToken>
     */
    public function fcmToken(): MorphOne
    {
        return $this->morphOne(FcmToken::class, 'fcmable');
    }

    /**
     * @return MorphMany<FcmToken>
     */
    public function fcmTokens(): MorphMany
    {
        return $this->morphMany(FcmToken::class, 'fcmable');
    }
}
