<?php
class Charset
{
    private array $input = [];
    public function __construct(array $input)
    {
        $this->input = $input;
    }
    public function getNewString()
    {
        if (count($this->input) > 0) {
            $num = $this->input[0];
            $end = array_pop($this->input);
            $tmp = [];
            $initial = $num+1;
            $c = 1;
            for ($i = $initial; $i < $end; $i++) {
                $num = $num + 1;
                if (isset($this->input[$c]) && $this->input[$c] !== $num && !in_array($num, $this->input)) {
                    $tmp[] = $num;
                } elseif (!isset($this->input[$c]) && !in_array($num, $this->input)) {
                    $tmp[] = $num;
                }
                $c++;
            }
            var_dump($tmp);
            $this->input = array_merge($this->input, $tmp);
        }
        sort($this->input);
        return $this->input;
    }
}

$a = new Charset([10, 12, 15, 17]);
$a->getNewString();