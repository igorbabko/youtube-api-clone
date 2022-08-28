<?php

namespace App\Traits;

trait WithRelationships
{
    public function scopeWithRelationships($query, $relationships)
    {
        return $query->with(static::validRelationships($relationships));
    }

    public function loadRelationships($relationships)
    {
        return $this->load(static::validRelationships($relationships));
    }

    private static function validRelationships($relationships): array
    {
        return collect($relationships)
            ->map(fn (string $relationships): array => explode('.', $relationships))
            ->filter(fn (array $relationships): bool => in_array($relationships[0], static::$relationships))
            ->map(fn (array $relationship): string => implode('.', $relationship))
            ->all();
    }
}
