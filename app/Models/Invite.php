<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

/**
 * App\Models\Invite
 *
 * @property int $id
 * @property string $email
 * @property int $project_id
 * @property int $inviter_id
 * @property string $key_confirm
 * @property int $is_confirmed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereInviterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereKeyConfirm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Invite extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'invites';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [];
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
