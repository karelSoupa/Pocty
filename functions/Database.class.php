<?php

class Database
{
    /**
     * @var mysqli
     */
    private $conn;

    //private $tableUser = 'soupak_uzivatele';
    //private $tableTest = 'soupak_testy';

    /**
     * Database constructor.
     * @param $DBConn DBConnect
     */
    public function __construct($DBConn)
    {
        $this->conn = $DBConn->getConnection();
    }

    /**
     * @param $table string
     * @param $targetValues [] string
     * target columns in a database
     * input data
     * @param $condition (s) [] string after WHERE
     * @throws Exception query error
     * @return mysqli_result
     */
    public function select($table, $targetValues, $condition)
    {

        $maxTargetValues = count($targetValues) - 1;

        $sql = "SELECT ";


        foreach ($targetValues as $key => $value) {
            $sql .= "$value";
            ($key === $maxTargetValues) ? $sql .= '' : $sql .= ',';
        }
        $sql .= ' FROM ' . "$table ";
        $sql .= "$condition";


        if (!$result = $this->conn->query($sql)) {
            throw new Exception("Při vykonávání dotazu se vyskytla chyba");

        }
        return $result;


    }

    /**
     * @param $table mysqli
     * @param $targetValues [] target columns in a database
     * @param $inputValues [] input data
     * @throws Exception query error
     * @return mysqli_result
     */
    public function insert($table, $targetValues, $inputValues)
    {
        $sql = "INSERT INTO $table ";
        $sql .= '(';
        $maxInputValues = count($inputValues) - 1;
        $maxTargetValues = count($targetValues) - 1;
        foreach ($targetValues as $key => $value) {
            $sql .= "$value";
            ($key === $maxTargetValues) ? $sql .= '' : $sql .= ',';
        }
        $sql .= ') VALUES (';
        foreach ($inputValues as $key => $value) {

            $sql .= '\'' . "$value" . '\'';
            ($key === $maxInputValues) ? $sql .= '' : $sql .= ',';
        }
        $sql .= ")";

        $result = $this->conn->query($sql);

        if (!$result) {
            echo 'chyba';
            throw new Exception("Při vykonávání dotazu se vyskytla chyba");
        }

        return $result;

    }





}
