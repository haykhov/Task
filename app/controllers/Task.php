<?php

class Task extends Controller
{

    public $rec = [];

    /**
     * Show upload form
     */
    public function index()
    {
        $this->view('task/index');
    }

    /**
     * Parse CSV file
     */
    public function parse()
    {
        /* Check if file exist */
        if (isset($_POST["submit"]) && isset($_FILES["employee_file"]) && ($_FILES["employee_file"]['name'] != '')) {

            /* Upload file */
            $filePath = UploadFile::upload($_FILES["employee_file"]);

            /* Read CSV file Content */
            $content = ReadFile::getFileContent($filePath);

            /* Get Matches */
            $this->rec = Matched::getMatches($content);

            $this->view('task/recommendation', $this->rec);
        } else {
            throw new Exception('File does not uploaded successfully', 400);
        }
    }
}