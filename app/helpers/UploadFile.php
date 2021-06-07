<?php

class UploadFile
{

    /**
     * Upload File
     *
     * @param array $file
     * @return string Filename
     * @throws Exception
     **/
    public static function upload($file)
    {
        /* Check if there was an error uploading the file */
        if ($file["error"] > 0) {
            throw new Exception("Return Code: " . $file["error"], 400);
        }

        /* Check file EXTENSION*/
        if (strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) !== 'csv') {
            throw new Exception("Only CSV files are allowed", 400);
        }

        /* Generate New name for uploaded file */
        $newName = self::generateFileName($file['name']);

        /* Check if file with same name exist */
        if (file_exists("upload/" . $newName)) {
            $newName = self::generateFileName($file['name']);
        }

        //Store file in directory "upload" with the name of "uploaded_file.txt"
        move_uploaded_file($file["tmp_name"], "upload/" . $newName);

        return "upload/" . $newName;
    }

    /*
    * Generate File new Name
    *
    * */
    public static function generateFileName($fileName)
    {
        return substr(md5(time()), 0, 10) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
    }
}