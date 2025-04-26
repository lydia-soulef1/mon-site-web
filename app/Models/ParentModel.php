<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ParentModel extends Authenticatable
{
    use HasFactory;

    // Specify the table name (optional, only if it doesn't follow Laravel's naming conventions)
    protected $table = 'parents'; // Change to your actual table name if needed

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Optionally, you can define hidden fields (password and other sensitive information)
    protected $hidden = [
        'password',
    ];


    // Define the relationship with children (if applicable)
    public function children()
    {
        return $this->hasMany(Child::class); // assuming there is a Child model
    }

    // Define the relationship with notifications (if applicable)
    public function notifications()
    {
        return $this->hasMany(Notification::class); // assuming there is a Notification model
    }

    // Optionally, you could define additional methods or scopes
}
