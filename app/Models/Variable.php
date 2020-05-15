<?php

namespace App\Models;

use App\Models\Xlsform;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Variable
 *
 * @property int $id
 * @property int $xlsform_id
 * @property string $name
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Xlsform $xls_form
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Variable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Variable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Variable query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Variable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Variable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Variable whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Variable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Variable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Variable whereXlsformId($value)
 * @mixin \Eloquent
 */
class Variable extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'variables';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

   public function xls_form ()
   {
       return $this->belongsTo(Xlsform::class);
   }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
