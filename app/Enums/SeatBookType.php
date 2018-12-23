<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class SeatBookType extends Enum implements LocalizedEnum
{
    const Held = 1;
    const Reserved = 3;
    const Booked = 5;
}
