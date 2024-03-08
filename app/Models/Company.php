<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = "companies";
    public $timestamps = false;

    protected $fillable = [
        'company_name',
        'company_description',
        'company_logo'
    ];

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
