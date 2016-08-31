<?php
/**
 * Builder pattern example
 *
 * @author Albert Colom <skolom@gmail.com>
 * @see https://en.wikipedia.org/wiki/Builder_pattern
 */

interface BuilderInterface
{
    public function createVehicle();
    public function setEngine();
    public function setWheel();
    public function getVehicle();
}

class Director
{
    public function build(BuilderInterface $builder)
    {
        $builder->createVehicle();
        $builder->setWheel();
        $builder->setEngine();

        return $builder->getVehicle();
    }
}

class Vehicle
{
    protected $parts;

    public function setPart($type, $value)
    {
        $this->parts[$type] = $value;
    }

    public function getParts()
    {
        return $this->parts;
    }
}

class Car extends Vehicle
{

}

class Bike extends Vehicle
{

}

class CarBuilder implements BuilderInterface
{
    protected $car;

    public function createVehicle()
    {
        $this->car = new Car();
    }

    public function setEngine()
    {
        $this->car->setPart('engine', 1);
    }

    public function setWheel()
    {
        $this->car->setPart('wheel', 4);
    }

    public function getVehicle()
    {
        return $this->car;
    }
}

class BikeBuilder implements BuilderInterface
{
    protected $bike;

    public function createVehicle()
    {
        $this->bike = new Bike();
    }

    public function setEngine()
    {
        $this->bike->setPart('engine', 0);
    }

    public function setWheel()
    {
        $this->bike->setPart('wheel', 2);
    }

    public function getVehicle()
    {
        return $this->bike;
    }
}

$shop = new Director();

$carBuilder = new CarBuilder();
$car = $shop->build($carBuilder);
print_r($car->getParts());

$bikeBuilder = new BikeBuilder();
$bike = $shop->build($bikeBuilder);
print_r($bike->getParts());
