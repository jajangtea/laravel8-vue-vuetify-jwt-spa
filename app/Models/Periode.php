<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BindsDynamically;
class Periode extends Model
{
    public $table = 'prd_periode';
    public $timestamps = false;
    protected $primaryKey = 'idPeriode';


    protected $fillable = [
        'idPeriode', 'tglPeriode',
    ];
}
