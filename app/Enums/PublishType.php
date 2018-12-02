<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PublishType extends Enum
{
    const Draft = 0;
    const Unavailable = 1;
    const ComingSoon = 2;
    const Published = 5;
}
