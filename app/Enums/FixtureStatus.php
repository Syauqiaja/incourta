<?php

namespace App\Enums;

enum FixtureStatus: string
{
    case SCHEDULED = "scheduled";
    case ONGOING = "ongoing";
    case FINISHED = "finished";
}
