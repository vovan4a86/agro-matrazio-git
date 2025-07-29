<?php

namespace Fanky\Admin\Models;

use App\Traits\HasH1;
use App\Traits\HasImage;
use App\Traits\HasSeo;
use App\Traits\OgGenerate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static whereValue(string $brand)
 * @method static public ()
 * @method static wherePublished(int $int)
 */
class Brand extends Model
{
    use HasImage, HasH1, OgGenerate, HasSeo;

    protected $guarded = ['id'];

    public $timestamps = false;

    const UPLOAD_URL = '/uploads/brands/';

    public static array $thumbs = [
        1 => '100x100', //admin
        2 => '210x140', //list item
        3 => '160x51', //brands item
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getUrlAttribute(): string {
        return route('brands.item', ['alias' => $this->alias]);
    }

    public function scopePublic($query) {
        return $query->where('published', 1);
    }
}
