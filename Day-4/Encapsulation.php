<?php

class BankAccount{
    private $balance = 1;
    public function deposit($amount){
        $this->balance += $amount;
    }
    public function getBalance(){
        return $this->balance;
    }
}
$account = new BankAccount();
$account->deposit(100);
echo $account->getBalance();
echo "<br>";

?>