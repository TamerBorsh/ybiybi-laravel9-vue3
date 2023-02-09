<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Product;
use App\Trait\ImageTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    use ImageTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = Product::select('id', 'name', 'vendor_id', 'reseller_id', 'attachment_id', 'created_at')->with(['vendor:id,full_name', 'reseller:id,full_name', 'attachment:id,url'])->whereDubbing('1')->where('isAvailableDubbing','1')->orderByDesc('id')->get();
        return response()->json(['products' => $data], Response::HTTP_OK);
    }

    public function UploadByDubbed(Request $request)
    {
        if ($request->hasFile('file')) {
            return response()->json($request->all());
            // $attachment = Attachment::create([
            //     'url'     =>  url('/images/uploads/product/') . '/' . $this->SaveImage($request->file('file'), 'images/uploads/product/'),
            //     'type' => 'video'
            // ]);

            // $product = Product::findOrFail($request->id);
            // $product->attachment_id = $attachment->id;
            // $product->update();
        }
    }

}
