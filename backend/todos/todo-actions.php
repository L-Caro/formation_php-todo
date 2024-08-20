<?php

/**
 * @param string $action - the action to be performed ('edit' or 'remove')
 * @param string $id - the ID of the todo item to be edited or removed
 * @return void
 */
function todoAction(string $action, string $id): void
{
  // Define the filename where the todo items are stored
  $filename = __DIR__ . "/../data/todo.json";

  // Sanitize GET parameters
  $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $id = $_GET['id'] ?? '';

  // If an ID has been provided...
  if ($id) {
    // ...fetch the existing todos,
    $todos = json_decode(file_get_contents($filename), true) ?? [];
    // ...and find the index of the todo with the provided ID
    $todosIndex = (int)array_search($id, array_column($todos, 'id'));

    // If action is 'edit' and todos are present...
    if ($action === 'edit' && count($todos)) {
      // ...reverse the 'done' status of the appropriate todo
      $todos[$todosIndex]['done'] = !$todos[$todosIndex]['done'];
    } // Or, if the action is 'remove'...
    elseif ($action === 'remove') {
      // ...remove the appropriate todo from the array
      array_splice($todos, $todosIndex, 1);
    }

    // Write the updated todos back to the file
    file_put_contents($filename, json_encode($todos, JSON_PRETTY_PRINT));
  }

  // Redirect the user back to the home page
  header('Location: /');
}