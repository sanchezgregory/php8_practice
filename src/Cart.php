<?php

namespace App;
class Cart {

    private $articles = [];

    public function addCart(Article $article)
    {
        $this->articles[] = $article;
    }

    public function getCartCost()
    {
        $cost = array_reduce($this->articles, function($sum, $article) {
            return $sum + $article->getCost();
        }, 0);

        return ($cost * $this->getPromotion($cost)) / 100;
    }

    private function getPromotion($cost)
    {
        return match(true) {
            $cost >= 0 && $cost <= 999 => (new CartPromoA($cost))->getTotal(),
            $cost >= 1000 && $cost <= 1999 => (new CartPromoB($cost))->getTotal(),
        };
    }
}
class Article {
    private $title;
    private $cost;
    public function __construct($title = 'default name', $cost=0)
    {
        $this->title = $title;
        $this->cost = $cost;
    }
    public function getCost()
    {
        return $this->cost;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getArticle(): Article
    {
        return $this;
    }
}
class CartPromoA implements Promotion {
    private $cost;
    const PROMOTION = 0.25;
    public function __construct($cost)
    {
        $this->cost = $cost;
    }
    public function getTotal(): float
    {
        return $this->cost * self::PROMOTION;
    }
}
class CartPromoB implements Promotion {
    private $cost;
    const PROMOTION = 0.45;
    public function __construct($cost)
    {
        $this->cost = $cost;
    }

    public function getTotal(): float
    {
        return $this->cost * self::PROMOTION;
    }
}
interface Promotion {
    public function getTotal(): float;
}

$article1 = new Article('laptop', 1500);
$article2 = new Article('keyboard', 200);
$article3 = new Article('mouse', 130);

$cart = new Cart();
$cart->addCart($article1);
$cart->addCart($article2);
$cart->addCart($article3);
echo $cart->getCartCost();