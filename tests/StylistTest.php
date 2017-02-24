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

        function test_find()
        {
            $name = "Claire";
            $id = null;
            $name2 = "Johnny";
            $id2 = null;

            $stylist = new Stylist ($name, $id);
            $stylist->save();
            $stylist2 = new Stylist($name2, $id2);
            $stylist2->save();
            //Act
            $result = Stylist::find($stylist2->getid());

            //Assert
            $this->assertEquals($stylist2, $result);

        }

        function test_find_by_name()
        {
            $name = "Claire";
            $id = null;
            $name2 = "Johnny";
            $id2 = null;

            $stylist = new Stylist ($name, $id);
            $stylist->save();
            $stylist2 = new Stylist($name2, $id2);
            $stylist2->save();
            //Act
            $result = Stylist::findByName($stylist2->getName());

            //Assert
            $this->assertEquals($stylist2, $result);

        }

        function test_edit()
        {
            $name = "Claire";
            $id = null;
            $new_name= "Johnny";

            $stylist = new Stylist ($name, $id);
            $stylist->save();

            //Act
            $stylist->update($new_name);

            //Assert
            $result = Stylist::findByname($new_name);
            $this->assertEquals($stylist, $result);

        }

        function test_delete()
        {
            $name = "Claire";
            $id = null;
            $name2 = "Johnny";
            $id2 = null;

            $stylist = new Stylist ($name, $id);
            $stylist->save();
            $stylist2 = new Stylist($name2, $id2);
            $stylist2->save();
            //Act
            $stylist->delete();

            //Assert
            $result = Stylist::getAll();
            $this->assertEquals([$stylist2], $result);

        }

    }


?>
