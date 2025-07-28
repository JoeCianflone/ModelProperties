<?php declare(strict_types=1);

namespace JoeCianflone\ModelProperties\Concerns;

use Crell\AttributeUtils\Analyzer;
use Illuminate\Support\Facades\Config;
use JoeCianflone\ModelProperties\ModelProperties;

trait HasModelProperties
{
    public function initializeHasModelProperties(): void
    {
        $properties = (new Analyzer)->analyze(__CLASS__, ModelProperties::class);

        $this->primaryKey = $properties->primaryKeyData['key'];
        $this->keyType = $properties->primaryKeyData['type'];
        $this->incrementing = $properties->primaryKeyData['incrementing'];

        $guardByDefault = is_null($properties->guardByDefault)
            ? Config::boolean('modelproperties.guard_by_default')
            : $properties->guardByDefault;

        $this->fillable($properties->fillableKeys);
        $this->guard(
            $guardByDefault
                ? ['*']
                : $properties->guardedKeys
        );

        $this->setHidden($properties->hidden);
        $this->setVisible($properties->visible);

        $this->mergeCasts($properties->allCasts);

        $this->attributes = $properties->defaultPropertyValues;
    }
}
