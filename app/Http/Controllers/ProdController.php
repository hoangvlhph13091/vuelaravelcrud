<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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

    public function index()
    {
        $allproducts = Product::with('post:id,title')->paginate(5);
        $products = ProductResource::collection($allproducts)->response()->getData(true);
        return Inertia::render('Products/productIndex',[
            'products' => $products,
        ]);
    }

    // public function show()
    // {
    //     $products = Product::with('post:id,title')->paginate(5);
    //     return ProductResource::collection($products)->response()->getData(true);
    // }

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

    public function editForm($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->getOne($id);
            return new ProductResource($result['data']);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
            return response()->json()->getData(true);

        }
    }

    public function updatePord(ProductRequest $request, $id)
    {
        $data = $request->except(['_token']);

        try {
            $result['data'] = $this->productService->updatePordData($id, $data);
            return new ProductResource($result['data']);

        } catch (Exception $e) {
            $result =[
                'status' => 500,
                'error' => $e->getMessage()->first(),
            ];
             return new ProductResource($result);
        }
    }

    public function delete($id)
    {
        Product::destroy($id);
        return response()->json('The post successfully deleted');
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

                unlink($path);

            return response()->json()->getData(true);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }


    }

    public function export(){
        $fileName = 'product.csv';
        $products = Product::all();

             $headers = array(
                 "Content-type"        => "text/csv",
                 "Content-Disposition" => "attachment; filename=$fileName",
                 "Pragma"              => "no-cache",
                 "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                 "Expires"             => "0"
             );

             $columns = array('name', 'price', 'image', 'postID', 'content');

             $callback = function() use($products, $columns) {
                 $file = fopen('php://output', 'w');
                 fputcsv($file, $columns);

                 foreach ($products as $prod) {
                     $row['name']  = $prod->name;
                     $row['price']    = $prod->price;
                     $row['image']    = $prod->image;
                     $row['postID']  = $prod->postID;
                     $row['content']  = $prod->content;

                     fputcsv($file, array($row['name'], $row['price'], $row['image'], $row['postID'], $row['content']));
                 }

                 fclose($file);
             };

             return response()->stream($callback, 200, $headers);


        }


}
