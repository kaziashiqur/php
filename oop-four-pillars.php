<?php
// Abstraction: hiding the inner details and showing only what is needed
abstract class BankAccount {

    // Encapsulation: wrapping data and methods together in a class and restricting direct access to the data
    private float $balance;

    public function __construct(float $initialBalance) {
        $this->balance = $initialBalance;
    }

    public function deposit(float $amount) {
        $this->balance += $amount;
    }

    public function withdraw(float $amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
        } else {
            echo "Insufficient funds.";
        }
    }

    public function getBalance() {
        return $this->balance;
    }

    // Polymorphism: one method, many forms - each child class can do the same method in its own way
    abstract public function calculateInterest();
}

// Inheritance: a child class gets the properties and methods of its parent class
class savingAccount extends BankAccount {
    private float $interestRate;

    public function __construct(float $initialBalance, float $interestRate) {
        parent::__construct($initialBalance);
        $this->interestRate = $interestRate;
    }

    public function calculateInterest() {
        return $this->getBalance() * $this->interestRate;
    }
}

// Inheritance: a child class gets the properties and methods of its parent class
class checkingAccount extends BankAccount {
    public function calculateInterest() {
        return 0;
    }
}

// -- usage
$mySavings = new savingAccount(1000, 0.05);
$mySavings->deposit(500);
echo "Savings Account Balance: " . $mySavings->getBalance() . "\n";
echo "Savings Account Interest: " . $mySavings->calculateInterest() . "\n";
