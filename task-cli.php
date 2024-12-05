<?php

define('TASK_FILE', __DIR__ . '/tasks.json');

/**
 * Initialize the JSON file if it doesn't exist.
 */
function initTaskFile() {
    if (!file_exists(TASK_FILE)) {
        file_put_contents(TASK_FILE, json_encode([]));
    }
}

/**
 * Read tasks from JSON file.
 */
function readTasks() {
    initTaskFile();
    return json_decode(file_get_contents(TASK_FILE), true);
}

/**
 * Write tasks to JSON file.
 */
function writeTasks($tasks) {
    file_put_contents(TASK_FILE, json_encode($tasks, JSON_PRETTY_PRINT));
}

/**
 * Add a new task.
 */
function addTask($description) {
    $tasks = readTasks();
    $id = count($tasks) > 0 ? end($tasks)['id'] + 1 : 1;
    $newTask = [
        'id' => $id,
        'description' => $description,
        'status' => 'todo',
        'createdAt' => date(DATE_ATOM),
        'updatedAt' => date(DATE_ATOM)
    ];
    $tasks[] = $newTask;
    writeTasks($tasks);
    echo "Task added successfully (ID: $id)\n";
}

/**
 * Update a task.
 */
function updateTask($id, $description) {
    $tasks = readTasks();
    foreach ($tasks as &$task) {
        if ($task['id'] == $id) {
            $task['description'] = $description;
            $task['updatedAt'] = date(DATE_ATOM);
            writeTasks($tasks);
            echo "Task updated successfully (ID: $id)\n";
            return;
        }
    }
    echo "Task with ID $id not found.\n";
}

/**
 * Delete a task.
 */
function deleteTask($id) {
    $tasks = readTasks();
    $tasks = array_filter($tasks, fn($task) => $task['id'] != $id);
    writeTasks(array_values($tasks));
    echo "Task deleted successfully (ID: $id)\n";
}

/**
 * Change the status of a task.
 */
function changeTaskStatus($id, $status) {
    $tasks = readTasks();
    foreach ($tasks as &$task) {
        if ($task['id'] == $id) {
            $task['status'] = $status;
            $task['updatedAt'] = date(DATE_ATOM);
            writeTasks($tasks);
            echo "Task status updated to '$status' (ID: $id)\n";
            return;
        }
    }
    echo "Task with ID $id not found.\n";
}

/**
 * List tasks with optional status filter.
 */
function listTasks($filter = null) {
    $tasks = readTasks();
    if ($filter) {
        $tasks = array_filter($tasks, fn($task) => $task['status'] == $filter);
    }
    if (empty($tasks)) {
        echo "No tasks found.\n";
        return;
    }
    foreach ($tasks as $task) {
        echo "[{$task['id']}] {$task['description']} - {$task['status']} (Created: {$task['createdAt']})\n";
    }
}

// Handle CLI arguments
$args = $argv;
array_shift($args); // Remove script name

if (empty($args)) {
    echo "Usage: php task-cli.php [command] [options]\n";
    exit(1);
}

$command = $args[0];

switch ($command) {
    case 'add':
        addTask($args[1] ?? null);
        break;
    case 'update':
        updateTask($args[1] ?? null, $args[2] ?? null);
        break;
    case 'delete':
        deleteTask($args[1] ?? null);
        break;
    case 'mark-in-progress':
        changeTaskStatus($args[1] ?? null, 'in-progress');
        break;
    case 'mark-done':
        changeTaskStatus($args[1] ?? null, 'done');
        break;
    case 'list':
        listTasks($args[1] ?? null);
        break;
    default:
        echo "Unknown command: $command\n";
        break;
}