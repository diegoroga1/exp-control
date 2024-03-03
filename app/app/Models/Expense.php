<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Transaction
{

    protected $table = "transactions";
    const TYPE = 'expense';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['type'] = 'expense';
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', 'expense');
        });
    }
    public function getType(): string
    {
        return self::TYPE;
    }
}
