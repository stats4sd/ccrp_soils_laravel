<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Invite
 *
 * @property int $id
 * @property string $email
 * @property int $inviter_id
 * @property int $project_id
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
 * @property-read mixed $invite_day
 * @property-read \App\Models\User $inviter
 * @property-read \App\Models\Project $project
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
    protected $guarded = ['id'];
    protected $casts = [
        'is_confirmed' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('unconfirmed', function (Builder $builder) {
            $builder->where('is_confirmed', false);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function confirm ()
    {
       $this->is_confirmed = 1;
       $this->save();

       return $this->is_confirmed;
    }

    public function getInviteDayAttribute ()
    {
       return Carbon::parse($this->created_at)
       ->locale(session()->get('locale'))
       ->toDayDateTimeString();

    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function project ()
    {
       return $this->belongsTo(Project::class);
    }

    public function inviter ()
    {
       return $this->belongsTo(User::class);
    }


}
