<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Http\Requests\StoreLibroRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Models\Autor;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT l.id, a.name, l.title , a.id FROM libros l INNER JOIN autors a ON l.id = a.id WHERE a.deleted_at is not null;
        //SELECT a.name FROM libros l INNER JOIN autors a ON l.id = a.id;
        $libros = Libro::join("autors","autors.id", "=", "libros.autor_id")
                    ->select("libros.id","name","title","category","autor_id","address")
                    //->where("autors.deleted_at", "is", "null")
                    ->get();

        

        //$libros = Libro::all();
        return view('libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $autor = Autor::all();
        $libro = Libro::all();
        return view('libros.create', compact('libro', 'autor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLibroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLibroRequest $request)
    {
        //

        $autor = new Libro;
        $autor->title = $request->title;
        $autor->category = $request->category;
        $autor->address = $request->address;
        $autor->autor_id = $request->autor_id;

        $autor->save();
        return redirect('libros');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        //
        $autor = Autor::all();
        return view('libros.edit', compact('libro', 'autor'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLibroRequest  $request
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLibroRequest $request, Libro $libro)
    {
        //
        $validated = $request->validated();
        $libro->update($request->all());
        return redirect('/libros');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        //

        $libro->delete();
        return redirect('libro')->with('eliminar','ok');
    }
}
