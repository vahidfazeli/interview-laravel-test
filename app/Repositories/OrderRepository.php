<?php
/**
 * Created by PhpStorm.
 * User: amir
 * Date: 11/25/18
 * Time: 12:18 PM
 */

namespace App\Repositories;

use App\Model\Order;
use App\Model\Restaurant;

class OrderRepository extends AbstractRepository
{
    public function paginate(Restaurant $restaurant= null)
    {
        return $restaurant->orders()->paginate();
    }

    public function create(Restaurant $restaurant, array $data)
    {
        return $restaurant->orders()->create($data);
    }


    public function remove(Order $order)
    {
        return $order->delete();
    }

    public function update(Order $order, $attributes)
    {
        return $order->update($attributes);
    }

    public function findByRestaurant(Restaurant $restaurant, $id)
    {
        return $restaurant->orders()->find($id);
    }

}
