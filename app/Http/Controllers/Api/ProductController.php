<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Restaurant;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    /**
     * @param Restaurant $restaurant
     * @param ProductRepository $repository
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Restaurant $restaurant, ProductRepository $repository)
    {
        return $repository->paginate($restaurant);
    }

    /**
     * @param Restaurant $restaurant
     * @param ProductRepository $repository
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Restaurant $restaurant, ProductRepository $repository, Request $request)
    {
        return $repository->create($restaurant, $request->request->all());
    }

    /**
     * @param Restaurant $restaurant
     * @param ProductRepository $repository
     * @param $product
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function show(Restaurant $restaurant, ProductRepository $repository, $product)
    {
        $product = $repository->findByRestaurant($restaurant, $product);

        if (!$product) {
            throw new NotFoundHttpException();
        }

        return $product;
    }

    /**
     * @param Restaurant $restaurant
     * @param ProductRepository $repository
     * @param $product
     * @param Request $request
     * @return Product
     */
    public function update(Restaurant $restaurant, ProductRepository $repository, $product, Request $request)
    {
        /** @var Product $product */
        $product = $repository->findByRestaurant($restaurant, $product);

        if (!$product) {
            throw new NotFoundHttpException();
        }

        $repository->update($product, $request->request->all());

        return $product;
    }

    /**
     * @param Restaurant $restaurant
     * @param ProductRepository $repository
     * @param $product
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function destroy(Restaurant $restaurant, ProductRepository $repository, $product)
    {
        /** @var Product $product */
        $product = $repository->findByRestaurant($restaurant, $product);

        if (!$product) {
            throw new NotFoundHttpException();
        }

        $repository->remove($product);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
