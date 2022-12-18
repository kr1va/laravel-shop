<?php

namespace Domain\Product\Models;

use Domain\Product\Collections\OptionValueCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'option_id'
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function newCollection(array $models = []): OptionValueCollection
    {
        return new OptionValueCollection($models);
    }
}
