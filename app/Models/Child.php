<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    // Specify the table name (optional, only if it doesn't follow Laravel's naming conventions)
    protected $table = 'children'; // Change to your actual table name if needed

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'parent_id',
        'name',
        'dob', // date of birth
        'gender',
    ];
    protected $dates = ['dob'];

    // Define the relationship with the Parent model
    public function parent()
    {
        return $this->belongsTo(ParentModel::class); // each child belongs to one parent
    }

    // Define the relationship with the vaccinations (if applicable)
    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class); // assuming there is a Vaccination model
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // You can define additional methods or scopes as needed
}
