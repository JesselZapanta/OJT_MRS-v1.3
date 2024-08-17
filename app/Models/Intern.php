<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;

    protected $table = 'interns'; // Replace 'schools' with your actual table name
    protected $fillable = [
        'userId', 
        'id_number', 
        'year_level', 
        'sex',
        'address',
        'contact_number',
        'date_of_birth',
        'place_of_birth',
        'age',
        'father',
        'father_occupation',
        'father_contact_no',
        'mother',
        'mother_occupation',
        'mother_contact_no',
        'guardian_address',
        'guardian_contact_no',
        'ojt_instructor',
        'instructor_contact_no',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
