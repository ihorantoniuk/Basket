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
    public function TotalSum();
    public function TotalSumWithDiscounts($product) : float;
    public function TotalSumWithDeliveryPayment($min, $max, $paymentMin, $paymentMax, $sum): float;
    public function Add($product);
    public function TotalFinal();
}

class Basket implements IBasket
{
    // Properties
    public array $products = array();

    // Methods
    public function TotalSumWithDeliveryPayment($min, $max, $paymentMin, $paymentMax, $sum): float
    {
        if($sum >= $max) return $sum;
        if($sum <= $min) return $sum + $paymentMax;
        if($sum > $min) return $sum + $paymentMin;
    }

    public function TotalSumWithDiscounts($product): float
    {
        // TODO: Implement TotalSumWithDiscounts() method. - buy one red widget,
        //get the second half price”
        $sum = 0;
        $numOfEquals = 0;
        $discount =0;

        foreach($this->products as $prod)
        {
            if(strcmp($prod->code, $product->code) == 0)
            {
               $numOfEquals++;
            }
            $sum += $prod->price;
        }
        if($numOfEquals <= 1)
            return $sum;
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

    public function TotalSum(): float
    {
        $sum = 0;

        foreach($this->products as $prod)
        {
            $sum += $prod->price;
        }

        return $sum;
    }
    public function Add($product)
    {
        $this->products[] = $product;
    }

    public function TotalFinal()
    {
        $product = new Product();// Sample discounted goods
        $product->name = "Red car";
        $product->code = "R01";
        $product->price = 32.95;

        $sum = $this->TotalSumWithDiscounts($product);
        return $this->TotalSumWithDeliveryPayment(50, 90, 2.95, 4.95, $sum);

    }
}

$basket1 = new Basket();

$product = new Product();
$product->name = "Red car";
$product->code = "R01";
$product->price = 32.95;
$basket1->Add($product);

$product1 = new Product();
$product1->name = "Red car";
$product1->code = "R01";
$product1->price = 32.95;
$basket1->Add($product1);

$product2 = new Product();
$product2->name = "Red car";
$product2->code = "R01";
$product2->price = 32.95;
$basket1->Add($product2);


$productB1= new Product();
$productB1->name = "Blue car";
$productB1->code = "B01";
$productB1->price = 7.95;
$basket1->Add($productB1);

$productB2= new Product();
$productB2->name = "Blue car";
$productB2->code = "B01";
$productB2->price = 7.95;
$basket1->Add($productB2);


echo "Test4:";
echo $basket1->TotalFinal();


$basket2 = new Basket();

$product = new Product();
$product->name = "Blue car";
$product->code = "B01";
$product->price = 7.95;
$basket2->Add($product);


$productG1= new Product();
$productG1->name = "Green car";
$productG1->code = "G01";
$productG1->price = 24.95;
$basket2->Add($productG1);


echo "Test1:";
echo $basket2->TotalFinal();

$basket3 = new Basket();

$product = new Product();
$product->name = "Red car";
$product->code = "R01";
$product->price = 32.95;
$basket3->Add($product);

$product1 = new Product();
$product1->name = "Red car";
$product1->code = "R01";
$product1->price = 32.95;
$basket3->Add($product1);

echo "Test2:";
echo $basket3->TotalFinal();


$basket4 = new Basket();

$product = new Product();
$product->name = "Red car";
$product->code = "R01";
$product->price = 32.95;
$basket4->Add($product);

$productG1 = new Product();
$productG1->name = "Green car";
$productG1->code = "G01";
$productG1->price = 24.95;
$basket4->Add($productG1);

echo "Test3:";
echo $basket4->TotalFinal();


?>

</body>
</html>
