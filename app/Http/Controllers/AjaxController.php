<?php
namespace App\Http\Controllers;

use DB;
use Fanky\Admin\Models\City;
use Fanky\Admin\Models\Feedback;
use Fanky\Admin\Models\Order as Order;
use Fanky\Admin\Models\Page;
use Fanky\Admin\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Mail;
use Settings;
use Cart;
use SiteHelper;
use Validator;

class AjaxController extends Controller
{
    private $fromMail = 'zakaz@agrostal-komplekt.ru';
    private $fromName = 'Агросталь Комплект';

    //Заказать звонок
    public function postCallback() {
        $data = request()->only(['name', 'phone']);

        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Не заполнено поле имя',
            'phone.required' => 'Не заполнено поле телефон',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $feedback_data = [
                'type' => 1,
                'data' => $data
            ];

            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback],
                function ($message) use ($feedback) {
                $title = $feedback->id . ' | Обратный звонок | ' . $this->fromName;
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //Есть вопросы
    public function postWrite() {
        $data = request()->only(['name', 'phone', 'text']);

        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Не заполнено поле имя',
            'phone.required' => 'Не заполнено поле телефон',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $feedback_data = [
                'type' => 2,
                'data' => $data
            ];

            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback],
                function ($message) use ($feedback) {
                $title = $feedback->id . ' | Вопрос | ' . $this->fromName;
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //Заявка
    public function postOrder() {
        $data = request()->only(['name', 'phone', 'text']);

        $valid = Validator::make($data, [
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Не заполнено поле имя',
            'phone.required' => 'Не заполнено поле телефон',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $feedback_data = [
                'type' => 3,
                'data' => $data
            ];

            $feedback = Feedback::create($feedback_data);
            Mail::send('mail.feedback', ['feedback' => $feedback],
                function ($message) use ($feedback) {
                $title = $feedback->id . ' | Заявка | ' . $this->fromName;
                $message->from($this->fromMail, $this->fromName)
                    ->to(Settings::get('feedback_email'))
                    ->subject($title);
            });

            return ['success' => true];
        }
    }

    //РАБОТА С ГОРОДАМИ
    public function postSetCity(Request $request)
    {
        $city_id = $request->get('city_id');
        $city = City::find($city_id);
        if ($city) {
            $result = [
                'success' => true,
            ];
            session(['city_alias' => $city->alias]);

            return response(json_encode($result))->withCookie(cookie('city_id', $city->id));
        } elseif ($city_id == 0) {
            $result = [
                'success' => true,
            ];
            session(['city_alias' => '']);

            return response(json_encode($result))->withCookie(cookie('city_id', 0));
        }

        return ['success' => false, 'msg' => 'Город не найден'];
    }

    public function postGetCorrectRegionLink(Request $request)
    {
        $city_id = $request->get('city_id');
        $city = City::find($city_id);
        $cur_url = $request->get('cur_url');
        $url = $cur_url;
        $excludeRegionAlias = true;

        $cities_aliases = City::pluck('alias')->all();

        $path = explode('/', $cur_url);
        foreach ($cities_aliases as $alias) {
            if (in_array($alias, $path)) {
                $excludeRegionAlias = false;
                break;
            }
        }

        if ($cur_url != '/' && !$excludeRegionAlias) {
            $path = explode('/', $cur_url);
            $cities = City::pluck('alias')->all();
            /* проверяем - региональная ссылка или федеральная */
            if (in_array($path[3], $cities)) {
                if ($city) {
                    $path[3] = $city->alias;
                } else {
                    array_splice($path, 3,1);
                }
            } else {
                if ($city) {
                    array_splice($path, 3, 0, $city->alias);
                }
            }

            $url = implode('/', $path);
        }

        session(['city_alias' => $city ? $city->alias : null]);

        $result = ['success' => true, 'redirect' => url($url)];

        return response(json_encode($result))->withCookie(cookie('city_id', $city ? $city->id : 0));
    }

    public function showCitiesPopup()
    {
        $cities = Cache::get('cities', collect());
        if (!count($cities)) {
            $cities = City::query()->orderBy('name')
                ->get(['id', 'alias', 'name', DB::raw('LEFT(name,1) as letter')]);
            Cache::add('cities', $cities, now()->addMinutes(60));
        }
        $citiesArr = Cache::get('cities_arr', []);
        if (!count($citiesArr)) {
            if (count($cities)) {
                foreach ($cities as $city) {
                    $citiesArr[$city->letter][] = $city; //Группировка по первой букве
                }
            }
            Cache::add('cities_arr', $citiesArr, now()->addMinutes(60));
        }

        $curUrl = url()->previous() ?: '/';
        $curUrl = str_replace(url('/') . '/', '', $curUrl);

        $current_city = SiteHelper::getCurrentCity();

        return view(
            'blocks.popup_cities',
            [
                'cities' => $citiesArr,
                'curUrl' => $curUrl,
                'current_city' => $current_city
            ]
        );
    }

}
