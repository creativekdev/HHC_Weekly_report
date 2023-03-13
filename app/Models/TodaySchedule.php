<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodaySchedule extends Model
{
    use HasFactory;
    protected $table = 'today_schedule';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'id',
        'date',
        'patient_id',
        'visit_times',
        'visit_code',
        'visit_interval',
        'specific_time',
        'is_signed',         
        'sign_time',
        'sign_url',
        'issaved',
        'isrepeated',
        'isspecific_time',
        'created_at',
        'updated_at'
    ]; 
}
