<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	public function index(Request $request)
    {
        //QUERY MENGGUNAKAN MODEL CATEGORY, DIMANA KETIKA PARAMETER Q TIDAK KOSONG
        $categories = Category::when($request->q, function($categories) use($request) {
            //MAKA AKAN DILAKUKAN FILTER BERDASARKAN NAME
            $categories->where('name', 'LIKE', '%' . $request->q . '%');
        })->orderBy('created_at', 'DESC')->paginate(10); //DAN DIORDER BERDASARKAN DATA TERBARU
        return response()->json(['status' => 'success', 'data' => $categories]);
    }
    
    public function store(Request $request)
    {
        //VALIDASI DATA YANG DITERIMA
        $this->validate($request, [
            'name' => 'required|string|unique:categories,name', //NAME BERSIFAT UNIK
            'description' => 'nullable|string|max:150'
        ]);

        //SIMPAN DATA KE TABLE CATEGORIES MENGGUNAKAN MASS ASSIGNMENT ELOQUENT
        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json(['status' => 'success']);
    }
}