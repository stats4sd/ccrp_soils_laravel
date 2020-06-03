<?php

namespace App\Models;

use App\Models\Project;
use App\Models\ProjectXlsform;
use App\Models\Xlsform;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Submission
 *
 * @property int $id
 * @property string $uuid
 * @property int $project_id
 * @property int $xlsform_id
 * @property mixed $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Xlsform $xls_form
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereXlsformId($value)
 * @mixin \Eloquent
 */
class Submission extends Model
{

    protected $table = 'submissions';
    protected $guarded = [];


    public function xls_form ()
    {
        return $this->belongsTo(Xlsform::class);
    }
}
