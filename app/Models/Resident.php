<?php

namespace App\Models;
use App\Enums\ResidentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Resident extends Model
{
    /** @use HasFactory<\Database\Factories\ResidentFactory> */
    use HasFactory;
        use SoftDeletes;
    protected $fillable = ['name','email','address','phone','gender','status'];

}
