<?php

namespace App\Http\Controllers\Api;

use App\Events\NewOrderAddedEvent;
use App\Http\Controllers\Controller;
use App\Model\Restaurant;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Restaurant $restaurant
     * @param OrderRepository $repository
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Restaurant $restaurant, OrderRepository $repository)
    {
        return $repository->paginate($restaurant);
    }

    /**
     * @param Restaurant $restaurant
     * @param OrderRepository $repository
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Restaurant $restaurant, OrderRepository $repository, Request $request)
    {
        $data = $request->request->all();
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $order = $repository->create($restaurant, $data);
        event(new NewOrderAddedEvent($user, $order));
        return $order;
    }

    /**
     * @param Restaurant $restaurant
     * @param OrderRepository $repository
     * @param $order
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function show(Restaurant $restaurant, OrderRepository $repository, $order)
    {
        $order = $repository->findByRestaurant($restaurant, $order);

        if (!$order) {
            throw new NotFoundHttpException();
        }

        return $order;
    }

    /**
     * @param Restaurant $restaurant
     * @param OrderRepository $repository
     * @param $order
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function update(Restaurant $restaurant, OrderRepository $repository, $order, Request $request)
    {
        $order = $repository->findByRestaurant($restaurant, $order);

        if (!$order) {
            throw new NotFoundHttpException();
        }

        $repository->update($order, $request->request->all());

        return $order;
    }

    /**
     * @param Restaurant $restaurant
     * @param OrderRepository $repository
     * @param $order
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function destroy(Restaurant $restaurant, OrderRepository $repository, $order)
    {
        $order = $repository->findByRestaurant($restaurant, $order);

        if (!$order) {
            throw new NotFoundHttpException();
        }

        $repository->remove($order);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
