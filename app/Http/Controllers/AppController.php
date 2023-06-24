<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain' => 'bail|required|string|unique:apps,domain',
            'email' => 'bail|required|email',
            'phone' => 'bail|required|string|min:8|max:15',
            'name' => 'bail|required|string|min:3',
            'exp_date' => 'bail|required|numeric',
        ]);
        if ($validator->fails()) {
            return response($validator->messages(), 422);
        }
        $validated = $request->only(['domain', 'email', 'email', 'phone', 'name', 'exp_date']);
        return App::registration($validated);
    }

    public function setEnvironment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'database' => 'bail|required|string',
        ]);
        if ($validator->fails()) {
            return response($validator->messages(), 422);
        }
        $validated = $request->only(['database']);
        $env = [
            'APP_NAME' => 'localhost',
        ];
        return App::setEnvironment($env);
    }
    public function searchFile(Request $request)
    {

        return App::searchFile();
    }
    public function writeFile()
    {
        return App::writeFile();
    }
}
