<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $guarded = [];
    public string $name;
    public mixed $short_description;
    public mixed $long_description;
    public int $created_by;
    public int $status;

    protected $table = 'suggestions';
    use HasFactory;
}
