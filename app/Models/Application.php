<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "user_id",
        "project_id",
        "project_role_id",
        "cv_file",
        "portofolio",
        "application_role",
        "status",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function project()
    {
        return $this->belongsTo(Project::class, "project_id");
    }

    public function project_role()
    {
        return $this->belongsTo(ProjectRole::class, "project_role_id");
    }
}
