<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Specify the table name (optional, only if it doesn't follow Laravel's naming conventions)
    protected $table = 'vaccination_reminders';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'child_id',
        'vaccine_id',
        'reminder_date',
        'status',
    ];

    // Define the relationship with the Parent model
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    // You can define additional methods or scopes as needed
}
