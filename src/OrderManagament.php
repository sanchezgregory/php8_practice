<?php
/*
 * Vas a implementar un sistema de gestión de pedidos para una tienda en línea. La tienda vende productos y permite a los clientes realizar pedidos.
 * Cada pedido puede tener múltiples productos y diferentes estados (pendiente, procesado, enviado).

Requisitos
Productos: Implementa una clase Product con propiedades como name, price y stock.
Clientes: Implementa una clase Customer con propiedades como name y email.
Pedidos: Implementa una clase Order que contiene una lista de productos, el cliente que hizo el pedido y el estado del pedido.
Estados del Pedido: Utiliza el patrón State para manejar los diferentes estados del pedido (Pendiente, Procesado, Enviado).
Fábrica de Productos: Utiliza el patrón Factory para crear instancias de productos.
Repositorio de Pedidos: Utiliza el patrón Repository para manejar la persistencia de los pedidos.
Notificación: Utiliza el patrón Observer para notificar a los clientes cuando el estado de su pedido cambia.
 */
namespace App;
class Product {
    private $name;
    private $price;
    private $stock;

    public function __construct($name, $price, $stock)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getStock()
    {
        return $this->stock;
    }
    public function reduceStock($quantity) {
        $this->stock -= $quantity;
    }

}

class Customer {
    private $name;
    private $email;
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }

}
class Order {
    private $products = [];
    private Customer $customer;
    private OrderState $state;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
        $this->state = new PendingState($this);
    }
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }
    public function setState(OrderState $orderState)
    {
        $this->state = $orderState;
        $this->notify('stateChanged', $state);
    }
   public function process() {
        $this->state->process();
    }

    public function ship() {
        $this->state->ship();
    }
    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }
    private function notify($event, $data) {
        foreach ($this->observers as $observer) {
            $observer->update($event, $data);
        }
    }
}
interface OrderState {
    public function process();
    public function ship();
}
class PendingState implements OrderState {
    private $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function process() {
        echo "Processing order...\n";
        $this->order->setState(new ProcessedState($this->order));
    }

    public function ship() {
        echo "Cannot ship an order that is pending.\n";
    }
}
class ProcessedState implements OrderState {
    private $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function process() {
        echo "Order is already processed.\n";
    }

    public function ship() {
        echo "Shipping order...\n";
        $this->order->setState(new ShippedState($this->order));
    }
}
class ShippedState implements OrderState {
    private $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function process() {
        echo "Cannot process an order that is shipped.\n";
    }

    public function ship() {
        echo "Order is already shipped.\n";
    }
}
class ProductFactory {
    public static function createProduct($name, $price, $stock)
    {
        return new Product($name, $price, $stock);
    }
}
class OrderRepository {
    private $orders = [];
    public function addOrder(Order $order) {
        $this->orders[] = $order;
    }
    public function getOrders() {
        return $this->orders;
    }
}
interface Observer {
    public function update($event, $data);
}

class CustomerNotifier implements Observer {
    public function update($event, $data) {
        echo "Notifying customer of event: $event\n";
    }
}

$product1 = ProductFactory::createProduct('Laptop', 1500, 10);
$product2 = ProductFactory::createProduct('Mouse', 20, 100);
$customer = new Customer('John Doe', 'john@example.com');
$order = new Order($customer);
$order->addProduct($product1);
$order->addProduct($product2);
// Procesar y enviar el pedido
$order->process();
$order->ship();

