<?php

class A
{
    public function aa()
    {
        echo 'a';
    }

    public function bb()
    {
        $this->a = 1;
        echo $this->a;
    }
}

// 正常
A::aa();

// PHP Fatal error:  Uncaught Error: Using $this when not in object context
A::bb();