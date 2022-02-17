<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BindsDynamically;
class Prodi extends Model
{
    public $table = 'prd_jurusan';
    public $timestamps = false;
    protected $primaryKey = 'KodeJurusan';
    protected $keyType = 'string';


    protected $fillable = [
        'KodeJurusan', 'NamaJurusan',
    ];
}
