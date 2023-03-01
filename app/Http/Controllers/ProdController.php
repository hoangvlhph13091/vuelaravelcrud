<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Storage;

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

    public function import(Request $request)
    {
        $data = $request->except(['_token']);
        $fileName = $data['file']->getClientOriginalName();


        $file = $data['file'];
        $file->move(public_path('/storage/file/'), $fileName);
        $path = public_path('storage/file/').$fileName;
        $path = addslashes($path);
        $time = date('Y/m/d H:i:s');

        $query1 = <<<eof
                    CREATE TEMPORARY TABLE IF NOT EXISTS tmp_products AS SELECT * FROM products LIMIT 0

                eof;
        $query2 = <<<eof
                    LOAD DATA LOCAL INFILE '$path'
                    INTO TABLE tmp_products
                    FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
                    LINES TERMINATED BY '\n'
                    IGNORE 1 LINES
                    (name,price,image,postID,content)
                    SET created_at = '$time', updated_at='$time'
                eof;
        $query3 = 'INSERT IGNORE INTO products SELECT * FROM tmp_products';
        $query4 ='DROP TEMPORARY TABLE IF EXISTS tmp_products';
        DB::beginTransaction();
        try {
                DB::statement($query1);
                DB::statement($query2);
                DB::statement($query3);
                DB::statement($query4);
                DB::commit();

                Storage::delete($path);

            return response()->json()->getData(true);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }


    }


}
