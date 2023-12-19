<?php

class mainModel
{
    private $dbname = "projetweb";
    private $host = "127.0.0.1";
    private $user = "root";
    private $password = "";

    public function connect($dbname, $host, $user, $password)
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

     function disconnect(&$c)
    {
        $c = null;
    }

     function request($r)
    {  
        $c = $this->connect($this->dbname, $this->host, $this->user, $this->password);
        $request = $c->prepare($r);
        $request->execute();
        $this->disconnect($c);
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }
}
