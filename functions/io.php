<?php

// Constant Messages
const SUCCESS = 1;
const VALID = 1;
const EMAIL_EXIST_ALREADY = "<li>Email already exists in the system!.</li\n>";
const LOGIN_FAILED = "<li>The login credentials are not valid! </li\n>";

/*
* Io: This module supports the validation and sanitation of inputs.
*/
class IO
{
    static function Validation($aUser, $rule)
    {
        if ($rule ===  "LOGIN")
        {
            return IO::FBookValidation($aUser,$rule);
        }
        if ($rule ===  "REGISTER")
        {
            return IO::FBookValidation($aUser,$rule);
        }
        return 0;
    }

    static private function FBookValidation($aUser, $rule)
    {
        $lStatus = "";
        if ($rule ===  "REGISTER")
        {
            if (!filter_var($aUser->GetEmail(), FILTER_VALIDATE_EMAIL))
            {
                $lStatus = $lStatus ."<li> The email is not in a valid format! </li>\n";
            }

            if (!preg_match("/^[a-zA-Z]{1,20}+$/", $aUser->GetProfileName()))
            {
                $lStatus = $lStatus."<li> The profile is not in a valid format! </li>\n";
            }

            if (!preg_match("/^[a-zA-Z0-9]{1,20}+$/", $aUser->GetPassword()))
            {
                $lStatus = $lStatus."<li> The passwords is not in a valid format! </li>\n";
            }

            if ($aUser->GetPasswordConfirm() != $aUser->GetPassword())
            {
                $lStatus = $lStatus."<li> The passwords do not match! </li>\n";
            }

        }
        else if ($rule ===  "LOGIN")
        {
            if (!filter_var($aUser->GetEmail(), FILTER_VALIDATE_EMAIL))
            {
                $lStatus = $lStatus ."<li> The email is not in a valid format! </li>\n";
            }

            if (!preg_match("/^[a-zA-Z0-9]{1,20}+$/", $aUser->GetPassword()))
            {
                $lStatus = $lStatus."<li> The passwords is not in a valid format! </li>\n";
            }
        }
        else
        {
            $lStatus = ERROR_NO_SELECTION;
        }

        if ($lStatus === "")
        {
            $lStatus = SUCCESS;
        }

        return $lStatus; 
    }

    static function Sanitize($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }}
?>