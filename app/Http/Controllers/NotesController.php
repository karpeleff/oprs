<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesController extends Controller
{
    public function create_note(Request $request)
    {
        $note = Note::create([
            'text' => $request->text,
        ]);
        return response('Данные добавлены в базу успешно' , 200);
    }

    public function get_notes()
    {
        $notes = Note::all();

        return response($notes , 200);
    }

public function  notes_view()
{
    return view('note');
}

}
