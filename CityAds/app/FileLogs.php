<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileLogs extends Model
{
    public $timestamps = FALSE;

    const rules = array(
        'transaction_id' => 'unique:file_logs,transaction_id'
    );

    const value_delimeter = '\\';

    /**
     * Insert one row to DB
     *
     * @param string $row
     *
     * @return bool
     *
     * @author Kondratenko Alexander (Xander)
     */
    public static function add($row)
    {
        $row = array_values(explode(self::value_delimeter, $row));

        if (empty($row[0]))
        {
            return FALSE;
        }

        $data = array(
            'transaction_id' => trim($row[0]),
            'tdate'          => trim($row[1]),
            'tvalue'         => trim($row[2])
        );

        if (self::validate($data) === TRUE)
        {
            FileLogs::insert($data);
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Simple validator
     *
     * @param $data
     *
     * @return mixed
     *
     * @author Kondratenko Alexander (Xander)
     */
    public static function validate($data)
    {
        $v = \Validator::make($data, self::rules);

        return $v->passes();
    }
}
