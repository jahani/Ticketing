<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class SeatBookType extends Enum implements LocalizedEnum
{
    const Held = 0;
    const Reserved = 1;
    const Booked = 2;
}
