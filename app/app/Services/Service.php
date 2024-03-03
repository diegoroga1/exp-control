<?php

namespace App\Services;

use App\Services\ModuleService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class Service
{
    protected static $model;

    public static function all(array $relations = null): Collection
    {
        return static::find(null, $relations);
    }

    public static function delete(int|array $condition): int
    {
        if (static::isNotAFieldsList($condition)) {
            return static::deleteById($condition);
        }

        return static::deleteByFields($condition);
    }

    public static function deleteSecure(): int
    {
        $params = func_get_args();

        return DB::transaction(fn () => static::delete(...$params));
    }

    public static function find(null|int|array $condition, array $relations = null): null|Model|Collection
    {
        if (is_null($condition)) {
            return static::findAll($relations);
        }

        return static::findByCondition($condition, $relations);
    }

    public static function update(array $fields, int|array $condition): Collection
    {
        $filter = static::parseUpsertFilter($condition);

        $models = static::instance()->where($filter)->get();

        foreach ($models as $model) {
            $model->update($fields);
        }

        return $models;
    }

    public static function updateSecure(): Collection
    {
        $params = func_get_args();

        return DB::transaction(fn () => static::update(...$params));
    }

    public static function save(array $fields, int|array $condition = null): Model
    {
        $filter = static::parseUpsertFilter($condition);

        return static::instance()->updateOrCreate($filter, $fields);
    }

    public static function saveSecure(): Model
    {
        $params = func_get_args();

        return DB::transaction(fn () => static::save(...$params));
    }

    protected static function deleteById(int|array $ids): int
    {
        return static::instance()->destroy($ids);
    }

    protected static function deleteByFields(array $condition): int
    {
        // Improvement
        // - call static::deleteById( $allRowsIdsAsArray ) instead of foreach with $row->delete()

        $total = 0;

        foreach (static::find($condition) as $row) {
            $total += $row->delete();
        }

        return $total;
    }

    protected static function findAll(?array $relations): Collection
    {
        return static::instance($relations)->get();
    }

    protected static function findByCondition(int|array $condition, ?array $relations): null|Model|Collection
    {
        if (is_int($condition)) {
            return static::findById($condition, $relations);
        }

        return static::findByFields($condition, $relations);
    }

    protected static function findByFields(array $fields, ?array $relations): Collection
    {
        return static::instance($relations)->where($fields)->get();
    }

    protected static function findById(int $id, ?array $relations): ?Model
    {
        return static::instance($relations)->find($id);
    }

    protected static function hasFieldNames(array $list): int
    {
        return count(array_filter(array_keys($list), 'is_string'));
    }

    protected static function hasWhereConditions(array $list): int
    {
        return count(array_filter(array_values($list), 'is_array'));
    }

    protected static function instance(array $relations = null): Model|Builder
    {
        $model = static::model();

        if ($relations) {
            return $model::with($relations);
        }

        return new $model;
    }

    protected static function isNotAFieldsList(int|array $data): bool
    {
        return is_int($data)
            || ! (
                static::hasFieldNames($data)
                || static::hasWhereConditions($data)
            );
    }

    protected static function model(): string
    {
        return static::$model ?? static::modelDiscover();
    }

    protected static function modelDiscover(): string
    {
        $parts = explode('\\', get_called_class());

        $modelName = static::modelName($parts);

        $namespace = static::modelNamespace($parts, $modelName);

        return "{$namespace}\\{$modelName}";
    }

    protected static function modelName(array $parts): string
    {
        return str_replace('Service', '', array_pop($parts));
    }

    protected static function modelNamespace(array $parts, string $model): string
    {
        $base = array_shift($parts);

        if ($base !== 'Modules') {
            return "{$base}\\Models";
        }

        $module = array_shift($parts);

        $moduleNamespace = "{$base}\\{$module}\\Entities";

        if (class_exists("{$moduleNamespace}\\{$model}")) {
            return $moduleNamespace;
        }

        return app()->getNamespace() .'Models';
    }

    protected static function moduleExists(string $name): bool
    {
        return ModuleService::isEnabled($name);
    }

    protected static function parseUpsertFilter(null|int|array $condition): array
    {
        return is_array($condition) ? $condition : [
            static::instance()->getKeyName() => $condition,
        ];
    }
}
