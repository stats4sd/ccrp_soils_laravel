<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class FarmerField extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'farmer_fields';

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function nutrient_balances()
    {
        return $this->hasMany(NutrientBalance::class);
    }

    public function project_submission()
    {
        return $this->belongsTo(ProjectSubmission::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
