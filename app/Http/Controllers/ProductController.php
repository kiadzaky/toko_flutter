<?php

namespace App\Http\Controllers;
use App\Models\ProductModel as PM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    public function index()
    {
        $post = PM::all();
        return response()->json([
            'success' => true,
            'messages'=>'Daftar Semua Produk',
            'data'=>$post,

        ], 200);
    }

    /*
    Kolomnya
    id AI, name string, description string, price decimal, image_url string

    */

    public function show($id)
    {
        $product = PM::find($id);
        $data = [
            'data' => $product
        ];
        return response()->json($data, 200, );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'price'=>'required',
            'image_url'=>'required'
        ]);
        if($validator->fails()){
            $data = [
                'fail'=>true,
                'messages'=>'Semua Data Wajib Diisi',
                'data'=>$validator->errors()
            ];
            return response()->json($data, 401, );
        }else{
            $product = PM::create($request->all());
            if($product){
                $data = [
                    'success'=>true,
                    'messages'=>'berhasil tambah data',
                    'data' => $request->all()
                ];
                return response()->json($data, 200, );
            }else{
                $data = [
                    'messages'=>'gagal tambah data'
                ];
                return response()->json($data, 400,);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $product = PM::find($id);
        $product->update($request->all());
        $data = [
            'success'=>true,
            'messages'=>'Berhasil Ubah data',
            'data'=>$product,
        ];
        return response()->json($data, 200);
    }
    public function destroy($id)
    {
        $product = PM::find($id);
        $product->delete();
        $data = [
            'success'=>true,
            'messages'=>'Berhasil Hapus data',
        ];
        return response()->json($data, 200);
    }
}
