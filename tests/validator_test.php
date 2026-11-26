<?php
declare(strict_types=1);
require_once __DIR__.'/../src/functions.php';
function check(bool $ok,string $message):void{if(!$ok)throw new RuntimeException($message);}
$cases=loadFormCases(__DIR__.'/../dataset/form_cases.json');
foreach($cases as $c){$r=validateInput(['name'=>$c['name']??'','email'=>'case@example.test','department'=>'Тест','experience'=>(string)($c['experience']??'')]);check(($r['errors']===[])===(bool)$c['valid'],'Кейс '.($c['case']??'?').' не пройден.');}
check(count(loadEmployees(__DIR__.'/../dataset/employees.csv'))===5,'CSV BOM/header failure.');
check(isset(validateInput(['name'=>' ','email'=>'bad','department'=>' ','experience'=>'-1'])['errors']['name']),'Whitespace must fail.');
check(isset(validateInput(['name'=>str_repeat('А',101),'email'=>'a@b.test','department'=>'ИТ','experience'=>'2'])['errors']['name']),'Name length must be checked.');
check(lowerUtf8('РАЗРАБОТКА')===lowerUtf8('Разработка'),'Unicode filter must ignore case.');
check(e('<script>')==='&lt;script&gt;','HTML escaping failed.');
echo "TRPO-04: OK\n";
