<?php

// Этот небольшой ребус из-за настроек моего хостинга. Подключаю файл аякса здесь, иначе сервер редиректит запрос
// с https на http и, соответственно, ничего не работает
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once (__DIR__ . '/ajax/index.php');
    die();
}

$title  = 'Тест для php-разработчиков';
$author = 'Fingli Group';
$date   = '2022';

?>
<!DOCTYPE html>
<html lang="ru" class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title ?></title>
	<link rel="icon" href="/favicon.ico" sizes="any">
	<link rel="icon" href="/favicon.svg" type="image/svg+xml">
	<meta name="robots" content="noindex"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100 bg-light">
<main class="flex-shrink-0">
	<div class="container">
		<h1 class="my-4"><?= $title ?></h1>
		<div class="alert alert-info my-4">
			<a href="https://fsa.gov.ru/" target="_blank">Федеральная служба по аккредитации</a>
		</div>
		<section class="card my-4">
			<h2 class="card-header">Поиск деклараций</h2>
			<div class="card-body">
				<form id="form-filter" action="/ajax" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="state">Статус</label>
                        <select class="form-select" id="state" name="state" required>
                            <option value="any">Все</option>
                            <option value="new">Новые</option>
                            <option value="open">Открытые</option>
                            <option value="close">Закрытые</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="number">Номер декларации</label>
                        <input type="number" class="form-control" id="number" name="number">
                    </div>
                    <div class="mb-3 row">
                        <label class="form-label" for="create-date-begin">Дата регистрации</label>
                        <div class="input-group col">
                            <span class="input-group-text" id="create-date-begin-label">от</span>
                            <input type="date" id="create-date-begin" name="create-date-begin" class="form-control" aria-describedby="create-date-begin-label">
                        </div>
                        <div class="input-group col">
                            <span class="input-group-text" id="create-date-end-label">до</span>
                            <input type="date" id="create-date-end" name="create-date-end" class="form-control" aria-describedby="create-date-end-label">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="form-label" for="state">Дата окончания действия</label>
                        <div class="input-group col">
                            <span class="input-group-text" id="expire-date-begin-label">от</span>
                            <input type="date" id="expire-date-begin" name="expire-date-begin" class="form-control" aria-describedby="expire-date-begin-label">
                        </div>
                        <div class="input-group col">
                            <span class="input-group-text" id="create-date-end-label">до</span>
                            <input type="date" id="expire-date-end" name="expire-date-end" class="form-control" aria-describedby="expire-date-end-label">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="count">Количество деклараций</label>
                        <select class="form-select" id="count" name="count" required>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
					<div>
						<button class="btn btn-primary" type="submit">Найти</button>
					</div>
				</form>
			</div>
		</section>
		<section class="card my-4">
			<h2 class="card-header">Список деклараций</h2>
			<div class="card-body">
				<div class="table-responsive table-striped table-sm">
					<table  id="declaration-list"  class="table">
						<thead>
						<tr>
							<th data-field="id">id</th>
							<th data-field="statusName">Статус</th>
							<th data-field="number">Номер</th>
							<th data-field="registrationDate">Дата регистрации</th>
							<th data-field="endDate">Дата окончания действия</th>
							<th data-field="productName">Наименование продукции</th>
							<th data-field="applicantName">Заявитель</th>
							<th data-field="manufacterName">Изготовитель</th>
							<th data-field="productOrigin">Происхождение продукции</th>
							<th data-field="objectType">Тип объекта декларирования</th>
						</tr>
						</thead>
						<tbody id="result-table">
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</main>
<footer class="footer mt-auto py-3 bg-dark">
	<div class="container">
		<span class="text-muted"><?= "$date. $author" ?></span>
	</div>
</footer>
<script
        src="https://code.jquery.com/jquery-3.3.0.min.js"
        integrity="sha256-RTQy8VOmNlT6b2PIRur37p6JEBZUE7o8wPgMvu18MC4="
        crossorigin="anonymous"></script>
<script src="/js/ajax.js"></script>
</body>
</html>
