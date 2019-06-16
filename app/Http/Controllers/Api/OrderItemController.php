<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Repositories\OrderItemRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderItemController extends Controller
{

    /**
     * OrderItemController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Order $order
     * @param OrderItemRepository $repository
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Order $order, OrderItemRepository $repository)
    {
        return $repository->paginate($order);
    }

    /**
     * @param Order $order
     * @param OrderItemRepository $repository
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Order $order, OrderItemRepository $repository, Request $request)
    {
        $data = $request->request->all();
        return $repository->create($order, $data);
    }

    /**
     * @param Order $order
     * @param OrderItemRepository $repository
     * @param $orderItem
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function show(Order $order, OrderItemRepository $repository, $orderItem)
    {
        $orderItem = $repository->findByOrder($order, $orderItem);

        if (!$orderItem) {
            throw new NotFoundHttpException();
        }

        return $orderItem;
    }

    /**
     * @param Order $order
     * @param OrderItemRepository $repository
     * @param $orderItem
     * @param Request $request
     * @return Order
     */
    public function update(Order $order, OrderItemRepository $repository, $orderItem, Request $request)
    {
        $orderItem = $repository->findByOrder($order, $orderItem);

        if (!$orderItem) {
            throw new NotFoundHttpException();
        }

        $repository->update($orderItem, $request->request->all());

        return $order;
    }

    /**
     * @param Order $order
     * @param OrderItemRepository $repository
     * @param $orderItem
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function destroy(Order $order, OrderItemRepository $repository, $orderItem)
    {
        $orderItem = $repository->findByOrder($order, $orderItem);

        if (!$orderItem) {
            throw new NotFoundHttpException();
        }

        $repository->remove($orderItem);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
