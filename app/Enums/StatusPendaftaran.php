<?php

namespace App\Enums;

enum StatusPendaftaran: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
}