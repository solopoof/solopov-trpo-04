<?php
declare(strict_types=1);
final class EmployeeRepository {
    public function __construct(private string $file) {}
    public function all(): array {
        if (!is_readable($this->file)) return [];
        $h = fopen($this->file, 'rb'); if (!$h) return [];
        $header = fgetcsv($h, 0, ';'); $rows = [];
        if (is_array($header)) while (($line = fgetcsv($h, 0, ';')) !== false) {
            if (count($line) !== count($header)) continue;
            $row = array_combine($header, $line);
            if ($row !== false) $rows[] = ['id'=>(int)$row['id'],'name'=>$row['name'],'department'=>$row['department'],'experience'=>(int)$row['experience'],'email'=>$row['email']];
        }
        fclose($h); return $rows;
    }
    public function departments(): array { $v=array_unique(array_column($this->all(),'department')); sort($v); return $v; }
}
