<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $extraCost = 0;
    public $cupon_applied = false;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->extraCost = $oldCart->extraCost;
            $this->cupon_applied = $oldCart->cupon_applied;
        }
    }

    public function add($item, $id, $extra_cost_exist) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item, 'discount' => 0];
        if ($this->items) {
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }else {
                $this->extraCost += $extra_cost_exist;
            }
        }else {
            $this->extraCost += $extra_cost_exist;
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'] * ((100 - $storedItem['discount']) / 100);
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price * ((100 - $storedItem['discount']) / 100);
    }

    public function updateItem($item, $id, $qty, $extra_cost_exist, $stock) {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                if ($qty > $this->items[$id]['qty']){
                    if ($qty > $stock){
                        $qty = $stock;
                    }
                    $newQty = $qty - $this->items[$id]['qty'];
                    $storedItem = ['qty' => $qty, 'price' => $item->price, 'item' => $item, 'discount' => $this->items[$id]['discount']];
                    $storedItem['price'] = $item->price * $storedItem['qty'] * ((100 - $storedItem['discount']) / 100);
                    $this->items[$id] = $storedItem;
                    $this->totalQty += $newQty;
                    $this->totalPrice += $item->price * $newQty * ((100 - $storedItem['discount']) / 100);             
                }else {
                    $newQty = $this->items[$id]['qty'] - $qty;  
                    $storedItem = ['qty' => $qty, 'price' => $item->price, 'item' => $item, 'discount' => $this->items[$id]['discount']];
                    $storedItem['price'] = $item->price * $storedItem['qty'] * ((100 - $storedItem['discount']) / 100);
                    $this->items[$id] = $storedItem;   
                    $this->totalQty -= $newQty;
                    $this->totalPrice -= $item->price * $newQty * ((100 - $storedItem['discount']) / 100);
                }
            }
            if ($this->items[$id]['qty'] < 1) {
                $this->extraCost -= $extra_cost_exist;
                unset($this->items[$id]);
            }
        }
        
    }

    public function addManyItem($item, $id, $qty, $extra_cost_exist) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item, 'discount' => 0];
        if ($this->items) {
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
                if ($this->items[$id]['qty']  + $qty >= $item->productStokc->stock) {
                    $qty = 0;
                    $storedItem['qty'] =  $item->productStokc->stock;
                }
                $storedItem['qty'] += $qty;
                $storedItem['price'] = $item->price * $storedItem['qty'] * ((100 - $storedItem['discount']) / 100);
                $this->items[$id] = $storedItem;
                $this->totalQty += $qty;
                $this->totalPrice += $item->price * $qty * ((100 - $storedItem['discount']) / 100);
            }else {
                $this->extraCost += $extra_cost_exist;
                $storedItem['qty'] += $qty;
                $storedItem['price'] = $item->price * $storedItem['qty'] * ((100 - $storedItem['discount']) / 100);
                $this->items[$id] = $storedItem;
                $this->totalQty += $qty;
                $this->totalPrice += $this->items[$id]['price'] * ((100 - $storedItem['discount']) / 100);
            }
        }else {
            $this->extraCost += $extra_cost_exist;
            $storedItem['qty'] += $qty;
            $storedItem['price'] = $item->price * $storedItem['qty'] * ((100 - $storedItem['discount']) / 100);
            $this->items[$id] = $storedItem;
            $this->totalQty += $qty;
            $this->totalPrice += $this->items[$id]['price'] * ((100 - $storedItem['discount']) / 100);
        }
        
    }

    public function discountItems($cupon, $item_on_discount) {
        if ($this->items){
            $id = $item_on_discount['id'];
            $price = $item_on_discount['price'];
            $this->items[$id]['price'] = $price * $this->items[$id]['qty'] * ((100 - $cupon->discount) / 100);
            $this->totalPrice -= $price * $this->items[$id]['qty'] * ($cupon->discount / 100);
            $this->items[$id]['discount'] = $cupon->discount;
            $this->cupon_applied = true;
        }
    }

    public function restoreCart($item, $id, $qty, $extra_cost_exist) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item, 'discount' => 0];
        if ($this->items) {
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] += $qty;
        $storedItem['price'] = $item->price * $storedItem['qty'] * ((100 - $storedItem['discount']) / 100);
        $this->items[$id] = $storedItem;
        $this->extraCost += $extra_cost_exist;
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['price'] * ((100 - $storedItem['discount']) / 100);
    }

    public function removeItem($id, $extra_cost_exist) {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        $this->extraCost -= $extra_cost_exist;
        unset($this->items[$id]);
    }
}