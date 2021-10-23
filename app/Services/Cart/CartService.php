<?php

namespace App\Services\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CartService
{
    protected Collection $cart;

    public function __construct()
    {
        $this->cart = session()->get('cart') ?? collect([]);
    }

    /**
     * @param array $value
     * @param null $obj
     * @return $this
     */
    public function put(array $value , $obj = null): static
    {
        if($obj instanceof Model) {
            $value = array_merge($value , [
                'id' => Str::random(10),
                'subject_id' => $obj->id,
                'subject_type' => get_class($obj),
            ]);
        } elseif(!isset($value['id'])) {
            $value = array_merge($value , [
                'id' => Str::random(10)
            ]);
        }

        $this->cart->put($value['id'] , $value);
        session()->put('cart' , $this->cart);

        return $this;
    }

    public function has($key): bool
    {
        if($key instanceof Model) {
            return ! is_null(
                $this->cart->where('subject_id' , $key->id)->where('subject_type' , get_class($key))->first()
            );
        }

        return ! is_null(
            $this->cart->firstWhere('id' , $key)
        );
    }

    public function get($key, $withRelationship = true)
    {
        $item = $key instanceof Model
            ? $this->cart->where('subject_id' , $key->id)->where('subject_type' , get_class($key))->first()
            : $this->cart['items']->firstWhere('id' , $key);

        return $withRelationship ? $this->withRelationshipIfExist($item) : $item ;
    }

    public function all(): Collection
    {
        return $this->cart->map(function($item) {
            return $this->withRelationshipIfExist($item);
        });
    }

    protected function withRelationshipIfExist($item)
    {
        if(isset($item['subject_id']) && isset($item['subject_type'])){
            $class = $item['subject_type'];
            $subject = (new $class())->find($item['subject_id']);
            $item[strtolower(class_basename($class))] = $subject;
            unset($item['subject_id']);
            unset($item['subject_type']);
            return $item;
        }
        return $item;
    }

//
//    public function update($key, $options)
//    {
//        $item = collect($this->get($key, false));
//
//        if(is_numeric($options)){
//            $item = $item->merge([
//                'quantity' => $item['quantity'] + $options
//            ]);
//        }
//
//        if(is_array($options)){
//            $item = $item->merge($options);
//        }
//
//        $this->put($item->toArray());
//
//        return $this;
//    }
//
//    public function count($key)
//    {
//        if(! $this->has($key)) return 0;
//
//        return $this->get($key)['quantity'];
//    }
//


//
//    public function delete($key)
//    {
//        if($this->has($key)){
//            $this->cart['items'] = collect($this->cart['items'])->filter(function ($item) use ($key){
//                if($key instanceof Model){
//                    return ( $item['subject_id'] != $key->id && $item['subject_type'] != get_class($key) );
//                }
//
//                return $key != $item['id'];
//            });
//
//            session()->put('cart', $this->cart);
//            return true;
//        }
//
//        return false;
//    }
//

//
//    public function flush()
//    {
//        $this->cart = collect([
//            'items' => [],
//            'discount' => null
//        ]);
//        session()->put('cart' , $this->cart);
//
//        return $this;
//    }
//
//    protected function withRelationshipIfExist($item)
//    {
//        if(isset($item['subject_id']) && isset($item['subject_type'])){
//            $class = $item['subject_type'];
//            $subject = (new $class())->find($item['subject_id']);
//            $item[strtolower(class_basename($class))] = $subject;
//            unset($item['subject_id']);
//            unset($item['subject_type']);
//            return $item;
//        }
//        return $item;
//    }
//
//    public function addDiscount($discount)
//    {
//        $this->cart['discount'] = $discount;
//        session()->put('cart' , $this->cart);
//    }
//
//    public function getDiscount()
//    {
//        return Discount::where('code', $this->cart['discount'])->first();
//    }
//
//    public function instance()
//    {
//        $cart = session()->get('cart');
//        $this->cart = $cart ? $cart : collect([
//            'items' => [],
//            'discount' => null
//        ]);
//
//        return $this;
//    }
//
//    protected function checkDiscountValidate($item, $discount)
//    {
//        $discount = Discount::where('code', $discount)->first();
//        if($discount){
//            if( ( ! $discount->products->count() && ! $discount->categories->count()) ||
//                in_array( $item['product']->id , $discount->products->pluck('id')->toArray()) ||
//                array_intersect($item['product']->categories->pluck('id')->toArray(), $discount->categories->pluck('id')->toArray())
//            )
//            {
//                $item['discount_percent'] = $discount->percent / 100 ;
//            }
//        }
//
//        return $item;
//    }
}
