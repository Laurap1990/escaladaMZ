<?php
    use PHPUnit\Framework\TestCase;
    class PageTest extends TestCase{
            public function testGreeting()
            {
                    ob_start();
                    require_once 'funciones.php';
                    $this->assertEquals(sesionUsuario($db));
            }
        }
?>