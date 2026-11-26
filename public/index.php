<?php
declare(strict_types=1);
require_once __DIR__.'/../src/helpers.php';
require_once __DIR__.'/../src/EmployeeRepository.php';
require_once __DIR__.'/../src/EmployeeValidator.php';
$repo=new EmployeeRepository(__DIR__.'/../dataset/employees.csv');
$validator=new EmployeeValidator();
$employees=$repo->all(); $errors=[]; $success=false;
$values=['name'=>'','email'=>'','department'=>'','experience'=>''];
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $result=$validator->validate($_POST); $values=$result['values']; $errors=$result['errors'];
    if (!$errors) { $success=true; $employees[]=['id'=>count($employees)+1,'name'=>$values['name'],'department'=>$values['department'],'experience'=>(int)$values['experience'],'email'=>$values['email']]; $values=['name'=>'','email'=>'','department'=>'','experience'=>'']; }
}
$filter=trim((string)($_GET['department']??''));
if ($filter!=='') $employees=array_values(array_filter($employees,fn($x)=>mb_strtolower($x['department'])===mb_strtolower($filter)));
$departments=$repo->departments();
$cases=json_decode((string)file_get_contents(__DIR__.'/../dataset/form_cases.json'),true)??[];
require __DIR__.'/../templates/index.php';
