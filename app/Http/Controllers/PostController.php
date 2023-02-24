<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{

    protected $postService;
    /**
     * Display a listing of the resource.
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return PostCollection::collection($result['data']);
        // return response()->json($result, $result['status']);
    }

    public function searchPost(Request $request)
    {
        $key = $request->searchData;
        try {
            $result['searchData'] = $this->postService->searchPost($key);
            return PostCollection::collection($result['searchData']);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        // return PostCollection::collection($result['data']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        $data = $request->only([
            'title',
            'content'
        ]);

        try {
            $result['data'] = $this->postService->savePostData($data);
            return new PostCollection($result);

        } catch (Exception $e) {
            $result =[
                'status' => 500,
                'error' => $e->getMessage()->first(),
            ];
             return new PostCollection($result);
        }
        // return response()->json($result, $result['status']);
        // return new PostCollection($result);

    }

    /**
     * Display the specified resource.
     */
    public function editForm($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->getOne($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return new PostCollection($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePost(Request $request, $id)
    {
        $data = $request->only([
            'title',
            'content'
        ]);

        try {
            $result['data'] = $this->postService->updatePostData($id, $data);
            return new PostCollection($result);

        } catch (Exception $e) {
            $result =[
                'status' => 500,
                'error' => $e->getMessage()->first(),
            ];
             return new PostCollection($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {   
        Post::destroy($id);
        // dd($post);
        return response()->json('The post successfully deleted');
    }
}
