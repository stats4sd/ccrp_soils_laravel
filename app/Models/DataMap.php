<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DataMap
 *
 * @property string $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Xlsform[] $xls_forms
 * @property-read int|null $xls_forms_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DataMap extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'data_maps';

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $guarded = [];

    protected $casts = [
        'variables' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function xls_forms ()
    {
       return $this->hasMany(Xlsform::class);
    }



}
