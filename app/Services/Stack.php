<?php

namespace App\Services;

class Stack
{
    protected $stack;
    protected $minStack;
    protected $limit;

    /**
     * Stack constructor.
     * @param int $limit
     */
    public function __construct($limit = 10)
    {
        $this->stack = array();
        $this->minStack = array();
        $this->limit = $limit;
    }

    /**
     * @param $value
     */
    public function push($value)
    {
        if (count($this->stack) < $this->limit) {
            array_unshift($this->stack, $value);

            if (count($this->minStack) == 0) {
                $min = $value;
                array_unshift($this->minStack, $min);
            }
            else {
                $min = Min($value, current($this->minStack));
                if (current($this->minStack) != $min) {
                    array_unshift($this->minStack, $min);
                }
            }

        } else {
            throw new \RuntimeException('Stack is full!');
        }
    }

    /**
     * @return mixed
     */
    public function pop()
    {
        if ($this->isEmpty()) {
            throw new \RuntimeException('Stack is empty!');
        } else {
            if(current($this->stack) == current($this->minStack)) {
                array_shift($this->minStack);
            }
            return array_shift($this->stack);
        }
    }

    /**
     * @return mixed
     */
    public function top()
    {
        return current($this->stack);
    }

    /**
     * @return mixed
     */
    public function getMin()
    {
        return current($this->minStack);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->stack);
    }
}
