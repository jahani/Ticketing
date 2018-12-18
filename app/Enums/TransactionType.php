<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class TransactionType extends Enum implements LocalizedEnum
{
    const Default = 0;
    const Waiting = 1;
    const Cancelled = 2;
    const Finalized = 5;
}
