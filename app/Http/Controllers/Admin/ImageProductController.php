<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageProductRequest;
use Illuminate\Http\Request;
use App\Models\Admin\ImageProduct;
use App\Models\Admin\ProductModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use File;

class ImageProductController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:imageproduct-list|imageproduct-create|imageproduct-edit|imageproduct-delete', ['only' => ['index','store']]);
         $this->middleware('permission:imageproduct-create', ['only' => ['create','store']]);
         $this->middleware('permission:imageproduct-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:imageproduct-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $data = ImageProduct::all();
		return view('pages.admin.image_product.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);

        // $data = ImageProduct::orderBy('id','DESC')->paginate(5);
        // return view('pages.admin.image_product.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);

        if (request()->ajax()) {
            $query = ImageProduct::all();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '" style="border-radius:10px 0px 10px 10px; margin:10px;">
                                    <a class="dropdown-item" href="' . route('imageproduct.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('imageproduct.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make();
        }
        return view('pages.admin.category_product.index');
    }
    
    public function create()
    {
        $product = ProductModel::get();
        return view('pages.admin.image_product.create', ['product' => $product]);
        // return view('pages.admin.image_product.create');
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_id' => 'required',
            'image'      => 'required',
            'image.*'    => 'mimes:jpg,png,jpeg,gif,svg'
            ]);
            if($request->hasfile('image'))
             {
                foreach($request->file('image') as $key => $file)
                {
                    $path = $file->store('public/imageproduct');
                    $name = $file->getClientOriginalName();
                    $insert[$key]['image'] = $path;
                    $insert[$key]['product_id'] = $request->product_id;
                }
             }
            $saveimage = ImageProduct::insert($insert);
     
        if($saveimage){
         return redirect()->route('imageproduct.index')->with(['success' => 'Data Berhasil Disimpan!']);
     }else{
         
         return redirect()->route('imageproduct.index')->with(['error' => 'Data Gagal Disimpan!']);
     }
}

public function edit(ImageProduct $imageproduct)
{
    return view('pages.admin.image_product.edit', compact('imageproduct'));
}

public function update(Request $request, ImageProduct $imageproduct)
{
    $rules = [
        'image' => 'required|image|file|max:1024|mimes:png,jpg,jpeg',
        'name'  => 'required',
    ];
    
    $validatedData = $request->validate($rules);

    if  ($request->file('image')) {
        if ($request->oldImage){
            Storage::delete($request->oldImage);
        }
        $validatedData['image'] = $request->file('image')->store('product');
    }
    //get data Image Product by ID
    $update = ImageProduct::where('id', $imageproduct->id)->update($validatedData);

    if($update){
        //redirect dengan pesan sukses
        return redirect()->route('imageproduct.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('imageproduct.index')->with(['error' => 'Data Gagal Diupdate!']);
    }
}

public function destroy($id)
{
    $data = ImageProduct::where('id',$id)->first();
	Storage::delete($data->oldImage);
 
	// hapus data
	ImageProduct::where('id',$id)->delete();
 
	return redirect()->back();


}
// public function destroy($id)
// {
//   $data = ImageProduct::findOrFail($id);
//   Storage::disk('local')->delete('public/imageproduct/'.$data->image);
//   $data->delete();

//   if($data){
//      //redirect dengan pesan sukses
//      return redirect()->route('imageproduct.index')->with(['success' => 'Image Product has been deleted!']);
//     }else{
//         return redirect()->route('imageproduct.index')->with(['error' => 'Image Product has not deleted!']);
//     }
// }
}
