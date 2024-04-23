<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "company_id",
        'project_title',
        'project_description',
        'project_qualification',
        'project_skill',
        'job_type',
        'status'
    ];

    public function projectRole()
    {
        return $this->hasMany(projectRole::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
