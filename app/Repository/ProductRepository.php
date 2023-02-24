<?php

namespace App\Repository;

use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductRepository
{

    protected $post;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function save($data)
    {
        // $post = new $this->post;

        // $post->title = $data['title'];
        // $post->content = $data['content'];

        // $post->save();

        // return $post->fresh();
    }

    public function getAll()
    {
        return $this->products->get();
    }

    public function searchPost($key)
    {
        // return $this->post->where('title', 'like', "%$key%")->get();
    }

    public function getOne($id)
    {
        // return $this->post->find($id);
    }

    public function updatePost($id, $data)
    {
        // $post = $this->post->find($id);

        // $post->title = $data['title'];
        // $post->content = $data['content'];

        // $post->save();

        // return $post->fresh();

    }
    
}
