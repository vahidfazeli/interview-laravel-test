<?php


namespace App\Repositories;

use App\Model\Order;
use App\Model\OrderItem;
use App\Model\Restaurant;

class OrderItemRepository extends AbstractRepository
{
    public function paginate(Order $order= null)
    {
        return $order->orderItems()->paginate();
    }

    public function create(Order $order,  array $data)
    {
        return $order->orderItems()->create($data);
    }

    public function remove(OrderItem $orderItem)
    {
        return $orderItem->delete();
    }

    public function update(OrderItem $orderItem, $attributes)
    {
        return $orderItem->update($attributes);
    }

    public function findByOrder(Order $order, $id)
    {
        return $order->orderItems()->find($id);
    }

}
