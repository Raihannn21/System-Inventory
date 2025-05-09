<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Commodity
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity withoutTrashed()
 * @mixin \Eloquent
 */
class Commodity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['commodity_code','name','quantity'];
}
