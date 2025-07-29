<?php namespace Fanky\Admin\Controllers;

use Fanky\Admin\Models\Publication;
use Illuminate\Support\Str;
use Pagination;
use Request;
use Validator;
use Text;
use Fanky\Admin\Models\News;

class AdminPublicationsController extends AdminController {

	public function getIndex() {
        $publications = Pagination::init(new Publication, 20)->orderBy('date', 'desc')->get();

		return view('admin::publications.main', ['publications' => $publications]);
	}

	public function getEdit($id = null) {
		if (!$id || !($publication = Publication::find($id))) {
			$publication = new Publication;
			$publication->date = date('Y-m-d');
            $publication->published = 1;
            $publication->on_main = 1;
		}

		return view('admin::publications.edit', compact('publication'));
	}

	public function postSave() {
		$id = Request::input('id');
		$data = Request::except(['id', 'image']);
		$image = Request::file('image');

		if (!array_get($data, 'alias')) $data['alias'] = Text::translit($data['name']);
		if (!array_get($data, 'title')) $data['title'] = $data['name'];
		if (!array_get($data, 'published')) $data['published'] = 0;

		$validator = Validator::make(
			$data,[
				'name' => 'required',
				'date' => 'required',
			]);
		if ($validator->fails()) {
			return ['errors' => $validator->messages()];
		}

		// Загружаем изображение
		if ($image) {
			$file_name = Publication::uploadImage($image);
			$data['image'] = $file_name;
		}

		// сохраняем страницу
		$publication = Publication::find($id);
		$redirect = false;
		if (!$publication) {
			$publication = Publication::create($data);
			$redirect = true;
		} else {
			if ($publication->image && isset($data['image'])) {
				$publication->deleteImage();
			}
			$publication->update($data);
		}

		if($redirect){
			return ['redirect' => route('admin.publications.edit', [$publication->id])];
		} else {
			return ['msg' => 'Изменения сохранены.'];
		}

	}

	public function postDelete($id) {
		$publication = Publication::find($id);
        $publication->deleteImage();
		$publication->delete();

		return ['success' => true];
	}

	public function postDeleteImage($id) {
		$publication = Publication::find($id);
		if(!$publication) return ['error' => 'publication_not_found'];

		$publication->deleteImage();
		$publication->update(['image' => null]);

		return ['success' => true];
	}
}
