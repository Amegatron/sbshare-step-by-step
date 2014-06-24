<?php

class IndexController extends BaseController {

    public function getIndex() {
        $planets = Planet::orderBy('created_at', 'DESC')->take(6)->get();
        $counter = Planet::count();

        return View::make('index', array(
                                     'planets'  => $planets,
                                     'counter'  => $counter,
                                 ));
    }
}
