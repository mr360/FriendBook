<?php
/*
* Database : A general purpose database connection. Allows for query building (child specific)  
*/
abstract class Database
{
    private $lHost;
    private $lUser;
    private $lPwd;
    private $lSqlDb;
    
    public function __construct($aHost,$aUser,$aPwd,$aSqlDb)
    {
        $this->lHost = $aHost;
        $this->lUser = $aUser;
        $this->lPwd = $aPwd;
        $this->lSqlDb = $aSqlDb;
        $this->CreateDb();
    }

    private function CreateDb()
    { 
        $lData = false;
        $lQuery = "CREATE DATABASE IF NOT EXISTS $this->lSqlDb";
        return $this->DbQuery($lQuery,$lData);
    }
    
    // If the aData variable contains a true then a result array will be 
    // delivered via aData. If not true then no data will be retrieved
    protected function DbQuery($aQuery,&$aData)
    {
        $lConn = @mysqli_connect($this->lHost,$this->lUser,$this->lPwd);
        
        $db_selected = mysqli_select_db($lConn,$this->lSqlDb);
                
        if ($lConn) 
        {		
            $lResult = mysqli_query($lConn, $aQuery);
            if ($lResult) 
            {
                if ($aData)
                {
                    $aData = array();
                    while($row = mysqli_fetch_row($lResult)) 
                    {
                        array_push($aData, $row);  
                    }
                } 
            }
            mysqli_close($lConn);
            return $lResult : true ? false;
        }
        return false;	
    }

    public function TableExist($aTable) 
    {
        $lData = false;
        $lQuery = "DESCRIBE `$aTable`";
        return $this->DbQuery($lQuery,$lData); 
    } 
}
?>
