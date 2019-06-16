<?php

namespace App\Providers;

use App\Infrastructure\Notifications\Providers\FirstProvider;
use App\Infrastructure\Notifications\Providers\SecondProvider;
use App\Infrastructure\Notifications\SendSMS;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\Product;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Model\Restaurant;
use App\Repositories\RestaurantRepository;
use App\Model\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $environment = $this->app->environment();

        if ($environment == 'testing' || $environment == 'local' || $environment == 'development') {
            $this->app->bind(SendSMS::class, FirstProvider::class);
        } else {
            $this->app->bind(SendSMS::class, SecondProvider::class);
        }

        $this->app->bind(RestaurantRepository::class, function ($app) {
            return new RestaurantRepository(Restaurant::class);
        });

        $this->app->bind(ProductRepository::class, function ($app) {
            return new ProductRepository(Product::class);
        });

        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(User::class);
        });

        $this->app->bind(OrderRepository::class, function ($app) {
            return new OrderRepository(Order::class);
        });

        $this->app->bind(OrderItemRepository::class, function ($app) {
            return new OrderItemRepository(OrderItem::class);
        });
    }
}
