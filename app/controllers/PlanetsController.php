<?php

class PlanetsController extends BaseController {

    public function getAdd() {
        return View::make('planets/add');
    }

    public function postAdd() {
        $data = Input::all();

        $validation = Validator::make($data, Planet::getValidationRules());
        if ($validation->fails()) {
            return Redirect::back()->withErrors($validation)->withInput();
        }

        if (Auth::check()) {
            $data['user_id'] = Auth::user()->id;
        }
        $planet = Planet::create($data);
        return Redirect::to(action('PlanetsController@getView', array($planet->id)));
    }

    public function getView($planetId) {
        $planet = Planet::find($planetId);

        // Если такой планеты нет, то вернем пользователю ошибку 404 - Не найдено
        if (!$planet) {
            App::abort(404);
        }

        // Увеличим счетчик просмотров планеты
        $planet->views++;
        $planet->save();

        return View::make('planets/view', array('planet' => $planet));
    }
}
