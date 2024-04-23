<?php

namespace App\Modules\Membership\Traits;

use App\Modules\Membership\Models\FcmToken;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Fcmable
{
    protected ?FcmToken $singleFcmToken;
    protected ?Collection $multipleFcmToken;

    public function currentFcmToken(): ?FcmToken
    {
        return $this->singleFcmToken;
    }

    public function withFcmToken(?FcmToken $fcmToken): static
    {
        $this->singleFcmToken = $fcmToken;

        return $this;
    }

    public function initializeHasFcmTokens(): void
    {
        $this->multipleFcmToken = new Collection();
    }

    public function addFcmToken(FcmToken $fcmToken): void
    {
        $this->multipleFcmToken->add($fcmToken);
    }

    public function getFcmTokens(): Collection
    {
        return $this->multipleFcmToken;
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
