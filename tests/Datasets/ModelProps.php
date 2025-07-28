<?php

dataset('allCasts', [
    'basic casts' => [
        [
            'fillable' => [
                'name' => 'string',
                'created_at' => 'datetime',
                'settings' => ['json' => []],
            ],
            'guarded' => [
                'password' => 'hashed',
                'profile' => ['array' => []],
            ],
        ],
        [
            'created_at' => 'datetime',
            'settings' => 'json',
            'password' => 'hashed',
            'profile' => 'array',
        ],
    ],
]);

dataset('allCasts edge cases', [
    'empty fillable and guarded' => [
        ['fillable' => [], 'guarded' => []],
        [],
    ],
    'only "string" values (should be ignored)' => [
        ['fillable' => ['foo' => 'string'], 'guarded' => ['bar' => 'string']],
        [],
    ],
    'nulls and non-castables' => [
        ['fillable' => ['a' => null, 'b' => 123], 'guarded' => ['c' => true]],
        [],
    ],
    'nested array structure' => [
        ['fillable' => ['a' => ['json' => ['nested' => ['x' => 1]]]], 'guarded' => []],
        ['a' => 'json'],
    ],
]);

dataset('defaultPropertyValues', [
    'with defaults' => [
        [
            'fillable' => [
                'name' => 'string',
                'active' => ['bool' => true],
            ],
            'guarded' => [
                'meta' => ['json' => ['foo' => 'bar']],
            ],
        ],
        [
            'bool' => true,
            'json' => ['foo' => 'bar'],
        ],
    ],
]);

dataset('defaultPropertyValues edge cases', [
    'no arrays in fillable/guarded' => [
        ['fillable' => ['name' => 'string'], 'guarded' => ['x' => 'int']],
        [],
    ],
    'only empty arrays' => [
        ['fillable' => ['a' => []], 'guarded' => ['b' => []]],
        [],
    ],
    'deep structure arrays' => [
        [
            'fillable' => ['settings' => ['json' => ['foo' => 'bar']]],
            'guarded' => ['flags' => ['array' => [true]]],
        ],
        ['json' => ['foo' => 'bar'], 'array' => [true]],
    ],
]);

dataset('fillableKeys', [
    'standard fillable' => [
        ['title' => 'string', 'slug' => 'string'],
        ['title', 'slug'],
    ],
]);

dataset('guardedKeys', [
    'guarded fields' => [
        ['password' => 'hashed', 'api_token' => 'string'],
        ['password', 'api_token'],
    ],
]);

dataset('primaryKeyData', [
    'custom primary key' => [
        [
            'fillable' => ['id' => 'uuid'],
            'primary' => ['id' => ['incrementing' => false]],
        ],
        [
            'key' => 'id',
            'incrementing' => false,
            'type' => 'uuid',
        ],
    ],
]);
