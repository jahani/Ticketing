<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionType extends Enum
{
    const Default = 0;
    const Waiting = 1;
    const Cancelled = 2;
    const Finalized = 5;
}
