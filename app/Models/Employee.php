<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','profile','company_id'];

    public function companies(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
