<?php

namespace App\Services\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class Cart
 * @package App\Helpers\Cart
 * @method static bool has($key)
 * @method static Collection all();
 * @method static array get($key);
 * @method static Cart put(array $value , Model $obj = null)
// * @method static update($key, $options)
// * @method static count($product)
// * @method static instance()
// * @method static getDiscount()
// * @method static delete($id)
 */

class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }
}
