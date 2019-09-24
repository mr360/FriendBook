<?php
///
///  IO 
///  Validate
//// Redirect??
///
const FILE_NO_EXIST = 0;

const FILE_OPEN_FAIL  = -1;
const FILE_OPEN_SUCCESS = 1;

const FILE_CLOSE_FAIL = -2;
const FILE_CLOSE_SUCCESS = 2;
const FILE_NO_OPEN_CLOSE = -3;

const FILE_WRITE_FAIL = -7;
const FILE_WRITE_SUCCESS = 7;


const VALIDATION_SUCCESS = 1;
const VALIDATION_FAIL = 0;
const JOB_ADD_SUCCESS = 5;
const JOB_ADD_FAIL = -5;
const JOB_EXIST_FAIL = -12;


class IO
{
    static function Validation($aJob, $rule)
    {
        if ($rule ===  "JOB_VALIDATION_CHECK")
        {
            return JobValidation($aJob,$rule);
        }
        if ($rule ===  "JOB_VALIDATION_SEARCH_CHECK")
        {
            return JobValidation($aJob,$rule);
        }
        return 0;
    }

    static private function JobValidation($aJob, $rule)
    {
        $lStatus = 1;
        if ($rule ===  "JOB_VALIDATION_SEARCH_CHECK")
        {
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetTitle); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetPositionType); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetCommunication); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetContract); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetLocation);

        }
        else if ($rule ===  "JOB_VALIDATION_CHECK")
        {
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetId);
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetTitle); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetDesc); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetCloseDate); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetPositionType); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetContract); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetCommunication); 
            $lStatus *= preg_match("FIX_ADD_RULE", $aJob->GetLocation);
        }
        else
        {
            $lStatus = 0;
        }

        return $lStatus; 
    }

    static function Sanitize($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    static function DecodeMsg($value)
    {
        switch($value)
        {
            case FILE_NO_EXIST : echo "The file does not exist!"; break;
            case FILE_OPEN_FAIL : echo "The file failed to be opened!"; break;
            case FILE_OPEN_SUCCESS : echo "The file opened successfully"; break;
            default : echo "Unknown msg. Please contact devs at 101119509@student.swin.edu.au!";

        }
    }
}
?>