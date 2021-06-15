<?php

class ReadFile
{
    /**
     * Get File Content
     *
     * @param array $file
     * @return array $content
     * @throws Exception
     **/
    public static function getFileContent($file)
    {
        /* Check if file exist */


        if (file_exists($file)) {
            $content = [];
            $row = 0;

            if (($handle = fopen($file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                    if (isset($data[0])) {
                        if ($row == 0) {
                            $header = explode(',', $data[0]);
                        } else {
                            $eachRow = explode(',', $data[0]);
                            foreach ($eachRow as $key => $Info) {
                                $content[$row][$header[$key]] = $Info;
                            }
                        }
                    }

                    $row++;
                }
                fclose($handle);
            }

            return $content;

        } else {
            throw new Exception('CSV File Does not exist', 400);
        }
    }
}