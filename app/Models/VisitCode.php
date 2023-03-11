<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitCode extends Model
{
    use HasFactory;
    protected $table = 'visit_code';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'id',
        'visit_code',
        'created_at',
        'updated_at'
    ]; 

}
