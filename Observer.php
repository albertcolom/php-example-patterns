<?php
/**
 * Observer pattern example
 *
 * @author Albert Colom <skolom@gmail.com>
 * @see https://en.wikipedia.org/wiki/Observer_pattern
 */

class User implements \SplSubject
{
    protected $name;
    protected $observers;

    public function __construct($name)
    {
        $this->observers = new \SplObjectStorage();
        $this->name = $name;
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->notify();
    }

    public function getName()
    {
        return $this->name;
    }
}

class UserObserver implements \SplObserver
{
    public function update(\SplSubject $subject)
    {
        echo get_class($subject)." updated\n";
    }
}

$subject = new User('Peter');
$observer = new UserObserver();
$subject->attach($observer);
$subject->setName('Tom');

$subject->detach($observer);
$subject->setName('Tom');
