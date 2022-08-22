<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller {
    private $model;
    public function __construct($model)
    {
        $this->model = $model;
    }
    public function store (Request $request) {
        $data = $request->all();
        return ($this->model)::create($data);
    }

    public function update (Request $request, $model) {
        $data = $request->all();
        $model->update($data);
    }
    public function destroy (Request $request, $model) {
        $model->delete();
        return 1;
    }

    public function getData (Request $request) {
        return ($this->model)::get();
    }
}
