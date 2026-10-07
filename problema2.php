<?php

class A
{
    public static function miFuncion()
    {
        echo __CLASS__;
    }

    public static function otraFuncion()
    {
        self::miFuncion();
    }
}


class B extends A
{
    public static function miFuncion()
    {
        echo __CLASS__;
    }
}

//al cambiar otraFuncion(); a miFuncion(); se cambia la letra

B::otraFuncion();

?>
