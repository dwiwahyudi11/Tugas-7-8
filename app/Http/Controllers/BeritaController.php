<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berita;
use App\KategoriBerita;

class BeritaController extends Controller
{
    public function index(){
        
        $listBerita=Berita::all(); 

        return view ('berita.index',compact('listBerita'));
        
    }

    public function show($id) {

        $Berita=Berita::find($id);

        return view ('berita.show', compact('Berita'));
        
    }

    public function create(){
        $KategoriBerita=KategoriBerita::pluck('nama','id');

        return view ('berita.create', compact('KategoriBerita'));
        
    }

    public function store(Request $request){
        $input=$request->all();

        Berita::create($input);

        return redirect(route('berita.index'));
    }
      public function edit($id){
        $listBerita=Berita::find($id);
        $KategoriBerita=KategoriBerita::pluck('nama','id');

        if(empty($listBerita)){
            return redirect(route('berita.index'));
        }

            return view('berita.edit', compact('listBerita','KategoriBerita'));
    }

    public function update($id, Request $request){
        $listBerita=Berita::find($id);
        $input= $request->all();

        if(empty($listBerita)){
            return redirect(route('berita.index'));
        }

        $listBerita->update($input);

        return redirect(route('berita.index'));
    }

    public function destroy($id){
        $listBerita=Berita::find($id);

        if(empty($listBerita)){
            return redirect(route('Berita.index'));
        }

        $listBerita->delete();

        return redirect(route('berita.index'));
    }

    public function trash(){
        
        $listBerita=Berita::onlyTrashed()
                    ->whereNotNull('deleted_at')
                    ->get();

        return view ('berita.index',compact('listBerita'));
       
    }
}