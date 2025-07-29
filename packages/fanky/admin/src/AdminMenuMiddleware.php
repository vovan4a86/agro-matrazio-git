<?php namespace Fanky\Admin;

use Auth;
use Closure;
use Fanky\Admin\Models\Order;
use Lavary\Menu\Builder;
use Menu;

class AdminMenuMiddleware {

	/**
	 * Run the request filter.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
        $new_order_count = Order::where('new', 1)->count();
        $order_title = $new_order_count > 0  ? 'Заказы <span class="label label-danger">' . $new_order_count . '</span>' : 'Заказы';
		Menu::make('main_menu', function (Builder $menu) use($request, $order_title) {

			$menu->add('Структура сайта', ['route' => 'admin.pages', 'icon' => 'fa-sitemap'])
				->active('/admin/pages/*');

			$menu->add('Каталог', ['route' => 'admin.catalog', 'icon' => 'fa-list'])
				->active('/admin/catalog/*');

//            $menu->add('Производители', ['route' => 'admin.brands', 'icon' => 'fa-tag'])
//                ->active('/admin/brands/*');
//
//            $menu->add('Новости и акции', ['route' => 'admin.news', 'icon' => 'fa-calendar'])
//                ->active('/admin/news/*');
//
//            $menu->add('Статьи', ['route' => 'admin.publications', 'icon' => 'fa-calendar'])
//                ->active('/admin/publications/*');

//			$menu->add($order_title, ['route' => 'admin.orders', 'icon' => 'fa-dollar'])
//				->active('/admin/orders/*');

			$menu->add('Региональность', ['route' => 'admin.cities', 'icon' => 'fa-globe'])
				->active('/admin/cities/*');

			$menu->add('Настройки', ['icon' => 'fa-cogs'])
				->nickname('settings');
			$menu->settings->add('Настройки', ['route' => 'admin.settings', 'icon' => 'fa-gear'])
				->active('/admin/settings/*');

			$menu->settings->add('Редиректы', ['route' => 'admin.redirects', 'icon' => 'fa-retweet'])
				->active('/admin/redirects/*');

			$menu->add('Файловый менеджер', ['route' => 'admin.pages.filemanager', 'icon' => 'fa-file'])
				->active('/admin/pages/filemanager');
		});

		return $next($request);
	}

}
