<?php namespace App\Http\Controllers;

use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\Page;
use S;

class WelcomeController extends Controller {
    public function index() {
        /** @var Page $page */
        $page = Page::find(1);
        $page->ogGenerate();
        $page->setSeo();

        $main_slider = S::get('main_slider');
        $main_categories = Catalog::where('parent_id',0)
            ->where('on_main',1)
            ->get();

        $main_about = S::get('main_about');
        $main_features = S::get('main_features');

        return response()->view('pages.index', [
            'page' => $page,
            'text' => $page->text,
            'h1' => $page->getH1(),
            'main_slider' => $main_slider,
            'main_categories' => $main_categories,
            'main_about' => $main_about,
            'main_features' => $main_features,
        ]);
    }
}
