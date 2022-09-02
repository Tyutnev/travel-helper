<?php

return [
    'secret_key'         => env('JWT_SECRET_KEY'),
    'expire_time'        => env('EXPIRE_TIME_SECOND'),
    'jwt_hash_algorithm' => env('JWT_HASH_ALGORITHM'),
];
