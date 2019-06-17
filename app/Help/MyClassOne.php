<?php

namespace App\Help;

class MyClassOne {

    public function testProtected()
    {
        return $this->prot();
    }

    protected function prot(): string
    {
        return 'prot';
    }

    public function testPrivate()
    {
        return $this->priv('qwe');
    }

    private function priv(string $s)
    {
        return 'aaa';
    }
}