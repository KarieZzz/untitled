<?php


class MyTest extends TestCase
{
    public function testMy()
    {

//        $ogo = $this->getMy();
//        var_dump($ogo->testPrivate());

//        $obj = new \App\Help\MyClassOne();

//        var_dump($obj->testProtected());


        $mock = Mockery::mock(\App\Help\MyClassOne::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $mock->shouldReceive('testProtected')->andReturn('mock here');
//        $mock->shouldReceive('prot')->andReturn('mock here');
//
//        var_dump($mock->testProtected());
//        var_dump($mock->testPrivate());


        $reflectionClass = new \ReflectionClass($mock);
        $prop = $reflectionClass->getProperty('_mockery_methods');
        $prop->setAccessible(true);
        $propArr = $prop->getValue();
        unset($propArr[55]);
        $prop->setValue($mock, $propArr);
        $prop->setAccessible(false);

//        $mock->shouldReceive('priv')->andReturn('aloha');
        $mock->shouldReceive('priv')->andReturnUsing(function ($data) {
//            return $data;
            $this->assertEquals('qwe', $data);
        });

        var_dump($mock->testPrivate('test'));
//        var_dump($mock->priv());

        $this->assertTrue(true);
    }

    private function getMy()
    {
        return new class extends \App\Help\MyClassOne {
            protected function prot(): int
            {
                return 1;
            }
        };
    }

}