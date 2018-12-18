<?php

use App\Enums\PublishType;

return [

    PublishType::class => [
        PublishType::Draft => 'پیش‌نویس',
        PublishType::Unavailable => 'خارج از دسترس',
        PublishType::ComingSoon => 'به زودی',
        PublishType::Published => 'منتشر شده',
    ],

];