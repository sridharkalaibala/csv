<?php

class Csv
{
    private $file = null;

    public function fileUpload()
    {
        if (isset($_FILES['csv'])) {
            $fileName = $_FILES['csv']['name'];
            $fileSize = $_FILES['csv']['size'];
            $fileTmp = $_FILES['csv']['tmp_name'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ('csv' !== $fileExt) {
                return 'Please upload csv file';
            }

            if ($fileSize > 2097152) {
                return 'File size should be less then 2 MB';
            }

            $this->file = 'csv/' . time() . '_' . $fileName;
            move_uploaded_file($fileTmp, $this->file);
            $_SESSION['file'] = $this->file;
        }

        return '';
    }

    public function getHeaders()
    {
        if (!$this->file) {
            return [];
        }
        $csv = new \ParseCsv\Csv();
        $csv->auto($this->file);

        return $csv->titles;
    }

    public function download()
    {
        if (isset($_POST['header'], $_POST['newColumn'], $_SESSION['file'])) {
            $header = $_POST['header'];
            $newColumn = $_POST['newColumn'];

            $csv = new \ParseCsv\Csv();
            $csv->auto($_SESSION['file']);

            $data = [];
            foreach ($csv->data as $row) {
                $sourceString = $row[$header] ?: '';
                preg_match('#<h3[^>]*>(.*?)</h3>#i', $sourceString, $match);
                $newValue = isset($match[1]) ? $match[1] : '';
                $newRow = array_values($row);
                $newRow[] = $newValue;
                $data[] = $newRow;
            }

            $newCsv = new \ParseCsv\Csv();
            $newCsv->linefeed = "\n";
            $headers = $csv->titles;
            $headers[] = $newColumn;
            $newCsv->output(' csv/new_file.csv', $data, $headers, ',');
            header("Location: csv/new_file.csv");
            exit;
        }
    }
}