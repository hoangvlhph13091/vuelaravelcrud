<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;

class ProdController extends Controller
{
    protected $productService;
    /**
     * Display a listing of the resource.
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index() {
        $products = Product::with('post:id,title')->paginate(5);
        return ProductResource::collection($products)->response()->getData(true);
        // return response()->json($products);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function add(ProductRequest $request)
    {
        $data = $request->except(['_token']);
        try {
             $result = $this->productService->saveProductData($data);
        } catch (Exception $e) {
            return $result = $e->getMessage();
        }
        return new ProductResource($result); 
       

    }


}
