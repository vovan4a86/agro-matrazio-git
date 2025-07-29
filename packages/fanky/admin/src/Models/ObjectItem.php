<?php namespace Fanky\Admin\Models;

use App\Classes\SiteHelper;
use App\Traits\HasH1;
use App\Traits\HasImage;
use App\Traits\HasSeo;
use App\Traits\OgGenerate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Fanky\Admin\Models\ObjectItem
 *
 * @property int                 $id
 * @property int                 $published
 * @property string|null         $date
 * @property string              $name
 * @property string              $city
 * @property string|null         $announce
 * @property string|null         $text
 * @property string              $image
 * @property string              $alias
 * @property string              $title
 * @property string              $keywords
 * @property string              $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null         $deleted_at
 * @property-read mixed          $image_src
 * @property-read mixed          $url
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|ObjectItem onlyTrashed()
 * @method static Builder|ObjectItem public ()
 * @method static bool|null restore()
 * @method static Builder|ObjectItem whereAlias($value)
 * @method static Builder|ObjectItem whereAnnounce($value)
 * @method static Builder|ObjectItem whereCreatedAt($value)
 * @method static Builder|ObjectItem whereDate($value)
 * @method static Builder|ObjectItem whereDeletedAt($value)
 * @method static Builder|ObjectItem whereDescription($value)
 * @method static Builder|ObjectItem whereId($value)
 * @method static Builder|ObjectItem whereImage($value)
 * @method static Builder|ObjectItem whereKeywords($value)
 * @method static Builder|ObjectItem whereName($value)
 * @method static Builder|ObjectItem wherePublished($value)
 * @method static Builder|ObjectItem whereText($value)
 * @method static Builder|ObjectItem whereTitle($value)
 * @method static Builder|ObjectItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ObjectItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ObjectItem withoutTrashed()
 * @mixin \Eloquent
 * @property string $h1
 * @property string|null $og_title
 * @property string|null $og_description
 * @property-read \Illuminate\Database\Eloquent\Collection|\Fanky\Admin\Models\NewsTag[] $tags
 * @method static Builder|ObjectItem newModelQuery()
 * @method static Builder|ObjectItem newQuery()
 * @method static Builder|ObjectItem query()
 * @method static Builder|ObjectItem whereH1($value)
 * @method static Builder|ObjectItem whereOgDescription($value)
 * @method static Builder|ObjectItem whereOgTitle($value)
 */
class ObjectItem extends Model {

	use HasImage, HasH1, OgGenerate, HasSeo;

	protected $table = 'our_objects';

	protected $guarded = ['id'];

	const UPLOAD_URL = '/uploads/our_objects/';
    const NO_IMAGE = '/adminlte/no_image.png';

	public static $thumbs = [
		1 => '190x100', //admin
		2 => '458x306', //objects_list
	];

    public function images(): HasMany
    {
        return $this->hasMany(ObjectImage::class, 'our_object_id', 'id')
            ->orderBy('order');
    }

	public function scopePublic($query) {
		return $query->where('published', 1);
	}

	public function scopeOnMain($query) {
		return $query->where('on_main', 1);
	}

	public function getUrlAttribute($value): string
    {
		return route('objects.item', ['id' => $this->id]);
	}

	public function dateFormat($format = 'd.m.Y'): array|string|null
    {
		if (!$this->date) return null;
		$date =  date($format, strtotime($this->date));
		$date = str_replace(array_keys(SiteHelper::$monthRu),
			SiteHelper::$monthRu, $date);

		return $date;
	}
}
