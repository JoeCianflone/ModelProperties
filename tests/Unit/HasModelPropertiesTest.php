<?php

// use Illuminate\Database\Eloquent\MassAssignmentException;
// use Illuminate\Database\Eloquent\Model;
// use JoeCianflone\ModelProperties\Concerns\HasModelProperties;
// use JoeCianflone\ModelProperties\ModelProperties;

// #[ModelProperties(
//     fillable: ['uuid' => 'string', 'name' => 'string', 'email' => ['string' => 'default@example.com']],
//     guarded: ['password' => 'hashed'],
//     hidden: ['password'],
//     visible: ['name', 'email'],
//     primary: ['uuid' => ['incrementing' => false]],
//     guardByDefault: false
// )]
// class DummyModel extends Model
// {
//     use HasModelProperties;
// }

// test('HasModelProperties configures model properties correctly', function () {
//     $model = new DummyModel;

//     expect($model->getKeyName())->toBe('uuid');
//     expect($model->getKeyType())->toBe('string');
//     expect($model->incrementing)->toBeFalse();

//     // Check casts
//     expect($model->getCasts())->toMatchArray([
//         'email' => 'string',
//         'password' => 'hashed',
//     ]);

//     // Check visibility
//     $array = $model->toArray();
//     expect($array)->toHaveKeys(['name', 'email']);
//     expect($array)->not->toHaveKey('password');

//     // Check default attributes
//     expect($model->getAttributes())->toMatchArray(['string' => 'default@example.com']);
// });

// test('fillable attributes can be mass assigned', function () {
//     $model = new DummyModel;
//     $model->fill(['name' => 'Joe']);

//     expect($model->name)->toBe('Joe');
// });

// test('guarded attributes throw MassAssignmentException', function () {
//     $model = new DummyModel;

//     $this->expectException(MassAssignmentException::class);
//     $model->fill(['password' => 'secret']);
// });
