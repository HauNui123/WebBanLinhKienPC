<?php
class CartItem
{
    public $proid;
    public $qty;

    public function __construct($proid, $qty)
    {
        $this->proid = $proid;
        $this->qty = $qty;
    }
}
