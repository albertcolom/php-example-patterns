<?php
/**
 * Factory Method pattern example
 *
 * @author Albert Colom <skolom@gmail.com>
 * @see https://en.wikipedia.org/wiki/Factory_method_pattern
 */

interface CarInterface
{
    public function setName($name);
}

class FamilyCar implements CarInterface
{
    protected $name;

    public function setName($name)
    {
        $this->name = $name;
    }
}

class SportsCar implements CarInterface
{
    protected $name;
    protected $speed;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setMaxSpeed($speed)
    {
        $this->speed = $speed;
    }
}

abstract class FactoryMethod
{
    abstract protected function createCar($type);

    public function create($type)
    {
        $obj = $this->createCar($type);
        $obj->setName('car name');

        return $obj;
    }
}

class MyFactory extends FactoryMethod
{
    protected function createCar($type)
    {
        switch($type) {
            case 'sport':
                return new SportsCar();
            break;
            case 'family':
                return new FamilyCar();
            break;
            default:
                throw new \InvalidArgumentException('Car type is not defined');
        }
    }
}

$shop = new MyFactory();

$familyCar = $shop->create('family');
$familyCar->setName('Citroen');
print_r($familyCar);

$sportCar = $shop->create('sport');
$sportCar->setName('Ferrari');
$sportCar->setMaxSpeed(250);
print_r($sportCar);