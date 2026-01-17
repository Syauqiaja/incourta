<?php

namespace App\Enums;

enum EventStatus : string
{
    case DRAFT = 'draft';
    case UPCOMING = 'upcoming';
    case REGISTRATION_OPEN = 'registration_open';
    case REGISTRATION_CLOSED = 'registration_closed';
    case ONGOING = 'ongoing';
    case COMPLETED = 'completed';
}
