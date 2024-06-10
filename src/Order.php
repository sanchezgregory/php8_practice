<?php

namespace App;

interface OrderState {
    public function nextState();

    public function getState(): string;
}
class PendingState implements OrderState {

    public function nextState()
    {
        return new ProcessingState();
    }

    public function getState(): string
    {
        return get_class($this);
    }
}
class ProcessingState implements OrderState {
    public function nextState()
    {
        return new ConfirmedState();
    }
    public function getState(): string
    {
        return get_class($this);
    }
}
class ConfirmedState implements OrderState {
    public function nextState()
    {
        return 'no more state';
    }
    public function getState(): string
    {
        return get_class($this);
    }
}
class Order
{
    private Cart $cart;
    private float $total;
    public OrderState $orderState;

    /**
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->orderState = new PendingState();
    }

    /**
    public function setOrderState(OrderState $state)
    {
        $this->orderState = $state;
    }
     * @return Cart
     */
    public function getCart(): Cart
    {
        return $this->cart;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        $subTotal = $this->cart->getCartCost();
        return $this->total = $subTotal;
    }

    public function changeOrderstate()
    {
        $this->orderState = $this->orderState->nextState();
        if ($this->orderState instanceof ConfirmedState) {
            $this->updateStock();
        }
    }

    public function getOrderState(): OrderState
    {
        return $this->orderState;
    }

    private function updateStock()
    {
        $products = $this->getCart()->getProductCarts();
        foreach ($products as $product) {
            /**
             * @var $product ProductCart
             */
            $stock = $product->getProduct()->getStock() - $product->getQty();
            $product->getProduct()->setStock($stock);
        }
    }
}
class Cart {
    private array|ProductCart $productCart = [];
    private Customer $customer;

    /**
     * @param ProductCart $productCart
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return array
     */
    public function getProductCarts(): array
    {
        return $this->productCart;
    }

    /**
     * @param ProductCart $productCart
     */
    public function setProductCart(ProductCart $productCart): void
    {
        $this->productCart[] = $productCart;
    }

    public function getCartCost()
    {
        $subTotal = 0;
        $products = $this->getProductCarts();
        foreach ($products as $product) {
            /**
             * @var $product ProductCart
             */
            $subTotal += $product->getProduct()->getPrice() * $product->getQty();
        }
        return $subTotal;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
class Customer {
    private $name;
    private $address;

    /**
     * @param $name
     * @param $address
     */
    public function __construct($name, $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }



}
class ProductCart {
    private Product $product;
    private int $qty;

    /**
     * @param Product $product
     * @param int $qty
     */
    public function __construct(Product $product, int $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }
}

class Product {
    private $title;
    private $price;
    private $stock;

    /**
     * @param $title
     * @param $price
     * @param $stock
     */
    public function __construct($title, $price, $stock)
    {
        $this->title = $title;
        $this->price = $price;
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }
}

$pr1 = new Product('Laptop', 990.50, 100);
$pr2 = new Product('Mouse', 9.99, 20);
$pr3 = new Product('Power supply', 55.8, 10);

$pc1 = new ProductCart($pr1, 1);
$pc2 = new ProductCart($pr2, 2);

$customer = new Customer('Gregory', 'Argentina');

$cart = new Cart($customer);
$cart->setProductCart($pc1);
$cart->setProductCart($pc2);

$order = new Order($cart);
echo "\n Total cart: " . $order->getTotal();
echo "\n " . $order->getOrderState()->getState();
$order->changeOrderstate();
echo "\n " . $order->getOrderState()->getState();
$order->changeOrderstate();
echo "\n " . $order->getOrderState()->getState();
// After shop. The stock is:
echo "\n Stock: pr1: " . $pr1->getStock();
echo "\n Stock: pr2: " . $pr2->getStock();
