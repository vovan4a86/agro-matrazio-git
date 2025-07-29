<?php
namespace Fanky\Admin\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Thumb;

/**
 * Fanky\Admin\Models\MainSliderFeature
 *
 * @property int $id
 * @property int $main_slider_id
 * @property string $image
 * @property string $title
 * @property string $text
 * @property int $order
 * @property-read mixed $src
 * @method static Builder|GalleryItem whereMainSliderFeatureId($value)
 * @method static Builder|GalleryItem whereId($value)
 * @method static Builder|GalleryItem whereImage($value)
 * @method static Builder|GalleryItem whereOrder($value)
 * @mixin \Eloquent
 * @method static Builder|GalleryItem newModelQuery()
 * @method static Builder|GalleryItem newQuery()
 * @method static Builder|GalleryItem query()
 */
class MainSliderFeature extends Model
{

    protected $table = 'main_slider_features';

    protected $guarded = ['id'];

    public $timestamps = false;

    const UPLOAD_PATH = '/public/uploads/gallery/';
    const UPLOAD_URL = '/uploads/main_slider/feats/';

    public function main_slider(): BelongsTo
    {
        return $this->belongsTo(MainSlider::class);
    }

    public function getSrcAttribute($value)
    {
        return $this->image ? url(self::UPLOAD_URL . $this->image) : null;
    }

    public function thumb($thumb)
    {
        if (!$this->image) {
            return null;
        } else {
            $file = public_path(self::UPLOAD_URL . $this->image);
            $file = str_replace(['\\\\', '//'], DIRECTORY_SEPARATOR, $file);
            $file = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $file);

            if (!is_file(public_path(Thumb::url(self::UPLOAD_URL . $this->image, $thumb)))) {
                if (!is_file($file)) return null; //нет исходного файла
                //создание миниатюры
                if (is_array($this->gallery->params) && !empty($this->gallery->params['thumbs'])) {
                    $thumbs = $this->gallery->params['thumbs'];
                } else {
                    $thumbs = self::$thumbs;
                }
                Thumb::make(self::UPLOAD_URL . $this->image, $thumbs);

            }

            return url(Thumb::url(self::UPLOAD_URL . $this->image, $thumb));
        }
    }

    public function deleteImage()
    {
        if (!$this->image) return;
        @unlink(public_path(self::UPLOAD_URL . $this->image));
    }

    public static function uploadFile(UploadedFile $file): string
    {
        $upload_url_full = self::UPLOAD_URL;
        $file_name = md5(uniqid(rand(), true)) . '_' . time() . '.' . Str::lower($file->getClientOriginalExtension());
        $file->move(public_path($upload_url_full), $file_name);
        return $file_name;
    }
}
