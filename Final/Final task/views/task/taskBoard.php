<?php
include __DIR__ . "/../../controllers/taskBoardController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Board</title>

    <style>
        .board {
            display: flex;
            gap: 20px;
        }

        .column {
            width: 32%;
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 400px;
        }

        .task-card {
            border: 1px solid #999;
            padding: 10px;
            margin-bottom: 10px;
            background: #f9f9f9;
        }

        .priority-low {
            color: gray;
            font-weight: bold;
        }

        .priority-medium {
            color: orange;
            font-weight: bold;
        }

        .priority-high {
            color: red;
            font-weight: bold;
        }

        .overdue-card {
            border: 2px solid red;
        }

        .modal-box {
            border: 1px solid #333;
            padding: 15px;
            margin: 15px 0;
            display: none;
            width: 400px;
            background: #f6f2f2;
        }
    </style>
</head>
<body>

    <h1>Task Board: <?php echo $project["name"]; ?></h1>

    <p>
        <a href="../project/projectDetails.php?id=<?php echo $project_id; ?>">Project Details</a> |
        <a href="../project/projectList.php">Project List</a> |
        <a href="../activity/activityFeed.php?project_id=<?php echo $project_id; ?>">Activity Feed</a>
    </p>

    <button onclick="openTaskModal()">+ New Task</button>

    <div id="taskModal" class="modal-box">
        <h2>Create New Task</h2>

        <form method="post" action="../../controllers/createTaskController.php">
            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

            <table>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title"></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td><textarea name="description"></textarea></td>
                </tr>

                <tr>
                    <td>Assigned Member:</td>
                    <td>
                        <select name="assigned_to">
                            <?php while ($member = $members->fetch_assoc()) { ?>
                                <option value="<?php echo $member['id']; ?>">
                                    <?php echo $member["name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Priority:</td>
                    <td>
                        <label><input type="radio" name="priority" value="low" checked> Low</label>
                        <label><input type="radio" name="priority" value="medium"> Medium</label>
                        <label><input type="radio" name="priority" value="high"> High</label>
                    </td>
                </tr>

                <tr>
                    <td>Due Date:</td>
                    <td><input type="date" name="due_date"></td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Create Task">
                        <button type="button" onclick="closeTaskModal()">Cancel</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="board">

        <div class="column" id="todo">
            <h2>To Do</h2>

            <?php while ($task = $todoTasks->fetch_assoc()) { ?>
                <div class="task-card" id="task-<?php echo $task['id']; ?>" data-due-date="<?php echo $task['due_date']; ?>" data-status="<?php echo $task['status']; ?>">
                    <h3><?php echo $task["title"]; ?></h3>
                    <p>Assigned: <?php echo $task["assigned_name"]; ?></p>
                    <p class="priority-<?php echo $task['priority']; ?>">Priority: <?php echo $task["priority"]; ?></p>
                    <p>Due: <?php echo $task["due_date"]; ?></p>

                    <form method="post" style="display:inline;">
    <input type="hidden" name="task_id" value="<?php echo $task["id"]; ?>">
    <input type="hidden" name="status" value="in-progress">
    <input type="submit" name="move_task" value="→">
</form>
                    <a href="taskDetails.php?task_id=<?php echo $task['id']; ?>">View Details</a>
                </div>
            <?php } ?>
        </div>

        <div class="column" id="in-progress">
            <h2>In Progress</h2>

            <?php while ($task = $progressTasks->fetch_assoc()) { ?>
                <div class="task-card" id="task-<?php echo $task['id']; ?>" data-due-date="<?php echo $task['due_date']; ?>" data-status="<?php echo $task['status']; ?>">
                    <h3><?php echo $task["title"]; ?></h3>
                    <p>Assigned: <?php echo $task["assigned_name"]; ?></p>
                    <p class="priority-<?php echo $task['priority']; ?>">Priority: <?php echo $task["priority"]; ?></p>
                    <p>Due: <?php echo $task["due_date"]; ?></p>

                    <form method="post" style="display:inline;">
    <input type="hidden" name="task_id" value="<?php echo $task["id"]; ?>">
    <input type="hidden" name="status" value="todo">
    <input type="submit" name="move_task" value="←">
</form>

<form method="post" style="display:inline;">
    <input type="hidden" name="task_id" value="<?php echo $task["id"]; ?>">
    <input type="hidden" name="status" value="done">
    <input type="submit" name="move_task" value="→">
</form>
                    <a href="taskDetails.php?task_id=<?php echo $task['id']; ?>">View Details</a>
                </div>
            <?php } ?>
        </div>

        <div class="column" id="done">
            <h2>Done</h2>

            <?php while ($task = $doneTasks->fetch_assoc()) { ?>
                <div class="task-card" id="task-<?php echo $task['id']; ?>" data-due-date="<?php echo $task['due_date']; ?>" data-status="<?php echo $task['status']; ?>">
                    <h3><?php echo $task["title"]; ?></h3>
                    <p>Assigned: <?php echo $task["assigned_name"]; ?></p>
                    <p class="priority-<?php echo $task['priority']; ?>">Priority: <?php echo $task["priority"]; ?></p>
                    <p>Due: <?php echo $task["due_date"]; ?></p>

                    <form method="post" style="display:inline;">
    <input type="hidden" name="task_id" value="<?php echo $task["id"]; ?>">
    <input type="hidden" name="status" value="in-progress">
    <input type="submit" name="move_task" value="←">
</form>
                    <a href="taskDetails.php?task_id=<?php echo $task['id']; ?>">View Details</a>
                </div>
            <?php } ?>
        </div>

    </div>

    <script src="../../assets/js/task.js"></script>

</body>
</html>