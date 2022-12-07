<?php

namespace App\Http\Controllers;

use App\Exports\AdminExport;
use App\Imports\AdminImport;
use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(Request $request){
        if($request->has('search')) {
            $data = Admin::where('nama', 'LIKE', '%'.$request->search.'%')->paginate(5);
        } else {
            $data = Admin::paginate(5);
        }
        return view('admin', compact('data'));
    }

    public function tambahDataAdmin(){
        return view('tambahDataAdmin');
    }

    public function insertDataAdmin(Request $request){
        $data = Admin::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('foto/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('admin')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampilkanData($id) {
        $data = Admin::find($id);
        return view('tampilData', compact('data'));
    }

    public function updateData(Request $request, $id) {
        $data = Admin::find($id);
        $data->update($request->all());

        if($request->hasFile('foto')){
            $request->file('foto')->move('foto/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('admin')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id) {
        $data = Admin::find($id);
        $data->delete();
        return redirect()->route('admin')->with('success', 'Data Berhasil Dihapus');
    }

    public function exportpdf() {
        $data = Admin::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('dataadmin-pdf');
    	return $pdf->stream('dataadmin.pdf');
    }

    public function exportexcel(){
        return Excel::download(new AdminExport, 'dataadmin.xlsx');
    }

    public function importexcel(Request $request){
        $data = $request->file('file');
        $namaFile = $data->getClientOriginalName();
        $data->move('DataAdmin', $namaFile);

        Excel::import(new AdminImport, public_path('/DataAdmin/'.$namaFile));
        return redirect()->back();
    }
}

