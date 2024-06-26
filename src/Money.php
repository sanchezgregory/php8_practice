<?php

namespace App;
class Money {
    const string CURRENT_CURRENCY = 'USD';
    public function __construct(private readonly string $amount, private readonly string $currency = self::CURRENT_CURRENCY) {}
    public function add(Money $money): Money
    {
        $this->assertSameCurrency($money);
        $newAmount = bcadd($this->amount, $money->amount, 2);
        return new Money($newAmount, $this->currency);
    }
    public function multiply(Money $money): Money
    {
        $this->assertSameCurrency($money);
        $newAmount = bcmul($this->amount, $money->amount, 2);
        return new Money($newAmount, $this->currency);
    }
    public function sub(Money $money): Money
    {
        $this->assertSameCurrency($money);
        $newAmount = bcsub($this->amount, $money->amount, 2);
        return new Money($newAmount, $this->currency);
    }
    public function div(Money $money): Money
    {
        $this->assertSameCurrency($money);
        $newAmount = bcdiv($this->amount, $money->amount, 2);
        return new Money($newAmount, $this->currency);
    }
    public function getAmount(): string
    {
        return $this->currency . ' ' . $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getMoneyInCents(): int
    {
        $decimals = strpos($this->amount, '.');
        if ($decimals !== false) {
            return (int) str_replace('.', '', $this->amount);
        }
        return (int) $this->amount * 100;
    }

    private function assertSameCurrency(Money $money): void {
        if ($this->currency !== $money->currency) {
            throw new \InvalidArgumentException('Currencies must be the same.');
        }
    }
}

$a = new Money('2300.55');
$adding = new Money('1000');
$total = $a->add($adding);
echo $total->getAmount();
echo '<br> Currency: ' . $total->getCurrency();
echo '<br> Money in cents: ' . $total->getMoneyInCents();

echo '<br>-----------------------------------------<br>';
$a = new Money('2300');
echo $a->getAmount() . '<br>';
$adding = new Money('55');
$total = $a->add($adding);
echo $total->getAmount();
echo '<br> Currency: ' . $total->getCurrency();
var_dump($total->getMoneyInCents());

echo '<br>-----------------------------------------<br>';
$a = new Money('15');
echo $a->getAmount();
echo '<br> Currency: ' . $a->getCurrency();
var_dump($a->getMoneyInCents());