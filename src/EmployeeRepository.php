<?php
declare(strict_types=1);
final class EmployeeRepository {
 public function __construct(private string $file){}
 public function all():array{$h=fopen($this->file,'rb');if(!$h)return [];$head=fgetcsv($h,0,';');$out=[];while(($r=fgetcsv($h,0,';'))!==false){if(count($r)!==count($head))continue;$x=array_combine($head,$r);$out[]=['id'=>(int)$x['id'],'name'=>$x['name'],'department'=>$x['department'],'experience'=>(int)$x['experience'],'email'=>$x['email']];}fclose($h);return $out;}
 public function departments():array{$d=array_unique(array_column($this->all(),'department'));sort($d);return $d;}
}
