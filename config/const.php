<?php

return [
    'month_price' => '10',
    'refers_count' => 3,
    'algorithm' => [2.5,2.5,5,5,5,5,5,5,5], // Persents month payment
    'to_refer' => 50, // Persents month payment
    'ban_after_frizz' => 20, // DAYSwe
    'payment_period_seconds' => 60*60*24*30, // Payment period
    'lucky_steps' => [ // Persents month payment
        [172800,10,'1/3'],
        [172800,7.5,'2/3'],
        [259200,5,'3/3']
    ],
    'points_short_name' => 'PGC'
];
