<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoccerTicket extends Model
{
    use HasFactory;

    public function teams(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(SoccerTeam::class,  'soccer_team_soccer_ticket', 'soccer_team_id', 'soccer_ticket_id');

    }
}
