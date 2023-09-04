<?php

namespace App\Http\Controllers;

use  PDF;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Exports\KaryawanExport;
use App\Imports\KaryawanImport;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Karyawan::where('nama','LIKE','%' .$request->search.'%')->paginate(5);
        }else{
            $data = Karyawan::paginate(5);
        }

        return view('datakaryawan', compact('data'));
    }

    public function tambahkaryawan(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){
        //dd($request->all());
        $data = Karyawan::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotokaryawan/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('karyawan')->with('success', 'Data Berhasil Di tambahkan');
    }

    public function tampilkandata($id){
        $data = Karyawan::find($id);
        //dd($data);
        return view('tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id){
        $data = Karyawan::find($id);
        $data->update($request->all());
        return redirect()->route('karyawan')->with('success', 'Data Berhasil Di Update');
    }

    public function delete($id){
        $data = Karyawan::find($id);
        $data->delete();
        return redirect()->route('karyawan')->with('success', 'Data Berhasil Di Hapus');
    }

    public function exportpdf(){
        $data = Karyawan::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datakaryawan-pdf');
        return $pdf->download('data.pdf');
    }

    public function exportexcel(){
        return Excel::download(new KaryawanExport, 'datakaryawan.xlsx');
    }

    public function importexcel(Request $request){
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('KaryawanData', $namafile);

        Excel::import(new KaryawanImport, \public_path('/KaryawanData/'.$namafile));
        return \redirect()->back();
    }
}
