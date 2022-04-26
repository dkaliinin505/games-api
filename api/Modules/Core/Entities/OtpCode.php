<?php

namespace Modules\Core\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Enum\Security\OtpTypes;

/**
 * Modules\Core\Entities\OtpCode
 *
 * @property int $id
 * @property int $code
 * @property string $verifiable_type
 * @property int $verifiable_id
 * @property string $type
 * @property int $is_used
 * @property string $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $verifiable
 * @method static Builder|OtpCode newModelQuery()
 * @method static Builder|OtpCode newQuery()
 * @method static Builder|OtpCode query()
 * @method static Builder|OtpCode whereCode($value)
 * @method static Builder|OtpCode whereCreatedAt($value)
 * @method static Builder|OtpCode whereExpiredAt($value)
 * @method static Builder|OtpCode whereId($value)
 * @method static Builder|OtpCode whereIsUsed($value)
 * @method static Builder|OtpCode whereType($value)
 * @method static Builder|OtpCode whereUpdatedAt($value)
 * @method static Builder|OtpCode whereVerifiableId($value)
 * @method static Builder|OtpCode whereVerifiableType($value)
 * @mixin \Eloquent
 * @method static Builder|OtpCode active()
 * @method static Builder|OtpCode ofType(\Modules\Core\Enum\Security\OtpTypes $objType)
 * @method static Builder|OtpCode notUsed()
 */
class OtpCode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function verifiable() {
        return $this->morphTo();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query): Builder {
        return $query->where("expired_at", ">", Carbon::now());
    }

    public function scopeOfType(Builder $query, OtpTypes $objType): Builder {
        return $query->where("type", $objType->value);
    }

    public function scopeNotUsed(Builder $query): Builder {
        return $query->where("is_used", false);
    }
}
