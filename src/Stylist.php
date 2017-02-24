<?php
    class Stylist{

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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylist (name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function find($id)
        {
            $stylists = $GLOBALS['DB']->query("SELECT * FROM stylist WHERE id = {$id}");
            foreach ($stylists as $stylist) {
                $new_stylist = new Stylist($stylist['name'], $stylist['id']);
                return $new_stylist;
            }
        }

        static function findByName($name)
        {
            $stylists = $GLOBALS['DB']->query("SELECT * FROM stylist WHERE name = '{$name}'");
            foreach ($stylists as $stylist) {
                $new_stylist = new Stylist($stylist['name'], $stylist['id']);
                return $new_stylist;
            }
        }

        static function getAll()
        {
            $stylists = $GLOBALS['DB']->query("SELECT * FROM stylist;");
            $output = array();

            foreach ($stylists as $stylist) {
                $new_stylist = new Stylist($stylist['name'], $stylist['id']);
                array_push($output, $new_stylist);
            }

            return $output;

        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylist;");
        }
    }
?>
