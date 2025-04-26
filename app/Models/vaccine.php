<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $table = 'vaccines';

    protected $fillable = [
        'name',
        'description',
        'recommended_age',
    ];

    // إذا كان هناك علاقة بلقاحات مخصصة لتذكير التطعيم، يمكنك إضافة:
    public function reminders()
    {
        return $this->hasMany(Notification::class);
    }
}
