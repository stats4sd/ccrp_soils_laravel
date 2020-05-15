<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QrCode
 *
 * @property int $id
 * @property string $code
 * @property string|null $farm_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereFarmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QrCode extends Model
{
    protected $table = "barcodes";
    protected $guarded = ['id'];


}
