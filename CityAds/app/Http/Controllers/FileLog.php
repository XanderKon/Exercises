<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\FileLogs;

class FileLog extends Controller
{
    /**
     * File name
     * @var string
     */
    private $file = 'logs/transactions-2014-07-10.log';

    /**
     * End of line symbol
     * @var string
     */
    private $end_of_line = '\n';

    public function index()
    {
        if (file_exists(public_path($this->file)))
        {
            return view('file')->with('file', $this->file);
        }

        echo 'File doesn\'t exist. And there is no method to upload it...sorry :)' ;
    }

    public function start()
    {
        echo "Reading & Inserting <br/>";

        $file = \File::get(public_path($this->file));

        $i = 0;
        foreach (explode($this->end_of_line, $file) as $row)
        {
            if (FileLogs::add($row))
            {
                $i++;
            }
        }

        if ($i > 0)
        {
            echo "Success insert: $i rows<br/>";
        }
        else
        {
            echo "No rows was inserted<br/>";
        }

        // remove File
        if (\File::delete(public_path($this->file)))
        {
            echo "File has been deleted!<br/>";
        }

        return;
    }
}
