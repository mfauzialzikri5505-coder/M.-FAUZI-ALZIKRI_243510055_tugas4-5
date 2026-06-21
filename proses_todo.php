<?php
include 'koneksi.php';

if (isset($_POST['add_task'])) {
    $task = mysqli_real_escape_string($conn, $_POST['task_text']);
    if (!empty($task)) {
        mysqli_query($conn, "INSERT INTO todos (task_text) VALUES ('$task')");
    }
    header("Location: pert4.php#todo-app");
    exit();
}

if (isset($_GET['toggle'])) {
    $id = $_GET['toggle'];
    $status = $_GET['status'];
    $new_status = ($status == 1) ? 0 : 1;

    mysqli_query($conn, "UPDATE todos SET completed = $new_status WHERE id = $id");
    header("Location: pert4.php#todo-app");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM todos WHERE id = $id");
    header("Location: pert4.php#todo-app");
    exit();
}
?>