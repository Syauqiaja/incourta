<?php

namespace App\Enums;

enum ScoreSource: string
{
    case REFEREE = "referee";
    case PLAYERS = "players";
    case SYSTEM = "system";
}
