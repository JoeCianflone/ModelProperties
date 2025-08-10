<?php declare(strict_types=1);

namespace JoeCianflone\ModelProperties;

use Illuminate\Support\Collection;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class ModelProperties
{
    /** @var array<string,mixed> */
    public array $allCasts {
        get {
            return $this->allProperties->flatMap(function ($value, $key) {
                if (is_string($value)) {
                    return $value === 'string'
                        ? []
                        : [$key => $value];
                }
                if (is_array($value) && $value) {
                    return [$key => key($value)];
                }
            })->toArray();
        }
    }

    /** @var array<string,mixed> */
    public array $defaultPropertyValues {
        get {
            return collect($this->allProperties)
                ->flatMap(function ($v, $k) {
                    if (is_array($v)) {
                        $vkey = array_keys($v);
                        return [ $k => $v[$vkey[0]]];
                    }
                })->toArray();

        }
    }

    /** @var array<int, mixed> */
    public array $fillableKeys {
        get {
            return collect($this->fillable)->keys()->toArray();
        }
    }

    /** @var array<int, mixed> */
    public array $guardedKeys {
        get {
            return collect($this->guarded)->keys()->toArray();
        }
    }

    /** @var array<string, mixed> */
    public array $primaryKeyData {
        get {
            $key = collect($this->primary)->reject(function ($v, $k) {
                return $k === 'incrementing';
            })->keys()->toArray();

            if (count($key) <= 0) {
                throw new \Exception('Primary Key not set');
            }

            return [
                'key' => $key[0],
                'incrementing' => data_get($this->primary, 'incrementing', true),
                'type' => data_get($this->primary, $key[0], 'int'),
            ];
        }
    }

    /** @var Collection<string, mixed> */
    private Collection $allProperties {
        get {
            return collect([...$this->fillable, ...$this->guarded]);
        }
    }

    /**
     * @param  array<string, mixed>  $fillable
     * @param  array<string, mixed>  $guarded
     * @param  array<int, string>  $hidden
     * @param  array<int, string>  $visible
     * @param  array<string, mixed>  $primary
     */
    public function __construct(
        public array $fillable = [],
        public array $guarded = [],
        public array $hidden = [],
        public array $visible = [],
        public array $primary = ['id' => 'int', 'incrementing' => true],
        public ?bool $guardByDefault = null,
    ) {}
}
