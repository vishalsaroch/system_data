<?php

CLASS Functions extends Connection {
    function getArrayOptions_All_Table($table, $columnsArray, $additionalWhereOrderby = '', $whereArray = array()){
        $columns = 'DISTINCT ul_' . implode(', ul_', $columnsArray);;
        $shoppo = $this->dbConn->prepare("SELECT
            $columns
            FROM $table
            $additionalWhereOrderby");
        $shoppo->execute($whereArray);
        if ($options = $shoppo->fetchAll(PDO::FETCH_ASSOC)) {
            return $options;
        }else{
            return false;
        }
    }
};
$function = new Functions();