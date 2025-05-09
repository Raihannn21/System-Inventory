<?php

namespace App\Http\Controllers;

use App\Models\bugreport;
use Illuminate\Http\Request;

class BugreportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.bugreport.index');
    }
    public function viewAdmin()
    {
        $data = bugreport::all();
        return view('administrator.bugreport.index')->with('data',$data);
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
        $request->validate([
            'nama'=>'required|min:3',
            'desc'=>'required|min:20'
        ]);

        bugreport::create([
'reporter'=>$request->nama,
'description'=>$request->desc
        ]);

        return redirect('student/bug-report');
    }

    /**
     * Display the specified resource.
     */
    public function show(bugreport $bugreport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bugreport $bugreport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bugreport $bugreport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bugreport $bugreport)
    {
        //
    }
}
