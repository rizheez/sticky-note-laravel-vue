<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return response()->json($notes);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
        ]);

        $note = Note::create([
            'title' => $validatedData['title'],
            'text' => $validatedData['text'],
        ]);

        return response()->json($note, 201);
    }

    public function show(Note $note)
    {
        return response()->json($note);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
        ]);

        $note = Note::findOrFail($id);

        $note->update([
            'title' => $validatedData['title'],
            'text' => $validatedData['text'],
        ]);

        return response()->json($note);
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return response()->json(null, 204);
    }
}
