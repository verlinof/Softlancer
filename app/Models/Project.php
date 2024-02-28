<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'project_title',
        'project_description',
        'owner',
        'status'
    ];

    public function projectRole()
    {
        return $this->hasMany(projectRole::class);
    }
}
