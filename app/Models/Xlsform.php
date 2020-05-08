<?php

namespace App\Models;

use App\Models\Submission;
use App\Models\Variable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

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
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function projects ()
    {
        return $this->belongsToMany(Project::class)->using(Projectxlsform::class)
        ->withPivot([
            'kobo_id',
            'deployed',
            'records',
            ]);
    }

    public function submissions ()
    {
        return $this->hasMany(Submission::class);
    }

    public function variables ()
    {
        return $this->hasMany(Variable::class);
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
    public function setPathFileAttribute($value)
    {
        $attribute_name = "path_file";
        $disk = "uploads";
        $destination_path = "xlsforms";


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
        $disk = "uploads";
        $destination_path = "media";

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
