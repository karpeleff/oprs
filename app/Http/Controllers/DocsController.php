<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkTime;

class DocsController extends Controller
{
    public function index()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
// Adding Text element to the Section having font styled by default...
$section->addText(
    'это текст'
);
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('helloWorld.docx');

    }

    public function  test()
    {
    $row = WorkTime::where('created_at', '2023-01-18 07:45:23')->first();
   // dd($row->payload);
   $itog = unserialize($row->payload);
   //dd($itog);
   echo $itog['des_select'];

    //('name', 'LIKE', '%'.$search.'%')
    }
}
