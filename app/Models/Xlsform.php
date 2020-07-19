<?php

namespace App\Models;

use App\Models\Submission;
use App\Models\Variable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Xlsform
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $file
 * @property string $version
 * @property string|null $kobo_version_id
 * @property string|null $instance_name
 * @property string|null $link_page
 * @property string|null $description
 * @property array|null $media
 * @property mixed|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Submission[] $submissions
 * @property-read int|null $submissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Variable[] $variables
 * @property-read int|null $variables_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereFormTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereInstanceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereLinkPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform wherePathFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereVersionId($value)
 * @mixin \Eloquent
 * @property string|null $xlsfile
 * @property string|null $kobo_id
 * @property int $live If true, this form is available to projects to use
 * @property string|null $enketo_url
 * @property int $is_active If true, the form is active on Kobotools
 * @property string $data_map_id
 * @property-read \App\Models\DataMap $data_map
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectXlsform[] $project_xlsforms
 * @property-read int|null $project_xlsforms_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereDataMapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereEnketoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereKoboId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereKoboVersionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereLive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereXlsfile($value)
 */
class Xlsform extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'xlsforms';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    //protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'media' => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function projects ()
    {
        return $this->belongsToMany(Project::class)->using(ProjectXlsform::class)
        ->withPivot([
            'kobo_id',
            'kobo_version_id',
            ]);
    }

    public function project_xlsforms ()
    {
       return $this->hasMany(ProjectXlsform::class);
    }

    public function private_project ()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function submissions ()
    {
        return $this->hasMany(Submission::class);
    }

    public function data_map ()
    {
       return $this->belongsTo(DataMap::class);
    }



    public function setXlsfileAttribute($value)
    {
        $attribute_name = "xlsfile";
        $disk = "public";
        $destination_path = "xlsforms/".time();


        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function uploadFileToDisk($value, $attribute_name, $disk, $destination_path)
    {
        $request = \Request::instance();

        // if a new file is uploaded, delete the file from the disk
        if ($request->hasFile($attribute_name) &&
            $this->{$attribute_name} &&
            $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if the file input is empty, delete the file from the disk
        if (is_null($value) && $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }
        // if a new file is uploaded, store it on disk and its filename in the database
        if ($request->hasFile($attribute_name) && $request->file($attribute_name)->isValid()) {
            // 1. Generate a new file name
            $file = $request->file($attribute_name);
            //$new_file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $new_file_name = $file->getClientOriginalName();

            // 2. Move the new file to the correct path
            $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

            // 3. Save the complete path to the database
            $this->attributes[$attribute_name] = $file_path;

        }
    }

    //Mutator for media files

    public function setMediaAttribute($value)
    {
        $attribute_name = "media";
        $disk = "public";
        $destination_path = "media/".time();

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }

     public function uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path)
    {
        $request = \Request::instance();
        if (! is_array($this->{$attribute_name})) {
            $attribute_value = json_decode($this->{$attribute_name}, true) ?? [];
        } else {
            $attribute_value = $this->{$attribute_name};
        }
        $files_to_clear = $request->get('clear_'.$attribute_name);

        // if a file has been marked for removal,
        // delete it from the disk and from the db
        if ($files_to_clear) {
            foreach ($files_to_clear as $key => $filename) {
                \Storage::disk($disk)->delete($filename);
                $attribute_value = array_where($attribute_value, function ($value, $key) use ($filename) {
                    return $value != $filename;
                });
            }
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if ($request->hasFile($attribute_name)) {
            foreach ($request->file($attribute_name) as $file) {
                if ($file->isValid()) {

                    // 1. Move the new file to the correct path with the original name
                    $file_path = $file->storeAs($destination_path,$file->getClientOriginalName(), $disk);

                    // 2. Add the public path to the database
                    $attribute_value[] = $file_path;
                }
            }
        }

        $this->attributes[$attribute_name] = json_encode($attribute_value);
    }



}
