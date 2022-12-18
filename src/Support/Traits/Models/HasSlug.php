<?php

namespace Support\Traits\Models;


use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static string $type = "";
    protected static array $slugsDuplicates = [];

    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            self::$type = get_class($model);
            $model->slug = $model->slug
                ?? str($model->{self::slugFrom()})
                    ->append(self::checkSlug($model))
                    ->slug();
        });
    }

    protected static function checkSlug(Model $model): string
    {
        $slug = str($model->{self::slugFrom()})->slug();
        $instance = (self::$type)::query()->where('slug', $slug->value())->get()->isEmpty();

        if (!$instance) {
            self::$slugsDuplicates[$slug->value()] = (self::$slugsDuplicates[$slug->value()] ?? 0) + 1;
            return '-' . self::$slugsDuplicates[$slug->value()];
        } else {
            return "";
        }
    }

    protected static function slugFrom(): string
    {
        return 'title';
    }
}
