<?php namespace Fanky\Admin\Controllers;

use Fanky\Admin\Models\MainSlider;
use Fanky\Admin\Models\MainSliderFeature;
use Request;
use Validator;
use DB;

class AdminMainSliderController extends AdminController {

    public function getIndex() {
        $main_slider = MainSlider::orderBy('order')->get();

        return view('admin::main_slider.main',
            ['main_slider' => $main_slider]
        );
    }

    public function getEdit($id = null) {
        if (!$id || !($slide = MainSlider::findOrFail($id))) {
            $slide = new MainSlider;
            $slide->published = 1;
        }

        return view('admin::main_slider.edit', [
            'slide' => $slide
        ]);
    }

    public function postSave(): array
    {
        $id = Request::input('id');
        $image = Request::file('image');
        $data = Request::except(['id']);

        if (!array_get($data, 'published')) {
            $data['published'] = 0;
        }

        // валидация данных
        $validator = Validator::make(
            $data,[]
        );
        if ($validator->fails()) {
            return ['errors' => $validator->messages()];
        }

        // Загружаем изображение
        if ($image) {
            $file_name = MainSlider::uploadImage($image);
            $data['image'] = $file_name;
        }

        // сохраняем страницу
        $slider = MainSlider::find($id);
        $redirect = false;
        if (!$slider) {
            $slider = MainSlider::create($data);
            $redirect = true;
        } else {
            if ($slider->image && isset($data['image'])) {
                $slider->deleteImage();
            }
            $slider->update($data);
        }

        if ($redirect) {
            return ['redirect' => route('admin.main-slider.edit', $slider->id)];
        } else {
            return ['msg' => 'Изменения сохранены.'];
        }
    }

    public function postDelete($id): array
    {
        $slider = MainSlider::findOrFail($id);
        $slider->delete();

        return ['success' => true];
    }

    public function postImageDelete($id): array
    {
        $slider = MainSlider::findOrFail($id);
        $slider->deleteImage();
        $slider->update(['image' => null]);

        return ['success' => true];
    }

    public function postReorder(): array
    {
        $sorted = Request::input('sorted', []);
        foreach ($sorted as $order => $id) {
            DB::table('main_slider')
                ->where('id', $id)
                ->update(array('order' => $order));
        }
        return ['success' => true];
    }

    public function postFeatsReorder(): array
    {
        $sorted = Request::input('sorted', []);
        foreach ($sorted as $order => $id) {
            DB::table('main_slider_items')
                ->where('id', $id)
                ->update(array('order' => $order));
        }
        return ['success' => true];
    }

    public function postFeatsUpload($id): array
    {
        $images = Request::file('images');
        $items = [];
        if ($images) {
            foreach ($images as $image) {
                $file_name = MainSliderFeature::uploadFile($image);
                $order = MainSliderFeature::where('main_slider_id', $id)->max('order') + 1;
                $item = MainSliderFeature::create(['main_slider_id' => $id, 'image' => $file_name, 'order' => $order]);
                $items[] = $item;
            }
        }

        $html = '';
        foreach ($items as $item) {
            $html .= view('admin::main_slider.image', ['item' => $item]);
        }

        return ['html' => $html];
    }

    public function postFeatDel($id): array
    {
        $item = MainSliderFeature::findOrFail($id);
        if ($item) {
            $item->deleteImage();
            $item->delete();
            return ['success' => true];
        }
        return ['success' => false, 'msg' => 'Изображение не найдено!'];
    }

    public function postFeatEdit($id)
    {
        $item = MainSliderFeature::findOrFail($id);
        return view('admin::main_slider.image_edit', ['item' => $item]);
    }

    public function postFeatSave($id): array
    {
        $item = MainSliderFeature::findOrFail($id);
        $data = Request::only(['title', 'text']);
        $item->update($data);

        return ['success' => true];
    }
}
