<?php

namespace App\Enums;

enum AppealStatus: string
{
    // ['open', 'under_review', 'resolved']
    case OPEN = "open";
    case UNDER_REVIEW = "under_review";
    case RESOLVED = "resolved";
}
