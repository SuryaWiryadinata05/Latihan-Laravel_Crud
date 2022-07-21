<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function grade($a){
        if($a >= 90 && $a <= 100){
            $grade = 'A';
        }
        elseif($a >= 80 && $a <= 89){
            $grade = 'B';
        }
        elseif($a >= 70 && $a <= 79){
            $grade = 'C';
        }
        elseif($a >= 60 && $a <= 69){
            $grade = 'D';
        }
        elseif($a >= 50 && $a <= 59){
            $grade = 'E';
        }
        elseif($a >= 40 && $a <= 49){
            $grade = 'F';
        }
        else{
            $grade = "Grade Error";
        }
        return $grade;
    }
    public function index()
    {
        $a = Nilai::all();
        return view('nilai.index' , ['nilai' => $a]);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('nilai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nis' => 'required',
            'kode_mata_pelajaran' => 'required',
            'nilai' => 'required',
        ]);

        $nilai = new Nilai();
        $nilai->nis = $request->nis;
        $nilai->kode_mata_pelajaran = $request->kode_mata_pelajaran;
        $nilai->nilai = $request->nilai;
        $nilai->grade = $this->grade($nilai->nilai);
        $nilai->save();
        return redirect()->route('nilai.index')->with('success',
        'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $nilai = Nilai::findorFail($id);
        return view('nilai.show' , compact('nilai'));
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
        $nilai = Nilai::findorFail($id);
        return view('nilai.edit' , compact('nilai'));
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
        //
        $validated = $request->validate([
            'nis' => 'required',
            'kode_mata_pelajaran' => 'required',
            'nilai' => 'required',
            
        ]);

        $nilai = Nilai::findorFail($id);
        $nilai->nis = $request->nis;
        $nilai->kode_mata_pelajaran = $request->kode_mata_pelajaran;
        $nilai->nilai = $request->nilai;
        $nilai->grade = $this->grade($nilai->nilai);
        $nilai->save();
        return redirect()->route('nilai.index')->with('success',
        'Data berhasil DiUpdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $nilai = Nilai::findorFail($id);
        $nilai->delete();
        return redirect()->route('nilai.index')->with('info',
        'Data Berhasil Dihapus!');
    }
}
