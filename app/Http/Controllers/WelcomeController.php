<?php namespace App\Http\Controllers;

use Fanky\Admin\Models\Brand;
use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\MainSlider;
use Fanky\Admin\Models\ObjectItem;
use Fanky\Admin\Models\Page;
use Fanky\Admin\Models\Product;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class WelcomeController extends Controller {
    public function index() {
        /** @var Page $page */
        $page = Page::find(1);
        $page->ogGenerate();
        $page->setSeo();


        return response()->view('pages.index', [
            'page' => $page,
            'text' => $page->text,
            'h1' => $page->getH1(),
        ]);
    }
}
