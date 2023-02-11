<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DubbingProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function translator()
    {
        return $this->belongsTo(Translator::class, 'translator_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


}
