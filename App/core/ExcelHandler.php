<?php

namespace Core;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelHandler
{
    use \Core\Validator;
    public static function CheckStudentFileValidity($file){
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        if (self::checkStudentColumsValidity($sheet)){
        if (self::isAllFull($sheet)){
            $students=$sheet->toArray();
            array_shift($students);
            foreach($students as $student){
                if(!self::checkStudentRowValidity($student)) return false;
            }
            return true;
        }}
        return false;
    }
    public static function isAllFull(Worksheet $sheet){
        foreach ($sheet->getRowIterator() as $row) {
            foreach ($row->getCellIterator() as $cell) {
                if(is_null($cell->getValue()) or $cell->getValue()=='')return false;
                break 2;
            }
        }
        return true;
    }
    private  static function checkStudentRowValidity(array $row){

        return self::checkName($row[0]) and self::checkName($row[1]) and (bool)self::checkEmail($row[2]) and self::checkCin($row[4]) and self::checkPhone($row[6]) and self::checkCne($row[8]);
    }
    private static function checkStudentColumsValidity(Worksheet $sheet){
        return Coordinate::columnIndexFromString($sheet->getHighestColumn()) ==9;
    }
    private static function checkNoteColumsValidity(Worksheet $sheet){
        return Coordinate::columnIndexFromString($sheet->getHighestColumn()) ==5;
    }
    public static function toStudentArray($file){
        if(self::checkStudentFileValidity($file)){
            $spreadsheet = IOFactory::load($file);
            $sheet=$spreadsheet->getActiveSheet();
            $data=$sheet->toArray();
            array_shift($data);
            $students=self::editDate(self::editPhone($data));
            return array_map(fn($student)=>array_combine(['prenom','nom','email','mot_de_passe','cin','date_naissance','telephone','sexe','cne'],$student),$students);
        }else{
            throw new \Exception("Ce fichier est invalide");
        }
    }
    private static  function editPhone(array $students){
        return array_map(function ($element){
            $element[6]='0'.$element[6];
            return $element;
        },$students);
    }
    private static function editDate(array $students){
        return array_map(function ($element){
            $date=\DateTime::createFromFormat('d/m/Y',$element[5]);
            $element[5]=$date->format('Y-m-d');
            return $element;
        },$students);
    }
    public static function createNoteFile(array $students,$filiere){
        $spreadsheet=new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','id');
        $sheet->setCellValue('B1','CNE');
        $sheet->setCellValue('C1','Nom');
        $sheet->setCellValue('D1','Prenom');
        $row=2;
        foreach ($students as $student){
            $column='A';
            foreach ($student as $element){
                $sheet->setCellValue($column.$row,$element);
                $column++;
            }
            $row++;
        }
        $writer=new Xlsx($spreadsheet);
        if (ob_get_length()) {
            ob_end_clean();
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . htmlspecialchars($filiere, ENT_QUOTES, 'UTF-8') . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
    public static function checkNoteRowValidity(array $row){
        return is_int($row[0]) and self::checkCne($row[1]) and self::checkName($row[2]) and self::checkName($row[3]) and is_double($row[4]);
    }
    private static function checkFileNoteValidity($file){
        $spreadsheet=IOFactory::load($file);
        $sheet=$spreadsheet->getActiveSheet();
        if (self::checkNoteColumsValidity($sheet)){
            if (self::isAllFull($sheet)){
                $notes=$sheet->toArray();
                array_shift($notes);
                foreach ($notes as $note):
                if(self::checkNoteRowValidity($note))return false;
                endforeach;
                return true;
            }
        }
        return false;
    }
    public static function toNoteArray($file){
        if(self::checkFileNoteValidity($file)) {
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            array_shift($data);
            return array_map(fn($note) => array_combine(['id', 'cne', 'nom', 'prenom', 'note'], $note), $data);
        }else{
            throw new \Exception("Le format de ce fichier ou les types des donnees est invalide");
        }
    }
}