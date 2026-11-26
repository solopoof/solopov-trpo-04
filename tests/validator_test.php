<?php
require_once __DIR__.'/../src/EmployeeValidator.php';$v=new EmployeeValidator();
assert(!$v->validate(['name'=>'А','email'=>'a@b.test','department'=>'ИТ','experience'=>'2'])['errors']);
assert(isset($v->validate(['name'=>'','email'=>'a@b.test','department'=>'ИТ','experience'=>'2'])['errors']['name']));
assert(isset($v->validate(['name'=>'А','email'=>'a@b.test','department'=>'ИТ','experience'=>'-1'])['errors']['experience']);
echo "OK\n";
