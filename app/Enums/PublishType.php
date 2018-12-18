<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class PublishType extends Enum implements LocalizedEnum
{
    const Draft = 0;
    const Unavailable = 1;
    const ComingSoon = 2;
    const Published = 5;
}
