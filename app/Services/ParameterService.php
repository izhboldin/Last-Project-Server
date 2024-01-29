<?php

namespace App\Services;

use App\Exceptions\ListCategoryException;
use App\Models\Category;
use App\Models\Parameter;
use Exception;
use Illuminate\Support\Carbon;

class ParameterService
{

    public function create($data)
    {
        Parameter::create($data);
    }

    public function update($data, Parameter $parameter)
    {
        $parameter->update($data);
    }

    public function delete(Parameter $parameter)
    {
        $parameter->delete();
    }

}
