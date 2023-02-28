<?php

namespace App\Repository;

use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductRepository
{

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function save($data)
    {
        $product = new $this->product;
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->postID = $data['postID'];
        $product->content = $data['content'];
        $product->image = $data['image'];

        $product->save();

        return $product->fresh();
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
