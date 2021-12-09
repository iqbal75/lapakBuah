<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\admin\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');

        // $categories = Category::all();
        // $products = ProductModel::with(['imageproduct'])->take(6)->latest()->get();
        // return view('pages.home', [
        //     'categories' => $categories,
        //     'products' => $products
        // ]); 
    }

    public function success(){
        return view('auth.success');
    }
}
