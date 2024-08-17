<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies'; 
    protected $fillable = [
        'userId', 
        'company_name', 
        'company_address', 
        'company_contact_number', 
        'date_of_application', 
        'position', 
        'schedule', 
        'start_date', 
        'end_date', 
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
