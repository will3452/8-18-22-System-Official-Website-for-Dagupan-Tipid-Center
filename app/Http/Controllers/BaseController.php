<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller {
    public $model;
    public function __construct($model)
    {
        $this->model = $model;
    }
    public function store (Request $request) {
        $data = $request->all();
        return ($this->model)::create($data);
    }

    public function update (Request $request, $id) {
        $data = $request->all();
        $model = ($this->model)::find($id);
        $model->update($data);
    }
    public function destroy (Request $request, $id) {
        $model = ($this->model)::find($id);
        $model->delete();
        return 1;
    }

    public function getData (Request $request) {
        return ($this->model)::get();
    }
}
