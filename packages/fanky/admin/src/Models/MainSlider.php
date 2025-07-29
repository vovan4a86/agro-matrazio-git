<?php namespace Fanky\Admin\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Fanky\Admin\Models\MainSlider
 *
 * @property int $id
 * @property string $text
 * @property string $name
 * @property string $url
 * @property string $image
 * @property int $order
 * @property-read Collection|MainSliderFeature[] $items
 * @property int|mixed $published
 * @method static Builder|Gallery whereId($value)
 * @method static Builder|Gallery whereName($value)
 * @method static Builder|Gallery whereOrder($value)
 * @mixin \Eloquent
 * @method static Builder|Gallery newModelQuery()
 * @method static Builder|Gallery newQuery()
 * @method static Builder|Gallery query()
 */
class MainSlider extends Model {

    use HasImage;

	protected $table = 'main_sliders';

	protected $guarded = ['id'];

	public $timestamps = false;

    public static $thumbs = [
        1 => '100x100',
        2 => '820x283',
        3 => '1920x660'
    ];

    const UPLOAD_URL = '/uploads/main_slider/';

    public function feats(): HasMany
    {
		return $this->hasMany(MainSliderFeature::class, 'main_slider_id')
            ->orderBy('order');
	}

    public function scopePublic($query) {
        return $query->where('published', 1);
    }

	public function getImageSrcAttribute(): ?string
    {
        if(!$this->image) return null;

        return self::UPLOAD_URL . $this->image;
    }

    public function getBadges(): array {
        $badges = explode(';', $this->badges);
        $result = [];
        if (count($badges)) {
            foreach ($badges as $badge) {
                $result[] = array_map('trim', explode(':', $badge));
            }
        }

        return $result;
    }

	public function delete() {
        foreach ($this->feats as $item){
            $item->deleteImage();
            $item->delete();
        }

		parent::delete();
	}
}
