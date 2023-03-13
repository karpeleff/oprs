<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\WorkTime;
use App\Models\Diesel;
use App\Models\Gaz;
use Carbon\Carbon;
use \PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DB;

class DocsController extends Controller
{
    public function index()
    {
   
    }

    public function sprav_mons_view()
    {
   return view('spr');
    }


    public function sprav_mons(Request $request)
    {
        $templateProcessor = new TemplateProcessor('blanc/dizel_work.docx');
        $mons = $request->mons;
        $year = 2023;
        $mons = $request->mons;

          $last_day = cal_days_in_month(CAL_GREGORIAN, '03', $year); //последний день месяца
        $des_type = 'ADR';
        $start_date;
        $start_time;
        $stop_date;
        $stop_time;
        $amount;
        $itog_adr;
        $itog_sd;
        $reason;

      //  $count = 5;
$period = '2023-02';

$record = WorkTime::where('created_at','LIKE','%'.$period.'%')->get();
// $users = User::where('country', 'LIKE', '%'.$search.'%')->get();
$count = $record->count();
//$record->toArray();
$i=1;
//dd($record->payload);

foreach ($record as $item) {
   // echo $item->payload;
     // $data = (json_decode($item->payload, true));
     // echo $data->date_start;
     $itog = unserialize($item->payload);
     echo $itog['date_start'];
}


        $templateProcessor->cloneRow('des_type', $count);


   /*        $templateProcessor->setValue(array
        ('des_type#'    . $i,
         'start_date#'  . $i,
         'start_time#'  . $i,
         'stop_date#'   . $i,
         'stop_time#'   . $i,
         'amount#'      . $i,
         'reason#'      . $i),
          
         array(        $item['engine_type'], 
                   ($item['start_time'],0,10),
                  ($item['start_time'],11,5),
                  ($item['stop_time'], 0,10),
                  ($item['stop_time'],11,5),
                          $itog , 
                          $item['type_start'])); */

//$i++;

if ($item['engine_type'] === 'ADR16.5')//подсчет общего времени работы ДГУ
{
$itog_adr[] = $itog;
} else
{
$itog_sd[]  = $itog;
}
// конец цикла





        $name = 'Справка о работе дизелей за  '.$this->conv_a($mons).' '.$year.' г';
        $pathToSave = 'out/'.$name.'.docx';
        $templateProcessor->saveAs($pathToSave);
    }


public function  conv_a($mons)
{
   $a = [
    'январь',
    'февраль',
    'март',
    'апрель',
    'май',
    'июнь',
    'июль',
    'август',
    'сентябрь',
    'октябрь',
    'ноябрь',
    'декабрь'
   ];

   return $a[intval($mons)];                                                                             
}

public function  conv_b($mons)
{
   $a = [
    'января',
    'февраля',
    'марта',
    'апреля',
    'мая',
    'июня',
    'июля',
    'августа',
    'сентября',
    'октября',
    'ноября',
    'декабря'
   ];

   return $a[intval($mons)];
}

public function getday($day)
{
  $d= [
  1 => "D",
  2 => "E",
  3 => "F",
  4 => "G",
  5 => "H",
  6 => "I",
  7 => "J",
  8 => "K",
  9 => "L",
  10 => "M",
  11 => "N",
  12 => "O",
  13 => "P",
  14 => "Q",
  15 => "R",
  16 => "S",
  17 => "T",
  18 => "U",
  19 => "V",
  20 => "W",
  21 => "X",
  22 => "Y",
  23 => "Z",
  24 => "AA",
  25 => "AB",
  26 => "AC",
  27 => "AD",
  28 => "AE",
  29 => "AF",
  30 => "AG",
  31 => "AH",
  ];

  return $d[$day];
 
}



    public function   gaz_del(Request $request)
    {

   //dd($request->type);
  // $today = Carbon::today();
  //$dt = Carbon::now();

   $year = 2023;
   $mons = $request->mons;

 

//dd(gettype($mons));
   

if($request->type == 1)//trimmer
{
   $blank = 'blanc/trimmer.docx';
   $norm = 1.02;
   $name = 'Акт списания ГСМ Травокосилка '.$this->conv_a($mons).' '.$year.' г';
}
if($request->type == 2)//snow
{
    $blank = 'blanc/snow.docx';
    $norm = 0.8;
    $name = 'Акт списания ГСМ снегоуборщик '.$this->conv_a($mons).' '.$year.' г';
}
    $rasxod = $request->count * $norm;

   // dd($rasxod);
$templateProcessor = new TemplateProcessor($blank);
$templateProcessor->setValues(array(
         'mons'      => $this->conv_b($mons), 
         'year'      => $year,
         'work_time' => $request->count,
         'rasxod'    => $rasxod,
         'last_day'  => 30
        ));

        $pathToSave = 'out/'.$name.'.docx';

        $templateProcessor->saveAs($pathToSave);

        $query =  Gaz::query()->latest()->first();

        $balans = $query->balans;

     //$m =  '0'.(intval($mons) + 1);
    
     $data = new Gaz();
     $data->consumtion = $rasxod;
     $data->balans     = $balans - $rasxod ;
     $data->doc        = $name;
     $data->date       = $year.'-'.$out;
     $data->save();

        return view('gaz_out');
    }




    public function  test()
    {


   // $row = WorkTime::where('created_at', '2023-01-18 07:45:23')->first();
   // dd($row->payload);
 //  $itog = unserialize($row->payload);
   //dd($itog);
   //echo $itog['des_select'];

    //('name', 'LIKE', '%'.$search.'%')

   // $time  = Carbon::now();
    //echo $time;
   // $a =    $this->fuelCalc();

   // dd ($a);

    }

public function  createSvodGsm()
{




$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('blanc\svod.xlsx');

$worksheet = $spreadsheet->getActiveSheet();

$worksheet->getCell('B8')->setValue('март 2044 г');

$worksheet->getCell('E10')->setValue('Остаток на 01.01.2442');
$worksheet->getCell('E11')->setValue('500');//остаток начало месяца
$worksheet->getCell('E12')->setValue('100');

$worksheet->getCell('F11')->setValue('600');//приход
$worksheet->getCell('F12')->setValue('100');

$worksheet->getCell('G11')->setValue('2340');//расход
$worksheet->getCell('G12')->setValue('576');

$worksheet->getCell('H10')->setValue('Остаток на 01.02992');
$worksheet->getCell('H11')->setValue('15');//остаток конец месяца
$worksheet->getCell('H12')->setValue('467');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('out\write.xlsx');
}

public function   fuelCalc($period = 0)
{

    $result = [
        'diesel_begin_mons' => '',
        'diesel_end_mons'=> '',
        'gaz_begin_mons'=> '',
        'gaz_end_mons'=> '',
        'gaz_coming_mons'=> '',
        'diesel_coming_mons'=> '',
        'diesel_consumtion_mons'=> '',
        'gaz_consumtion_mons'=> '',
    ];

$period = '2023-01';


$res_1 = Gaz::where('date','like', $period.'%')->get();

$result['gaz_end_mons'] =  $res_1->max('balans');

$res_2 = Diesel::where('date','like', $period.'%')->get();

$result['diesel_end_mons'] =  $res_2->max('balans');

$result['gaz_coming_mons'] = $res_1->sum('coming');

$result['diesel_coming_mons'] = $res_2->sum('coming');

return  $result;


}


public  function getstatus($day)
{
 // $inputFileName = 'blanc/smena/1.xlsx';

  $inputFileType = 'Xlsx';

 $month = date('m');

 //$month = 07;

  intval($month);

  if($month > 0 &&  $month < 4  )
  {
    $kvart = 1;
  }
 
  if($month > 3 &&  $month < 7 )
  {
    $kvart = 2;
  }
 
  if($month > 6 &&  $month < 10 )
  {
    $kvart = 3;
  }
 
  if($month > 9 &&  $month < 13 )
  {
    $kvart = 4;
  }
 
 $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
  
  $reader->setReadDataOnly(true);

  $inputFileName = 'blanc/smena/'.$kvart.'.xlsx';

  $spreadsheet = $reader->load($inputFileName);

  $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
  // dd($sheetData);

 // echo   $day;

 // die();

if($month == 1 || $month == 4 || $month == 7 || $month == 10 )
{
  $start = 17;
}

if($month == 2 ||$month == 5 || $month == 8 || $month == 11 )
{
  $start = 23;
}

if($month == 3 ||$month == 6 || $month == 9 || $month == 12 )
{
  $start = 29;
}
  $data = $this->getday($day);

  $out = [];
 
for($i=1;$i<=5;$i++)
{

$out[$i] = [
  $sheetData[$start]['C'] =>  $sheetData[$start][$data],
           ];
    $start++;   
}

//dd($out);
$search_value = 'ОТ';

foreach($out as $key => $arr)
{
 //$key = array_search('Д', $arr); 
 //echo $value;

 foreach( $arr as $k => $v )
{
    if($search_value == $v)
    {
       // var_dump($k);
       // echo "n";
       $result = $k;
        break;
    }
}
 
}

echo  $result ;

die();

}

public function mons_plan(Request $request)
{

  // $this->getstatus(9);

  $year = 2023;

  $mons = $request->mons;
 // echo    gettype($mons);

 // dd($mons);

  $last_day = cal_days_in_month(CAL_GREGORIAN, ($mons + 1), $year); //последний день месяца

  $templateProcessor = new TemplateProcessor('blanc/work_plan.docx');
  /* 
  1_person_to_des   last day of month
  2_person_to_des   last day of month - 7
  3_person_to_des   last day of month - 14
  4_person_to_des   last day of month - 21
  5_person_to_afu
  6_person_to_parsek
  7_person_to_ru
  8_person_to_toilet 5
  9_person_to_toilet 20
  date_to_1_des  d_1
  date_to_2_des  d_2
  date_to_3_des  d_3

  */

  $templateProcessor->setValues(array(
    'y'      =>  $year, 
    'm_d'      =>  str_pad(($mons + 1), 2, '0', STR_PAD_LEFT), //добавляем ноль к месяцу
    'm_t' =>  $this->conv_a($mons),
    'l'    => $last_day,
    '1' =>  'Щеглюк В.В.',
    '2' =>  'Семенов П.Ф',
    '3'  =>  'Ситнюк Д.С.',
    '4' =>  'Миронов А.В',
    '5' =>  'Ситнюк Д.С.',
    '6' =>  'Миронов А.В',
    '7' =>  'Щеглюк В.В.',
    '8' =>  'Миронов А.В',
    '9' =>  'Щеглюк В.В.',
    'd_1'  => $last_day  - 21,
    'd_2'  => $last_day  - 14,
    'd_3'  => $last_day  - 7,
    
   ));

  $name = 'План работ на '.$this->conv_a($mons).' '.$year.' г';
  $pathToSave = 'out/'.$name.'.docx';
  $templateProcessor->saveAs($pathToSave);

 // return redirect('home');

 Alert::info($name, 'СОСТАВЛЕН');

 return   redirect('home');
 //->with('success','план составлен !');

}

public function  mons_plan_view()
{
  return view('plan');
}


}
