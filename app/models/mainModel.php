<?php

class mainModel
{
    private $dbname = "projetweb";
    private $host = "127.0.0.1";
    private $user = "root";
    private $password = "";

    private function connect($dbname, $host, $user, $password)
    {


        try {

            $dsn = "mysql:dbname=$dbname; host=$host";
            $c = new PDO($dsn, $this->user, $this->password);
        } catch (PDOException $exception) {
            echo "Erreur: {$exception->getMessage()}";
            exit();
        }

        return $c;
    }

    private function disconnect(&$c)
    {
        $c = null;
    }

    private function request($c, $r)
    {
        $request = $c->prepare($r);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }
}
