<?php

namespace App\Models;

use App\Models\ProjectXlsform;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectSubmission
 *
 * @property int $id
 * @property string $uuid
 * @property string $submitted_at
 * @property int $project_xlsform_id
 * @property mixed $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProjectXlsform $project_xlsform
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereProjectXlsformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereUuid($value)
 * @mixin \Eloquent
 */
class ProjectSubmission extends Model
{
    protected $table = 'project_submissions';
    protected $guarded = [];

    public function project_xlsform ()
    {
       return $this->belongsTo(ProjectXlsform::class, 'project_xlsform_id');
    }


}
