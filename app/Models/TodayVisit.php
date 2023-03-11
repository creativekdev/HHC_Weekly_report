<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayVisit extends Model
{
    use HasFactory;
    protected $table = 'today_visit';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'id',
        'date',
        'patient_id',
        'schedule_id',
        'visit_code',
        'visit_interval',
        'is_signed',         
        'sign_time',
        'sign_url',
        'created_at',
        'updated_at'
    ]; 

}
