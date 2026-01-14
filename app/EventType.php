<?php

namespace App;

enum EventType : string
{
    case LEAGUE = "league";
    case CHAMPIONSHIP = "championship";
    case LEAGUE_AND_CHAMPIONSHIP = "league_and_championship";
}
