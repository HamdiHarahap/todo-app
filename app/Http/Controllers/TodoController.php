<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Todo::orderBy('id', 'asc')->get();

        return view('welcome', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'todo' => 'required|min:3',
            ]
        );

        $todo = [
            'todo' => $request->input('todo'),
            'is_done' => false
        ];
        Todo::create($todo);
        return redirect()->route('home')->with('success', 'Todo berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'todo' => $request->input('todo'),
            'is_done' => false
        ];

        Todo::where('id', $id)->update($data);
        return redirect()->route('home')->with('success', 'Todo berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('home')->with('success', 'Todo berhasil dihapus');
    }
}
