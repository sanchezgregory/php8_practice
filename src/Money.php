<?php

namespace App;
class Money {
    const string CURRENT_CURRENCY = 'USD';
    const int INTERNAL_DECIMAL = 7;
    const int EXTERNAL_DECIMAL = 2;
    public function __construct(private readonly string $amount, private readonly string $currency = self::CURRENT_CURRENCY) {}
    public function add(Money $money): Money
    {
        $this->assertSameCurrency($money);
        $newAmount = bcadd($this->amount, $money->amount, self::INTERNAL_DECIMAL);
        return new Money($newAmount, $this->currency);
    }
    public function multiply(Money $money): Money
    {
        $this->assertSameCurrency($money);
        $newAmount = bcmul($this->amount, $money->amount, self::INTERNAL_DECIMAL);
        return new Money($newAmount, $this->currency);
    }
    public function sub(Money $money): Money
    {
        $this->assertSameCurrency($money);
        $newAmount = bcsub($this->amount, $money->amount, self::INTERNAL_DECIMAL);
        return new Money($newAmount, $this->currency);
    }
    public function div(Money $money): Money
    {
        $this->assertSameCurrency($money);
        $newAmount = bcdiv($this->amount, $money->amount, self::INTERNAL_DECIMAL);
        return new Money($newAmount, $this->currency);
    }
    public function getAmount(): string
    {
        return $this->currency . ' ' . number_format($this->amount, self::EXTERNAL_DECIMAL);
    }
    public function getCurrency(): string
    {
        return $this->currency;
    }
    public function getMoneyInCents(): int
    {
        // Multiplicar por 10 elevado a EXTERNAL_DECIMAL y redondear
        $scaledAmount = bcmul($this->amount, bcpow('10', (string)self::EXTERNAL_DECIMAL, self::EXTERNAL_DECIMAL), self::INTERNAL_DECIMAL);
        // Redondear el resultado según la precisión interna
        $scaledAmount = round($scaledAmount, 0, PHP_ROUND_HALF_UP);
        return (int) $scaledAmount;
    }
    private function assertSameCurrency(Money $money): void {
        if ($this->currency !== $money->currency) {
            throw new \InvalidArgumentException('Currencies must be the same.');
        }
    }
}

$a = new Money('2300.529371');
echo '<br>'. $a->getAmount();
$adding = new Money('1000.0912895');
$total = $a->add($adding);
echo '<br>'. $total->getAmount();
echo '<br> Currency: ' . $total->getCurrency();
echo '<br> Money in cents: ' . $total->getMoneyInCents();

echo '<br>-----------------------------------------<br>';
$a = new Money('2300');
echo $a->getAmount() . '<br>';
$adding = new Money('55.199810');
$total = $a->add($adding);
echo $total->getAmount();
echo '<br> Currency: ' . $total->getCurrency();
var_dump($total->getMoneyInCents());

echo '<br>-----------------------------------------<br>';
$a = new Money('15');
echo $a->getAmount();
echo '<br> Currency: ' . $a->getCurrency();
var_dump($a->getMoneyInCents());