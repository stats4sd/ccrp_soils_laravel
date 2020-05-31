<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Xlsform;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\Projectxlsform
 *
 * @property int $id
 * @property int $project_id
 * @property int $xlsform_id
 * @property string|null $kobo_version_id
 * @property int $records
 * @property string|null $kobo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $project
 * @property-read int|null $project_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Xlsform[] $xls_form
 * @property-read int|null $xls_form_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform whereDeployed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform whereKoboId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform whereRecords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Projectxlsform whereXlsformId($value)
 * @mixin \Eloquent
 */
class Projectxlsform extends Pivot
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'project_xlsform';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    public $incrementing = true;


    //protected $fillable = [];
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
    public function project()
    {
        return $this->belongsToMany(Project::class);
    }

    public function xls_form()
    {
        return $this->belongsToMany(Xlsform::class);
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
