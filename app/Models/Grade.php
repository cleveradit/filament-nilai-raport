<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'subject_id',
        'nilai',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
            // ->logAll()
            ->logOnly(['user_id', 'subject_id', 'nilai']) // Field yang ingin dicatat
            // ->logOnlyDirty() // Hanya catat jika ada perubahan
            ->dontSubmitEmptyLogs();
    }

}
