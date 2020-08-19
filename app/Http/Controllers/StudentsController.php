<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Response;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Student::orderBy('id','desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        // 'nama' => 'required|regex:/^[a-zA-Z]+$/u'
        // ]);
        $insert = Student::create($request->all());
        return response($insert);
    }

    public function search($query){
       $search = $query;
        $res =  Student::where('nisn', 'LIKE', "%{$search}%")
        ->orWhere('nama', 'LIKE', "%{$search}%")
        ->orWhere('kelas', 'LIKE', "%{$search}%")
        ->orWhere('jurusan', 'LIKE', "%{$search}%")
        ->get();
        
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Student::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
       return $student->update($request->all());
        // return Student::orderBy('id','desc')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return response(200);
    }
}
