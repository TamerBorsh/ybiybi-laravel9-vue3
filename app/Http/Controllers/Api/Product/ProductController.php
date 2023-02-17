<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Country;
use App\Models\DubbingProduct;
use App\Models\Product;
use App\Trait\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }

    public function index()
    {
        $data = Product::select('id', 'name', 'vendor_id', 'reseller_id', 'attachment_id', 'created_at')->with(['vendor:id,full_name', 'reseller:id,full_name', 'attachment:id,url'])->whereDubbing('1')->where('isAvailableDubbing', '1')->orderByDesc('id')->paginate('10');
        return response()->json(['products' => $data], Response::HTTP_OK);
    }

    //Save Request for translations
    public function confirmAddRequest(Request $request, $id)
    {
        $product = Product::whereId($id)->first();
        // return response()->json($product);
        $dubbing = DubbingProduct::whereProduct_id($product->id)->first();
        if (!$dubbing) {
            $isCreate = DubbingProduct::create([
                'translator_id' => Auth::id(),
                'product_id'    => $product->id,
            ]);
            $product->update([
                'isAvailableDubbing'=> '0'
            ]);
            if ($isCreate) {
                return response()->json(['message' => $isCreate ? __('The request has been added successfully') : 'هناك خطأ ما'], $isCreate ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' =>  __('The request has already been added') ], Response::HTTP_BAD_REQUEST);

        }
    }

    //get requests for translation
    public function getMyRequests(Request $request)
    {
        $data = DubbingProduct::with(['product:id,name', 'translator:id,name,email'])->where('translator_id', Auth::id())->orderByDesc('id')->get();
        return response()->json(['products' => $data], Response::HTTP_OK);
    }

    public function edit($id)
    {
        return Product::findorFail($id);
    }
    
    //Upload Video from translate
    public function UploadByTranslate(Request $request)
    {
        // return response()->json($request->all());

        if ($request->hasFile('file')) {
            $attachment = Attachment::create([
                'url'     =>  url('/images/uploads/translation/') . '/' . $this->SaveImage($request->file('file'), 'images/uploads/translation/'),
                'type' => 'video'
            ]);

            $product = Product::findOrFail($request->id);
            $product->translated_id = $attachment->id;
            $product->update();
            return response()->json(['message' => __('Saved successfully')]);

        }
    }



}
