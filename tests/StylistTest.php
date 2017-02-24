<?php
    require_once 'src/Stylist.php';
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);



    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
        }

        function test_save()
        {
            $name = "Claire";
            $id = null;

            $stylist = new Stylist ($name, $id);

            //Act
            $stylist->save();

            //Assert
            $result = Stylist::getAll();
            $this->assertEquals([$stylist], $result);

        }

    }


?>
