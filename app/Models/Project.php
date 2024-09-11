<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Project extends Model
{
    use HasFactory, Searchable;

    public $timestamps = false;

    protected $fillable = [
        "company_id",
        'project_title',
        'project_description',
        'project_qualification',
        'project_skill',
        'job_type',
        'start_date',
        'end_date',
        'status'
    ];

    public function toSearchableArray()
    {
        return [
            'project_title' => $this->project_title,
            'project_description' => $this->project_description,
        ];
    }

    public function projectRole()
    {
        return $this->hasMany(projectRole::class);
    }
    public function role()
    {
        return $this->hasManyThrough(Role::class, ProjectRole::class, 'role_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
