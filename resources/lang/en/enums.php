<?php

use App\Enums\PublishType;

return [

    PublishType::class => [
        PublishType::Draft => 'draft',
        PublishType::Unavailable => 'unavailable',
        PublishType::ComingSoon => 'coming soon',
        PublishType::Published => 'published',
    ],

];