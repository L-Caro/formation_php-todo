<?php
const ERROR_REQUIRED = "Veuillez renseigner une todo";
const ERROR_TOO_SHORT = "Veuillez entrer au moins 5 caractères";

$filename = __DIR__ . "/data/todo.json";

$error = '';

$todos = [];
$todo = "";

if (file_exists($filename)) {
  $todos = json_decode(file_get_contents($filename), true) ?? [];
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $todo = $_POST['todo'] ?? '';

  if (empty($todo)) {
    $error = ERROR_REQUIRED;
  } elseif (mb_strlen($todo) < 5) {
    $error = ERROR_TOO_SHORT;
  }

  if (!$error) {

    $todos = [...$todos, [
      'name' => $todo,
      "done" => false,
      'id' => time()
    ]];
    file_put_contents($filename, json_encode($todos, JSON_PRETTY_PRINT));

    //  Lorsqu'on actualise la page, la même requête POST est renvoyée avec les mêmes données.
    //	Le modèle POST-REDIRECT-GET permet d'éviter le problème de soumission de formulaire en double.
    header('Location: /');

  }
}

?>


<!--Rendu-->
<?php
$title = "Php To-do list"; // Variable envoyée à l'include head

require_once 'includes/head.php';


require_once 'includes/header.php' ?>

<div class="content">
	<div class="todo-container">
		<h1>Ma To-do list</h1>
		<form action="/" method="POST" class="todo-form">
			<label for="input">
				<input value="<?= $todo ?>" name="todo" type="text" id="input">
			</label>
			<button class="btn btn-primary">Ajouter</button>
		</form>
      <?php if ($error): ?>
		  <p class="text-danger"><?= $error ?></p>
      <?php endif; ?>
		<ul class="todo-list">
          <?php foreach ($todos as $todo): ?>
			  <li class="todo-item <?= $todo['done'] ? 'todo-done' : '' ?>">
				  <span class="todo-name"><?= $todo['name'] ?></span>
				  <a href="/todos/edit-todo.php?id=<?= $todo['id'] ?>">
					  <button class="btn btn-primary btn-small"><?= $todo['done'] ? "Annuler" : "Valider" ?></button>
				  </a>
				  <a href="/todos/remove-todo.php?id=<?= $todo['id'] ?>">
					  <button class="btn btn-danger btn-small">Supprimer</button>
				  </a>
			  </li>
          <?php endforeach; ?>
		</ul>
	</div>
</div>
<?php require_once 'includes/footer.php' ?>
