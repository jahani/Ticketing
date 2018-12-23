<?php

use App\Enums\{PublishType, OrderType};

return [

    PublishType::class => [
        PublishType::Draft => 'draft',
        PublishType::Unavailable => 'unavailable',
        PublishType::ComingSoon => 'coming soon',
        PublishType::Published => 'published',
    ],
    
    OrderType::class => [
        OrderType::Default => 'default',
        OrderType::Waiting => 'waiting',
        OrderType::Cancelled => 'cancelled',
        OrderType::Finalized => 'finalized',
    ],

];