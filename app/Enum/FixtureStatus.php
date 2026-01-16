<?php

namespace App\Enum;

enum FixtureStatus: string
{
    case SCHEDULED = "scheduled";
    case ONGOING = "ongoing";
    case FINISHED = "finished";
}
