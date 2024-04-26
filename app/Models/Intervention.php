<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class Intervention extends Model
{
    use HasFactory,SoftDeletes;
    public $table = 'interventions';
    protected $dates = [
        'end_time',
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
        'date',
    ];
    const RECURRENCE_RADIO = [
        'none'    => 'None',
        'daily'   => 'Daily',
        'weekly'  => 'Weekly',
        'monthly' => 'Monthly',
    ];
    protected $fillable = ['client', 'date', 'personne', 'recurrence', 'start_time', 'end_time'];
    
    public function interventions()
    {
        return $this->hasMany(Intervention::class, 'intervention_id', 'id');
    }

   

    public function event()
    {
        return $this->belongsTo(Intervention::class, 'intervention_id');
    }

    public function saveQuietly(array $options = [])
    {
        return static::withoutEvents(function () {
            return $this->save();
        });
    }
    
}
