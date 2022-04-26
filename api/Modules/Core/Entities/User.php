<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Core\Helpers\Filesystem\UserFilesystem;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Modules\Core\Entities\User
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $phone_number
 * @property string|null $phone_number_verified_at
 * @property string $password
 * @property string $type
 * @property float $balance
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumberVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Core\Entities\OtpCode[] $verifications
 * @property-read int|null $verifications_count
 */
class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
        'email_verified_at'         => 'datetime',
        'phone_number_verified_at'  => 'datetime',
        'balance'                  => 'double',
    ];

    public function getSlugOptions(): SlugOptions {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function getAvatarAttribute(): string {
        return UserFilesystem::getUserAvatar($this);
    }

    public function verifications() {
        return $this->morphMany(OtpCode::class, 'verifiable');
    }
}
