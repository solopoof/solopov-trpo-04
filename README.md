# Практическая работа №04 — формы и CSV

**Студент:** Солопов Антон  
**Группа:** ЭПБО-01-25  
**Дисциплина:** ТРПО

## Реализовано
Чтение исходного CSV; фильтрация по отделу через GET; добавление через POST; серверная валидация имени, email, отдела и стажа; сохранение введённых значений при ошибке; экранирование HTML; проверка кейсов из form_cases.json.

## Запуск
PHP 8.1+ с mbstring: `php -S localhost:8000 -t public`, открыть http://localhost:8000.

## Тесты
`php -d zend.assertions=1 -d assert.exception=1 tests/validator_test.php`

## Структура
`src/EmployeeRepository.php` — CSV; `src/EmployeeValidator.php` — проверка формы; `public/index.php` — GET/POST; `dataset/` — исходные данные; `tests/` — тесты.

Новая запись существует в результате текущего POST-запроса, но не записывается в исходный CSV, чтобы не изменять предоставленный набор данных.
