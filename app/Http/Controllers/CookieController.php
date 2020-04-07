<?php namespace App\Http\Controllers;

/**
 * Class AboutController
 * @package App\Http\Controllers
 */
class CookieController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cookie');
    }
}
