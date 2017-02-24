<?php
    require_once 'src/Client.php';
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);



    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
        }

        function test_save()
        {
            $name = "Claire";
            $id = null;
            $stylist_id = 1;

            $client = new Client ($name,$stylist_id, $id);

            //Act
            $client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals([$client], $result);

        }

        function test_find()
        {
            $name = "Claire";
            $id = null;
            $stylist_id = 1;
            $name2 = "Johnny";
            $id2 = null;
            $stylist_id2 = 1;

            $client = new Client ($name,$stylist_id, $id);
            $client->save();
            $client2 = new Client($name2, $stylist_id2, $id2);
            $client2->save();
            //Act
            $result = Client::find($client2->getid());

            //Assert
            $this->assertEquals($client2, $result);

        }

        function test_find_by_name()
        {
            $name = "Claire";
            $id = null;
            $stylist_id = 1;
            $name2 = "Johnny";
            $id2 = null;
            $stylist_id2 = 1;

            $client = new Client ($name,$stylist_id, $id);
            $client->save();
            $client2 = new Client($name2, $stylist_id2, $id2);
            $client2->save();
            //Act
            $result = Client::findByName($client2->getName());

            //Assert
            $this->assertEquals($client2, $result);

        }

        function test_edit()
        {
            $name = "Claire";
            $id = null;
            $stylist_id = 1;
            $new_name= "Johnny";

            $client = new Client ($name,$stylist_id, $id);
            $client->save();

            //Act
            $client->update($new_name);

            //Assert
            $result = Client::findByname($new_name);
            $this->assertEquals($client, $result);

        }

        function test_delete()
        {
            $name = "Claire";
            $id = null;
            $stylist_id = 1;
            $name2 = "Johnny";
            $id2 = null;
            $stylist_id2 = 1;

            $client = new Client ($name,$stylist_id, $id);
            $client->save();
            $client2 = new Client($name2, $stylist_id2, $id2);
            $client2->save();
            //Act
            $client->delete();

            //Assert
            $result = Client::getAll();
            $this->assertEquals([$client2], $result);

        }

        //next test is get all by stylist

    }


?>
