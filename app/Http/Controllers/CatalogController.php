<?php
namespace App\Http\Controllers;

use App\Classes\SiteHelper;
use Cache;
use Doctrine\DBAL\Query\QueryBuilder;
use Fanky\Admin\Models\Brand;
use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\Page;
use Fanky\Admin\Models\Product;
use Fanky\Admin\Models\SearchIndex;
use Fanky\Admin\Settings;
use Fanky\Auth\Auth;
use S;
use SEOMeta;
use Session;
use Request;
use View;

class CatalogController extends Controller
{

    public function index()
    {
        $page = Page::where('alias', 'catalog')->first();
        if (!$page) {
            return abort(404);
        }
        $bread = $page->getBread();
        $page->h1 = $page->getH1();
        $page->setSeo();

        if (!$per_page = session('per_page')) {
            $per_page = 6;
            session(['per_page' => $per_page]);
        }

        $categories = Catalog::getTopLevelOnList();

        $products_ids = Product::public()
            ->pluck('id')
            ->all();

        $filter_data = request()->except(['page', 'brand', 'price_from', 'price_to']);
        $filter_brand = request()->only('brand');
        $filter_price_from = request()->get('price_from');
        $filter_price_to = request()->get('price_to');

        $products_query = Product::whereIn('id', $products_ids)
            ->public();

        if ($filter_price_from && $filter_price_to) {
            $products_query = $products_query
                ->where('price', '>=', $filter_price_from)
                ->where('price', '<=', $filter_price_to);
        }

        if ($filter_brand) {
            $products_query = $products_query->whereIn('brand_id', $filter_brand);
        }

        foreach ($filter_data as $name => $values) {
            $products_query = $products_query->whereIn($name, $values);
        }

        //filter data
        $products_count = $products_query->count();
        $products_count = $products_count . ' ' . SiteHelper::getNumEnding($products_count);
        $filter_min_price = (int)$products_query->min('price');
        $filter_max_price = (int)$products_query->max('price');

        $filter_brands = Brand::orderBy('name')
            ->pluck('name', 'id')
            ->all();
        $filter_countries = Brand::orderBy('country')
            ->where('country', '!=', '')
            ->pluck('country', 'id')
            ->all();

        $filters_list = Cache::get('filters_list', []);
        if(!$filters_list) {
            foreach (Catalog::$filters as $name => $ru_name) {
                $filters_list[$name] = [
                    'name' => $ru_name,
                    'values' => Product::where($name, '<>', '')
                        ->distinct()
                        ->orderBy($name)
                        ->pluck($name)
                        ->all()
                ];
            }
            Cache::add('filters_list', $filters_list, now()->addMinutes(60));
        }

        $products = $products_query->with(['single_image', 'catalog', 'brand'])
            ->orderBy('in_stock', 'desc')
            ->orderBy('catalog_id')
            ->paginate(S::get('products_per_page', 9));

        if(request()->ajax()) {
            $view_items = [];
            foreach ($products as $item) {
                $view_items[] = view(
                    'catalog.product_card',
                    [
                        'product' => $item
                    ]
                )->render();
            }
            \Debugbar::log($products_count);


            $pagination = view('paginations.with_pages', ['paginator' => $products])->render();
            $products_count = view('catalog.filter_title', ['products_count' => $products_count])->render();

            return response()->json(
                [
                    'items' => $view_items,
                    'pagination' => $pagination,
                    'count' => $products_count
                ]
            );
        }

        return view('catalog.category', [
            'h1' => $page->h1,
            'text' => $page->text,
            'title' => $page->title,
            'bread' => $bread,
            'filter_data' => $filter_data,
            'categories' => $categories,
            'products_count' => $products_count,
            'products' => $products,
            'filter_min_price' => $filter_min_price,
            'filter_max_price' => $filter_max_price,
            'filter_brands' => $filter_brands,
            'filter_countries' => $filter_countries,
            'filters_list' => $filters_list
        ]);
    }

    public function view($alias)
    {
        $path = explode('/', $alias);
        /* проверка на продукт в категории */
        $product = null;
        $end = array_pop($path);
        $category = Catalog::getByPath($path);
        if ($category && $category->published) {
            $product = Product::whereAlias($end)
                ->public()
                ->first();
        }
        if ($product) {
            return $this->product($product, $category);
        } else {
            array_push($path, $end);
            return $this->category($path + [$end]);
        }
    }

    public function category($path)
    {
        /** @var Catalog $category */
        $category = Catalog::getByPath($path);
        if (!$category || !$category->published) {
            abort(404, 'Страница не найдена');
        }
        $bread = $category->getBread();
        $category->generateTitle();
        $category->generateDescription();
        $category = $this->add_region_seo($category);
        $category->setSeo();
        $category->ogGenerate();

        if (count(request()->query())) {
            View::share('canonical', $category->url);
        }

        Auth::init();
        if (Auth::user() && Auth::user()->isAdmin) {
            View::share('admin_edit_link', route('admin.catalog.catalogEdit', [$category->id]));
        }

        $categories = $category->public_children;
        $children_ids = $this->getChildrenIds($category);
        $category_products = $category->products()->pluck('id')->all();
//        $products_ids = \DB::table('catalog_product')
//            ->whereIn('catalog_id', $children_ids)
//            ->pluck('product_id')
//            ->all();
        $products_ids = Product::whereIn('catalog_id', $children_ids)->pluck('id')->all();
        $products_ids = array_merge($products_ids, $category_products);

        $filter_data = request()->except(['page', 'brand', 'price_from', 'price_to']);
        $filter_brand = request()->only('brand');
        $filter_price_from = request()->get('price_from', 0);
        $filter_price_to = request()->get('price_to', 0);

        $products_query = Product::whereIn('id', $products_ids)
            ->public();

        if ($filter_price_from && $filter_price_to) {
            $products_query = $products_query
                ->where('price', '>=', $filter_price_from)
                ->where('price', '<=', $filter_price_to);
        }

        if ($filter_brand) {
            $products_query = $products_query->whereIn('brand_id', $filter_brand);
        }

        foreach ($filter_data as $name => $values) {
            $products_query = $products_query->whereIn($name, $values);
        }

        //filter data
        $products_count = $products_query->count();
        $products_count = $products_count . ' ' . SiteHelper::getNumEnding($products_count);
        $filter_min_price = (int)$products_query->min('price');
        $filter_max_price = (int)$products_query->max('price');

        $filter_brands = Brand::orderBy('name')
            ->pluck('name', 'id')
            ->all();
        $filter_countries = Brand::orderBy('country')
            ->where('country', '!=', '')
            ->pluck('country', 'id')
            ->all();

        $filters_list = Cache::get('filters_list', []);
        if(!$filters_list) {
            foreach (Catalog::$filters as $name => $ru_name) {
                $filters_list[$name] = [
                    'name' => $ru_name,
                    'values' => Product::where($name, '<>', '')
                        ->distinct()
                        ->orderBy($name)
                        ->pluck($name)
                        ->all()
                ];
            }
            Cache::add('filters_list', $filters_list, now()->addMinutes(60));
        }

        $products = $products_query->with(['single_image', 'catalog', 'brand'])
            ->orderBy('order')
            ->orderBy('id')
            ->paginate(S::get('products_per_page', 9));

        if(request()->ajax()) {
            $view_items = [];
            foreach ($products as $item) {
                $view_items[] = view(
                    'catalog.product_card',
                    [
                        'product' => $item
                    ]
                )->render();
            }

            $pagination = view('paginations.with_pages', ['paginator' => $products])->render();
            $products_count = view('catalog.filter_title', ['products_count' => $products_count])->render();

            return response()->json(
                [
                    'items' => $view_items,
                    'pagination' => $pagination,
                    'count' => $products_count
                ]
            );
        }

        $data = [
            'bread' => $bread,
            'category' => $category,
            'text' => $category->text,
            'h1' => $category->getH1(),
            'products' => $products,
            'products_count' => $products_count,
            'filter_data' => $filter_data,
            'categories' => $categories,
            'filter_min_price' => $filter_min_price,
            'filter_max_price' => $filter_max_price,
            'filter_brands' => $filter_brands,
            'filter_countries' => $filter_countries,
            'filters_list' => $filters_list
        ];

        return view('catalog.category', $data);
    }

    public function product(Product $product, Catalog $category)
    {
        $bread = $product->getBread($category);
        $product->generateTitle();
        $product->generateDescription();
        $product = $this->add_region_seo($product);
        $product->setSeo();
        $product->ogGenerate();

        $categories = Catalog::getTopLevelOnList();

        //наличие в корзине
        $in_cart = false;
        if (Session::get('cart')) {
            $cart = array_keys(Session::get('cart'));
            if ($cart) {
                $in_cart = in_array($product->id, $cart);
            }
        }

        $images = $product->images;
        $image = $product->catalog->image ? $product->catalog->thumb(2) : null;
        $params = $product->params;
        $similar = $product->related;
//        $popular = Product::public()
//            ->where('is_popular', 1)
//            ->where('id', '!=', $product->id)
//            ->get();
        $need = [];

        Auth::init();
        if (Auth::user() && Auth::user()->isAdmin) {
            View::share('admin_edit_link', route('admin.catalog.productEdit', [$product->id]));
        }

        return view('catalog.product', [
            'h1' => $product->getH1(),
            'product' => $product,
            'product_id' => $product->id,
            'categories' => $categories,
            'in_cart' => $in_cart,
            'bread' => $bread,
            'images' => $images,
            'image' => $image,
            'params' => $params,
            'similar' => $similar,
            'need' => $need
        ]);
    }

    public function getChildrenIds(Catalog $category)
    {
        $children_ids = [];
        if (count($category->children)) {
            $children_ids = $category->getRecurseChildrenIds();
        }
        if (!in_array($category->id, $children_ids)) {
            $children_ids[] = $category->id;
        }

        return $children_ids;
    }

    public function search()
    {
        $bread[] = [
            'url' => route('search'),
            'name' => 'Поиск'
        ];

        $products_inst = SearchIndex::query();
        if (!$per_page = session('per_page')) {
            $per_page = 6;
            session(['per_page' => $per_page]);
        }
        if ($s = Request::get('search')) {
            $products_inst->where(function ($query) use ($s) {
                /** @var QueryBuilder $query */
                return $query->where('name', 'LIKE', '%' . $s . '%')
                    ->orWhere('text', 'LIKE', '%' . $s . '%');
            });
            $items = $products_inst->paginate(Settings::get('search_per_page', 10))
            ->appends(['search' => $s]);
        } else {
            $items = collect();
        }

        $products_count = $products_inst->count();
        SEOMeta::setTitle('Результат поиска "' . $s . '"');

        return view('search.index', [
            'bread' => $bread,
            'items' => $items,
            's' => $s,
            'keywords' => 'Поиск',
            'description' => 'Поиск',
            'products_count' => $products_count,
            'per_page' => $per_page,
        ]);
    }

    public function discount()
    {
        $page = Page::whereAlias('discount')->first();
        if (!$page) {
            abort(404, 'Страница не найдена');
        }
        $bread = $page->getBread();
        $page->ogGenerate();
        $page->setSeo();

        $items = Product::public()
            ->where('old_price', '>', 0)
            ->orderBy('name')
            ->paginate(S::get('products_per_page', 9));

        $count = count($items);
        View::share('discount_page', true); //на этой странице цвет бейджа оранжевый

        return view('pages.discount', [
            'page' => $page,
            'h1' => $page->getH1(),
            'bread' => $bread,
            'items' => $items,
            'count' => $count
        ])->render();
    }

}
