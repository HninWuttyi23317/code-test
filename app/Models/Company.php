<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','logo','website'];

    //One to Many Relationship
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class,'foreign_key');
    }
}
