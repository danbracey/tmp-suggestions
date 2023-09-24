<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $guarded = [];
    /**public string $name;
    public mixed $short_description;
    public mixed $long_description;
    public int $created_by;
    public int $status;**/

    protected $table = 'suggestions';
    use HasFactory;

    public function getVotes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SuggestionVote::class, 'suggestion_id', 'id');
    }

    public function getSubmitter(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
