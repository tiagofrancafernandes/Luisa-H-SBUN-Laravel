<?php

namespace App\Enums;

enum RequestReturnStatus: int
{
    case PENDING = 1;
    case APPROVED = 2;
    case REJECTED = 3;
}
