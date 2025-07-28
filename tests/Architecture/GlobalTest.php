<?php

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();

arch('it enforces strict typing')
    ->expect('JoeCianflone\ModelProperties')
    ->toUseStrictTypes();

arch('Concerns folder are all traits')
    ->expect('JoeCianflone\ModelProperties\Concerns')
    ->toBeTraits();

arch('EloquentModelProperites implements only one contract')
    ->expect('JoeCianflone\ModelProperties\ModelProperties')
    ->toBeFinal();
