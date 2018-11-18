<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SeatBookType extends Enum
{
    const Held = 0;
    const Reserved = 1;
    const Booked = 2;
}
