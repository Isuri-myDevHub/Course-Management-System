<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    protected $fillable = ['name', 'seo_url', 'faculty', 'category', 'status'];
    use HasFactory;


    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}

