<?php

namespace App\Modules\Membership\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Modules\Membership\Models\FcmToken
 *
 * @property int $id
 * @property string $token_id
 * @property string $fcmable_type
 * @property int $fcmable_id
 * @property string $fcm_token
 * @property string|null $platform
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $fcmable
 * @property-read string $token
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereFcmToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereFcmableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereFcmableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereTokenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class FcmToken extends Model
{
  protected $fillable = [
    'token_id',
    'fcm_token',
  ];

  /*
     *
     */
  public static function boot()
  {
    parent::boot();

    self::creating(function ($model) {
      $platform = preg_match('/iOS/i', (string) (request()->server('HTTP_USER_AGENT') ? 'iOS' : 'Android'));

      $model->platform = $platform;
    });
  }

  public function getTokenAttribute(): string
  {
    return $this->fcm_token;
  }

  /**
   * @return MorphTo<Model, FcmToken>
   */
  public function fcmable(): MorphTo
  {
    return $this->morphTo();
  }
}
