<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Officer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\OfficerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Officer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Officer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Officer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Officer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Officer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Officer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Officer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Officer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Officer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Officer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Officer wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Officer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Officer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Officer withoutTrashed()
 * @mixin \Eloquent
 */
class Officer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guard = 'officer';

    protected $fillable = ['name', 'email', 'password', 'phone_number'];
}
