<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
        'office',
        'form',
    ];
    

    // public function submittedRequirement() {
    //     return $this->hasOne(SubmittedRequirement::class, 'requirementId');
    // }

        public function submittedRequirements()
    {
        return $this->hasMany(SubmittedRequirement::class);
    }
    
    // In SetRequirement:
    public function submittedRequirement() {
        return $this->hasMany(SubmittedRequirement::class);
    }
}
