<?php

namespace App\Enums;

enum TransportType: string
{
    case TRAILER = 'trailer';
    case TRUCK = 'truck';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
