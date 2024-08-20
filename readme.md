# PHP Task Manager

- [PHP Task Manager](#php-task-manager)
	- [English version](#english-version)
	- [French version](#french-version)

## English version

This project is a simple Task Manager (or "todo list") written in PHP. It allows you to add, mark as complete, and
remove tasks.

### Description

The project is composed of several PHP files:

#### index.php:

All the logic for the manager is contained in this file:

- Use of includes for the header, head, and footer.
- Task addition through a form.
	- The input from the POST request is sanitized using the `filter_input_array` function.
- Displays existing tasks.
- Generates edit and removal links for each task.

#### edit-todo.php and remove-todo.php:

- These files handle the editing (completion) and removal of tasks. Each action is based on the provided task ID.
- The parameters from the GET requests are sanitized using the `filter_input_array` function.

#### todo-actions.php:

- Function shared between the edit and remove code to limit code duplication.

Task data is stored in a JSON file (todo.json).

### Dockerization

The project is dockerized, making it more portable and easier to deploy. The Docker configuration is specified in
a `docker-compose.yml` and `Dockerfile`.

### Usage

Visit [php-todo.lionelcaro.fr](https://php-todo.lionelcaro.fr) to see the current list of tasks. You can use the "
Validate", "Cancel", and "Delete" buttons to change a task's status or remove it from the list.

## French version

Ce projet est un simple gestionnaire de tâches (ou "todo list") écrit en PHP. Il vous permet d'ajouter, de compléter, et
de supprimer des tâches.

### Description

Le projet est composé de plusieurs fichiers PHP :

#### index.php :

Toute la logique du gestionnaire se situe dans ce fichier :

- Utilisation d'include pour le header, head et footer
- Ajout de tâche grâce à un formulaire
	- L'input provenant de la requête POST est nettoyé en utilisant la fonction `filter_input_array`.
- Affiche les tâches existantes.
- Génère les liens d'édition et de suppression pour chaque tâche.

#### edit-todo.php et remove-todo.php :

- ces fichiers traitent l'édition (complétion) et la suppression de taches. Chaque action est basée sur l'ID de la tâche
  fournie.
- Les paramètres provenant des requêtes GET sont nettoyés en utilisant la fonction `filter_input_array`.

#### todo-actions.php :

- Fonction mutualisée pour limiter la duplication de code entre le code d'édition et de suppression.

Les données de tâches sont stockées dans un fichier JSON (todo.json).

### Dockerization

Le projet est dockerisé, ce qui le rend plus portable et facile à déployer. La configuration Docker est spécifiée dans
un fichier `docker-compose.yml` et un `Dockerfile`.

### Utilisation

Visitez [php-todo.lionelcaro.fr](https://php-todo.lionelcaro.fr) pour voir la liste des tâches actuelles. Vous pouvez
utiliser les boutons "Valider", "Annuler" et "Supprimer" pour modifier l'état d'une tâche ou la supprimer de la liste.
