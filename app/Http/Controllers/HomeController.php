<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkTime;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function des()
    {

        Alert::alert('Title', 'Message', 'Type');
        return view('des');
    }

    public  function add_time(Request $request)
    {

     //dd($request);
       //Log::alert($request);

       // $data = WorkTime::create($request->all());
       // return $data;

       $data = new WorkTime;
      // $data->payload = $request->content;
       $data->payload = serialize($request->content);
       $data->save();

       return response('Данные добавлены в базу успешно' , 200);

    }

}
