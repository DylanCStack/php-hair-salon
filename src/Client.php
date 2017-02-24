<?php
    class Client{

        private $name;
        private $id;

        function __construct($name, $id=null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO client (name) VALUES ('{$this->getName()}')");
            $this->setId($GLOBALS['DB']->lastInsertId());
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE client SET name = '{$new_name}' WHERE id={$this->getId()};");
            $this->name = $new_name;
        }

        // function delete()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM client WHERE id={$this->getId()};");
        // }

        static function find($id)
        {
            $clients = $GLOBALS['DB']->query("SELECT * FROM client WHERE id = {$id}");
            foreach ($clients as $client) {
                $new_client = new Client($client['name'], $client['id']);
                return $new_client;
            }
        }

        static function findByName($name)
        {
            $clients = $GLOBALS['DB']->query("SELECT * FROM client WHERE name = '{$name}'");
            foreach ($clients as $client) {
                $new_client = new Client($client['name'], $client['id']);
                return $new_client;
            }
        }

        static function getAll()
        {
            $clients = $GLOBALS['DB']->query("SELECT * FROM client;");
            $output = array();

            foreach ($clients as $client) {
                $new_client = new Client($client['name'], $client['id']);
                array_push($output, $new_client);
            }

            return $output;

        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM client;");
        }
    }
?>
