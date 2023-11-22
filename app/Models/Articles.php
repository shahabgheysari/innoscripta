<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Articles extends Model
{
    use HasFactory;
    protected $fillable = ['update_at','created_at'];

    public function articleCategory(): BelongsTo
    {
        return $this->belongsTo(ArticleCategories::class);
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Sources::class);
    }

    protected function getCategoryTitle():Attribute
    {
        return Attribute::make(
            get: fn (ArticleCategories $value) => $value->title
        );
    }


}
