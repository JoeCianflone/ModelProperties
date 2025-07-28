<?php

use JoeCianflone\ModelProperties\ModelProperties;

uses()->group('model-properties');

// --- allCasts
test('it returns correct allCasts', function ($input, $expected) {
    $modelProps = new ModelProperties(
        fillable: $input['fillable'],
        guarded: $input['guarded']
    );

    expect($modelProps->allCasts)->toEqual($expected);
})->with('allCasts');

test('allCasts handles edge cases', function ($input, $expected) {
    $modelProps = new ModelProperties(
        fillable: $input['fillable'],
        guarded: $input['guarded']
    );

    expect($modelProps->allCasts)->toEqual($expected);
})->with('allCasts edge cases');

// --- defaultPropertyValues
test('it returns correct defaultPropertyValues', function ($input, $expected) {
    $modelProps = new ModelProperties(
        fillable: $input['fillable'],
        guarded: $input['guarded']
    );

    expect($modelProps->defaultPropertyValues)->toEqual($expected);
})->with('defaultPropertyValues');

test('defaultPropertyValues handles edge cases', function ($input, $expected) {
    $modelProps = new ModelProperties(
        fillable: $input['fillable'],
        guarded: $input['guarded']
    );

    expect($modelProps->defaultPropertyValues)->toEqual($expected);
})->with('defaultPropertyValues edge cases');

// --- fillableKeys
test('it returns correct fillableKeys', function ($input, $expected) {
    $modelProps = new ModelProperties(fillable: $input);

    expect($modelProps->fillableKeys)->toEqual($expected);
})->with('fillableKeys');

// --- guardedKeys
test('it returns correct guardedKeys', function ($input, $expected) {
    $modelProps = new ModelProperties(guarded: $input);

    expect($modelProps->guardedKeys)->toEqual($expected);
})->with('guardedKeys');

// --- primaryKeyData
test('it returns correct primaryKeyData', function ($input, $expected) {
    $modelProps = new ModelProperties(
        fillable: $input['fillable'],
        primary: $input['primary'],
    );

    expect($modelProps->primaryKeyData)->toEqual($expected);
})->with('primaryKeyData');

test('primaryKeyData falls back to int if type not found', function () {
    $modelProps = new ModelProperties(
        fillable: ['name' => 'string'],
        primary: ['uuid' => ['incrementing' => false]]
    );

    expect($modelProps->primaryKeyData)->toEqual([
        'key' => 'uuid',
        'incrementing' => false,
        'type' => 'int',
    ]);
});

test('it throws exception if primary key is not set', function () {
    $modelProps = new ModelProperties(
        fillable: ['id' => 'uuid'],
        primary: [],
    );

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('Primary Key not set');

    $modelProps->primaryKeyData;
});

// --- empty case
test('it handles fully empty constructor input', function () {
    $modelProps = new ModelProperties;

    expect($modelProps->fillableKeys)->toEqual([]);
    expect($modelProps->guardedKeys)->toEqual([]);
    expect($modelProps->defaultPropertyValues)->toEqual([]);
    expect($modelProps->allCasts)->toEqual([]);
    expect($modelProps->primaryKeyData)->toEqual([
        'key' => 'id',
        'incrementing' => true,
        'type' => 'int',
    ]);
});
