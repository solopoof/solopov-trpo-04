<?php
declare(strict_types=1);
function e(mixed $v):string{return htmlspecialchars((string)$v,ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8');}
function employeeFromCsvRow(array $r):array{return ['id'=>(int)($r['id']??0),'name'=>(string)($r['name']??''),'department'=>(string)($r['department']??''),'experience'=>(int)($r['experience']??0),'email'=>(string)($r['email']??'')];}
function loadEmployees(string $file):array{
 if(!is_file($file)||!is_readable($file))throw new RuntimeException('Файл employees.csv отсутствует или недоступен.');
 $h=fopen($file,'rb');if(!$h)throw new RuntimeException('Не удалось открыть employees.csv.');
 try{$head=fgetcsv($h,null,';','"','');if(!is_array($head))throw new RuntimeException('Нет заголовка CSV.');$head[0]=preg_replace('/^\xEF\xBB\xBF/','',(string)$head[0]);if($head!==['id','name','department','experience','email'])throw new RuntimeException('Неверная структура employees.csv.');$out=[];while(($r=fgetcsv($h,null,';','"',''))!==false){if(count($r)===count($head))$out[]=employeeFromCsvRow(array_combine($head,$r));}return $out;}finally{fclose($h);}
}
function validateInput(array $in):array{
 $v=['name'=>trim((string)($in['name']??'')),'email'=>trim((string)($in['email']??'')),'department'=>trim((string)($in['department']??'')),'experience'=>trim((string)($in['experience']??''))];$e=[];
 $nl=preg_match_all('/./us',$v['name']);$dl=preg_match_all('/./us',$v['department']);
 if($v['name']==='')$e['name']='Введите имя сотрудника.';elseif($nl===false||$nl>100)$e['name']='Не более 100 символов.';
 if(!filter_var($v['email'],FILTER_VALIDATE_EMAIL))$e['email']='Введите корректный email.';
 if($v['department']==='')$e['department']='Укажите отдел.';elseif($dl===false||$dl>80)$e['department']='Не более 80 символов.';
 $n=filter_var($v['experience'],FILTER_VALIDATE_INT);if($n===false||$n<0||$n>60)$e['experience']='Стаж должен быть целым числом от 0 до 60.';
 return ['values'=>$v,'errors'=>$e];
}
function lowerUtf8(string $s):string{$u=preg_split('//u','АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ',-1,PREG_SPLIT_NO_EMPTY);$l=preg_split('//u','абвгдеёжзийклмнопрстуфхцчшщъыьэюя',-1,PREG_SPLIT_NO_EMPTY);return strtolower(strtr($s,array_combine($u,$l)));}
function loadFormCases(string $file):array{$raw=file_get_contents($file);if($raw===false)throw new RuntimeException('Не удалось прочитать form_cases.json.');$data=json_decode($raw,true,512,JSON_THROW_ON_ERROR);if(!is_array($data))throw new RuntimeException('Ожидался массив form_cases.json.');return $data;}
