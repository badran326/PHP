<?php
class validate
{
    public function checkEmpty($data, $fields)
    {
        $msg = null;
        foreach ($fields as $value) {
            if (empty($data[$value])) {
                $msg .= "<p>$value field is empty.</p>";
            }
        }
        return $msg;
    }
    public function validCount($age)
    {
        if (preg_match("/^[0-9]+$/", $age)) {
            return true;
        }
        return false;
    }
}
?>