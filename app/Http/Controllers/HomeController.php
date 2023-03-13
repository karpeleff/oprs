<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkTime;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Gaz;
use  App\Models\Diesel;

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
// example:
          // toast('Signed in successfully','success')->timerProgressBar();
          // example:
          //alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->persistent(true,true);

         // toast('Post Updated','success','top-right')->showCloseButton();
      //  Alert::alert('Текущий остаток дизтоплива', '338,37 л', 'Type');
      Alert::info('Текущий остаток дизтоплива', '338,37 л');
        return view('des');
    }

    public  function add_time(Request $request)
    {

     //dd($request);
       //Log::alert($request);

       // $data = WorkTime::create($request->all());
       // return $data;

       $data = new WorkTime;
    
       $data->payload = serialize($request->content);
       $data->save();

       return response('Данные добавлены в базу успешно' , 200);

    }

    public function   gaz_in()
    {
        return view('gaz_in');
    }

    public function   diesel_in()
    {
        return view('diesel_in');
    }

    public function   gaz_del(Request $request)
    {

//dd($request);

if($request->type === 1)
{
   $blank = 'blanc/trimmer.docx';
}
if($request->type === 2)
{
    $blank = 'blanc/snow.docx';
}

$templateProcessor = new TemplateProcessor($blank);

        return view('gaz_out');
    }


    public function   gaz_out()
    {

        return view('gaz_out');
    }

    public function   fuel_add(Request $request)
    {

if($request->type === 'D')
{

    $query = Diesel::query()->latest()->first();
    $balans = $query->balans;


    $data = new Diesel();
    $data->coming = $request->count;
    $data->date = $request->date;
    $data->balans = $balans + $request->count;
   // $data->
   $data->save();

      return response('Данные загружены' , 200);
}
if($request->type === 'B')
{

    $query = Gaz::query()->latest()->first();
    $balans = $query->balans;

    $data = new Gaz();
    $data->coming = $request->count;
    $data->date = $request->date;
    $data->balans = $balans + $request->count;
    //$data->
    $data->save();

      return response('Данные загружены' , 200);
}
      
    }


}
