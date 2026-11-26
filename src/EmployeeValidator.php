<?php
declare(strict_types=1);
final class EmployeeValidator {
    public function validate(array $input): array {
        $v=['name'=>trim((string)($input['name']??'')),'email'=>trim((string)($input['email']??'')),'department'=>trim((string)($input['department']??'')),'experience'=>trim((string)($input['experience']??''))];
        $e=[];
        if ($v['name']==='') $e['name']='Введите имя.'; elseif (mb_strlen($v['name'])>100) $e['name']='Не более 100 символов.';
        if (!filter_var($v['email'],FILTER_VALIDATE_EMAIL)) $e['email']='Некорректный email.';
        if ($v['department']==='' || mb_strlen($v['department'])>80) $e['department']='Укажите отдел (до 80 символов).';
        $n=filter_var($v['experience'],FILTER_VALIDATE_INT);
        if ($n===false || $n<0 || $n>60) $e['experience']='Стаж должен быть целым числом от 0 до 60.';
        return ['values'=>$v,'errors'=>$e];
    }
}
