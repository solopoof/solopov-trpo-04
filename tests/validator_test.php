<?php
require_once __DIR__.'/../src/EmployeeValidator.php';
$v=new EmployeeValidator();
$valid=$v->validate(['name'=>'Антон','email'=>'a@example.test','department'=>'ИТ','experience'=>'2']);
$empty=$v->validate(['name'=>'','email'=>'a@example.test','department'=>'ИТ','experience'=>'2']);
$negative=$v->validate(['name'=>'Антон','email'=>'a@example.test','department'=>'ИТ','experience'=>'-1']);
assert($valid['errors']===[]);
assert(isset($empty['errors']['name']));
assert(isset($negative['errors']['experience']));
echo "Validator checks passed\n";
