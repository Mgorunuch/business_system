<?php

return [
    'refers_count' => 3,

    'points_short_name' => 'PGC',

    'month_price' => 10,
    'algorithm' => [2.5,2.5,5,5,5,5,5,5,5], // Persents month payment
    'to_refer' => 50, // Persents month payment
    'ban_after_frizz' => 20, // DAYSwe
    'payment_period_seconds' => 60*60*24*30, // Payment period
    'lucky_steps' => [ // Persents month payment
        [172800,10,'1/3'],
        [172800,7.5,'2/3'],
        [259200,5,'3/3']
    ],

    'internal_active_reffers' => 3,
    'external_active_reffers' => [
        'put'=>0,
        'withdraw'=>0
    ],
    'fees' => [
        'external_active_reffers' => [
            'withdraw' => [
                [3,1.5],
                [0,10]
            ]
        ],
        'internal_active_reffers' => [
            [3,0],
            [0,10]
        ]
    ]
];
