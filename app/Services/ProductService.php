<?php

namespace App\Services;

use App\Repository\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ProductService
{
    /**
     * @var $productRepository
     */
    protected $productRepository;

    /**
     * PostService constructor
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function saveProductData($data)
    {
            $path = $data['image']->store('public/image/');
            $data['image'] = $path;
            $result = $this->productRepository->save($data);
            return $result;

    }

    public function updatePordData($id, $data)
    {
        return $this->productRepository->updateProduct($id, $data);
    }

    public function getAll()
    {
        // return $this->productRepository->getAll();
    }

    public function searchPost($key)
    {
        // return $this->productRepository->searchPost($key);
    }

    public function getOne($id)
    {
        return $this->productRepository->getOne($id);
    }
}

