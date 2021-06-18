<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoccerTeam extends Model
{
    use HasFactory;

    public function tickets(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(SoccerTicket::class,'soccer_team_soccer_ticket', 'soccer_ticket_id', 'soccer_team_id');
    }

    protected $guarded = [];
}
