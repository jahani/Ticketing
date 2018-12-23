<?php

use App\Enums\{PublishType, OrderType};

return [

    PublishType::class => [
        PublishType::Draft => 'پیش‌نویس',
        PublishType::Unavailable => 'خارج از دسترس',
        PublishType::ComingSoon => 'به زودی',
        PublishType::Published => 'منتشر شده',
    ],

    OrderType::class => [
        OrderType::Default => 'پیش‌فرض',
        OrderType::Waiting => 'در انتظار',
        OrderType::Cancelled => 'لغو شده',
        OrderType::Finalized => 'نهایی',
    ],

];