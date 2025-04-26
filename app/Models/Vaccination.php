<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    // تحديد اسم الجدول
    protected $table = 'vaccinations';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'child_id',
        'vaccine_id',
        'date_administered',
        'pediatrician_id',
    ];

    // العلاقة مع جدول الأطفال
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    // العلاقة مع جدول اللقاحات
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    // العلاقة مع جدول الأطباء
    public function pediatrician()
    {
        return $this->belongsTo(Pediatrician::class);
    }
}
