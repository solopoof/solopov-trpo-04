<!doctype html><html lang="ru"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Сотрудники — ТРПО 04</title>
<style>
*{box-sizing:border-box}body{margin:0;background:#f3f5fa;color:#172033;font:16px system-ui}header{background:#172554;color:#fff;padding:24px max(20px,calc((100% - 1050px)/2))}main{max-width:1050px;margin:28px auto;padding:0 18px}.panel{background:white;border:1px solid #e2e8f0;border-radius:15px;padding:22px;margin-bottom:18px}h1,h2{margin-top:0}.grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}label{display:block;font-weight:600;margin-bottom:5px}input,select{width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:8px;font:inherit}button,.btn{display:inline-block;border:0;border-radius:8px;background:#315efb;color:white;padding:10px 15px;font:inherit;text-decoration:none;cursor:pointer}table{width:100%;border-collapse:collapse}th,td{text-align:left;padding:10px;border-bottom:1px solid #e2e8f0}.error{color:#b91c1c}.notice{padding:12px;background:#dcfce7;border-radius:8px}.muted{color:#64748b}@media(max-width:650px){.grid{grid-template-columns:1fr}}
</style></head><body><header><h1>Учёт сотрудников</h1>Практическая работа №04 · ТРПО</header><main>
<p class="muted">Солопов Антон · ЭПБО-01-25</p>
<section class="panel"><h2>Добавить сотрудника</h2>
<?php if($success):?><p class="notice">Запись добавлена в список текущего запроса.</p><?php endif;?>
<?php if($errors):?><p class="error">Исправьте ошибки в форме.</p><?php endif;?>
<form method="post"><div class="grid">
<?php foreach(['name'=>'Имя','email'=>'Email','department'=>'Отдел','experience'=>'Стаж (лет)'] as $key=>$label):?>
<div><label for="<?=$key?>"><?=e($label)?></label><input id="<?=$key?>" name="<?=$key?>" value="<?=e($values[$key])?>" <?=$key==='email'?'type="email"':($key==='experience'?'type="number" min="0" max="60"':'')?> required>
<?php if(isset($errors[$key])):?><small class="error"><?=e($errors[$key])?></small><?php endif;?></div>
<?php endforeach;?></div><p><button>Добавить</button></p></form></section>
<section class="panel"><h2>Список сотрудников</h2><form method="get"><label for="department">Отдел</label><select name="department" id="department"><option value="">Все отделы</option><?php foreach($departments as $d):?><option value="<?=e($d)?>" <?=$filter===$d?'selected':''?>><?=e($d)?></option><?php endforeach;?></select><p><button>Фильтровать</button> <a class="btn" href="/">Сбросить</a></p></form>
<p class="muted">Записей: <?=count($employees)?></p><div style="overflow-x:auto"><table><thead><tr><th>ID</th><th>Имя</th><th>Отдел</th><th>Стаж</th><th>Email</th></tr></thead><tbody>
<?php foreach($employees as $x):?><tr><td><?=(int)$x['id']?></td><td><?=e($x['name'])?></td><td><?=e($x['department'])?></td><td><?=(int)$x['experience']?></td><td><?=e($x['email'])?></td></tr><?php endforeach;?>
<?php if(!$employees):?><tr><td colspan="5">Нет записей.</td></tr><?php endif;?></tbody></table></div></section>
<section class="panel"><h2>Контрольные сценарии</h2><ul><?php foreach($cases as $case):$r=$validator->validate(['name'=>$case['name']??'','email'=>'test@example.test','department'=>'Тест','experience'=>(string)($case['experience']??'')]);$actual=!$r['errors'];?><li><?=e($case['case'])?>: <?=($actual===(bool)$case['valid'])?'пройден':'не пройден'?></li><?php endforeach;?></ul></section>
</main></body></html>