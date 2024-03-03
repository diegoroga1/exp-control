<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Transaction
{
    const TYPE = 'income';
    protected $table = "transactions";
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['type'] = 'income';
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', 'income');
        });
    }
    public function getType(): string
    {
        return self::TYPE;
    }
}
