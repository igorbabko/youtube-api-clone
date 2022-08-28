<?php

namespace App\Traits;

trait WithRelationships
{
    public function scopeWithRelationships($query, array|string $relationships)
    {
        $validRelationships = collect($relationships)
            ->map(fn (string $relationships): array => explode('.', $relationships))
            ->filter(fn (array $relationships): bool => in_array($relationships[0], static::$relationships))
            ->map(fn (array $relationships): string => implode('.', $relationships))
            ->all();

        return $query->with($validRelationships);
    }
}
