<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmittedRequirement extends Model
{
    use HasFactory;
    protected $table = 'submitted_requirements';
    protected $fillable = [
        'userId',
        'requirementId',
        'institute',
        'status',
        'comment',
        'file',
    ];

    
    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function setRequirement() {
        return $this->belongsTo(SetRequirement::class, 'requirementId');
    }
    
}
