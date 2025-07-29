<?php namespace Fanky\Admin\Controllers;

use Fanky\Admin\Models\Brand;
use Request;
use Text;
use Validator;
use DB;

class AdminBrandsController extends AdminController {

	public function getIndex()
	{
		$brands = Brand::orderBy('order')->get();

		return view('admin::brands.main', ['brands' => $brands]);
	}

	public function getEdit($id = null)
	{
		if (!$id || !($brand = Brand::findOrFail($id))) {
			$brand = new Brand;
		}

		return view('admin::brands.edit', ['brand' => $brand]);
	}

	public function postSave(): array
    {
		$id = Request::input('id');
		$data = Request::except(['id', 'image']);
        $image = Request::file('image');

        if (!array_get($data, 'alias')) {
            $data['alias'] = Text::translit($data['name']);
        }
        if (!array_get($data, 'on_main')) $data['on_main'] = 0;
        if (!array_get($data, 'published')) $data['published'] = 0;

        $rules = [
            'name' => 'required'
        ];

        $rules['alias'] = $id
            ? 'required|unique:brands,alias,' . $id . ',id'
            : 'required|unique:brands,alias,null,id';
        // валидация данных
        $validator = Validator::make(
            $data,
            $rules
        );
        if ($validator->fails()) {
            return ['errors' => $validator->messages()];
        }

        // Загружаем изображение
        if ($image) {
            $file_name = Brand::uploadIcon($image);
            $data['image'] = $file_name;
        }

		// сохраняем страницу
		$brand = Brand::find($id);
        $redirect = false;
		if (!$brand) {
			$data['order'] = Brand::max('order') + 1;
			$brand = Brand::create($data);
            $redirect = true;
		} else {
            $brand->update($data);
		}
        if ($redirect) {
            return ['redirect' => route('admin.brands.edit', [$brand->id])];
        } else {
            return ['success' => true, 'msg' => 'Изменения сохранены'];
        }
	}

	public function postReorder(): array
    {
		$sorted = Request::input('sorted', []);
		foreach ($sorted as $order => $id) {
			DB::table('brands')->where('id', $id)
                ->update(array('order' => $order));
		}
		return ['success' => true];
	}

	public function postDelete($id): array
    {
		$brand = Brand::find($id);
        if (!$brand->product) {
            $brand->deleteImage();
            $brand->delete();
            return ['success' => true];
        } else {
            return [
                'success' => false,
                'msg' => 'Нельзя удалить бренд, если он принадлежит одному из товаров.'
            ];
        }
	}
}
