<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Helpers\Filesystem\CountriesFilesystem;

/**
 * Modules\Core\Entities\Country
 *
 * @property int $id
 * @property string $name
 * @property string $iso2_code
 * @property string $iso3_code
 * @property string $dial_code
 * @property string|null $currency_code
 * @property string|null $currency_name
 * @property string|null $currency_symbol
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencySymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDialCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso2Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso3Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $flag
 * @method static \Illuminate\Database\Query\Builder|Country onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Country withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Country withoutTrashed()
 */
class Country extends Model {
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = ["flag"];

    public function getFlagAttribute() {
        return CountriesFilesystem::flagUrl($this);
    }
}
