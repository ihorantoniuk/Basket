<!DOCTYPE html>
<html>
<body>
<?php


class Product
{
    public $name;
    public $code;
    public $price;
}

interface IBasket {
    public function TotalSumWithDiscounts($product) : float;
    public function TotalSumWithDeliveryPayment($min, $max, $paymentMin, $paymentMax, $sum): float;
    public function Add($product);
    public function TotalFinal(): float;
}

class Basket implements IBasket
{
    // Properties
    public array $products = array();

    // Methods
    //TotalSumWithDeliveryPayment params:
    //$Min - max amount of spending for $paymentMax rate applied
    //$Max - Min amount of spending for 0 rate applied
    //$paymentMin - rate applied (between $max and $min spending)
    //$paymentMax - rate applied for below $min spending
    //$sum - the sum to be evaluated.

    public function TotalSumWithDeliveryPayment($min, $max, $paymentMin, $paymentMax, $sum): float
    {
        if($sum >= $max) return $sum;
        if($sum <= $min) return $sum + $paymentMax;
        if($sum > $min) return $sum + $paymentMin;
    }

    //TotalSumWithDiscounts params:
    //$product - product which can be considered to get discount for buying the same products many times

    public function TotalSumWithDiscounts($product): float
    {
        // TODO: Implement TotalSumWithDiscounts() method. - buy one red widget,
        //get the second half price”
        $sum = 0;
        $numOfEquals = 0;
        $discount = 0;

        foreach($this->products as $prod)
        {
            if(strcmp($prod->code, $product->code) == 0)//get number of the same discounted product
            {
               $numOfEquals++;
            }
            $sum += $prod->price;
        }
        if($numOfEquals <= 1)
            return $sum;// No discount
        if(($numOfEquals %2) == 0)
        {
          $discount = ($product->price / 2) * $numOfEquals / 2;
        }
        else
        {
            $discount = ($product->price / 2) * ($numOfEquals - 1) / 2;
        }
        return $sum - $discount;
    }

    //Add params:
    //$product - product to be added for the basket

    public function Add($product)
    {
        $this->products[] = $product;
    }

    public function TotalFinal(): float // get final Total for the basket
    {
        $product = new Product();// Sample discounted goods
        $product->name = "Red car";
        $product->code = "R01";
        $product->price = 32.95;

        $sum = $this->TotalSumWithDiscounts($product);
        return $this->TotalSumWithDeliveryPayment(50, 90, 2.95, 4.95, $sum);

    }
}

Echo "<br />";
Echo "Test for B01, B01, R01, R01, R01 buying: \n";
$basket1 = new Basket();

$product = new Product();
$product->name = "Red car";
$product->code = "R01";
$product->price = 32.95;
$basket1->Add($product);

$product = new Product();
$product->name = "Red car";
$product->code = "R01";
$product->price = 32.95;
$basket1->Add($product);

$product = new Product();
$product->name = "Red car";
$product->code = "R01";
$product->price = 32.95;
$basket1->Add($product);


$product= new Product();
$product->name = "Blue car";
$product->code = "B01";
$product->price = 7.95;
$basket1->Add($product);

$product= new Product();
$product->name = "Blue car";
$product->code = "B01";
$product->price = 7.95;
$basket1->Add($product);


echo $basket1->TotalFinal();


$basket2 = new Basket();
Echo "<br />";
Echo "\nTest for B01, G01 buying: \n";


$product = new Product();
$product->name = "Blue car";
$product->code = "B01";
$product->price = 7.95;
$basket2->Add($product);


$product= new Product();
$product->name = "Green car";
$product->code = "G01";
$product->price = 24.95;
$basket2->Add($product);


echo $basket2->TotalFinal();

$basket3 = new Basket();
Echo "<br />";
Echo "\nTest for R01, R01 buying: \n";


$product = new Product();
$product->name = "Red car";
$product->code = "R01";
$product->price = 32.95;
$basket3->Add($product);

$product = new Product();
$product->name = "Red car";
$product->code = "R01";
$product->price = 32.95;
$basket3->Add($product);

echo $basket3->TotalFinal();

Echo "<br />";
Echo "\nTest for R01, G01 buying: \n";

$basket4 = new Basket();

$product = new Product();
$product->name = "Red car";
$product->code = "R01";
$product->price = 32.95;
$basket4->Add($product);

$product = new Product();
$product->name = "Green car";
$product->code = "G01";
$product->price = 24.95;
$basket4->Add($product);

echo $basket4->TotalFinal();


?>

</body>
</html>
