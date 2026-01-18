<?php

namespace App\Enums;

enum PlayerScoreStatus: string
{
    case PENDING = "pending";
    case APPROVED = "approved";
    case REJECTED = "rejected";
}
