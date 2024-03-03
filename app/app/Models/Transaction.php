<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\TransactionInterface;

abstract class Transaction extends Model implements TransactionInterface
{
    protected $fillable = ['amount', 'description', 'date','hour', 'type','currency_id','category_id','subcategory_id'];


    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(Category::class,"subcategory_id");
    }
}
