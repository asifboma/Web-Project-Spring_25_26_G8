<?php

include __DIR__ . "/../../controllers/taskDetailsController.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Details</title>
</head>
<body>

<h1><?php echo $task["title"]; ?></h1>

<a href="taskBoard.php?project_id=<?php echo $task["project_id"]; ?>">Back to Task Board</a>

<br><br>

<table border="1" cellpadding="8">
    <tr>
        <td><b>Description</b></td>
        <td><?php echo $task["description"]; ?></td>
    </tr>

    <tr>
        <td><b>Assigned To</b></td>
        <td><?php echo $task["assigned_name"]; ?></td>
    </tr>

    <tr>
        <td><b>Priority</b></td>
        <td><?php echo $task["priority"]; ?></td>
    </tr>

    <tr>
        <td><b>Due Date</b></td>
        <td><?php echo $task["due_date"]; ?></td>
    </tr>

    <tr>
        <td><b>Status</b></td>
        <td><?php echo $task["status"]; ?></td>
    </tr>
</table>

<br>

<h2>Comments</h2>

<div id="commentsList">

<?php

while($comment = $comments->fetch_assoc())
{

?>

    <div id="comment-<?php echo $comment["id"]; ?>" style="border:1px solid black; padding:10px; margin-bottom:10px;">

        <b><?php echo $comment["name"]; ?></b>
        <br>
        <?php echo $comment["created_at"]; ?>

        <p><?php echo $comment["body"]; ?></p>

        <?php

        if($comment["user_id"] == $_SESSION["user_id"])
        {

        ?>

            <button onclick="deleteComment(<?php echo $comment["id"]; ?>)">Delete</button>

        <?php

        }

        ?>

    </div>

<?php

}

?>

</div>

<h3>Post Comment</h3>

<textarea id="commentBody" rows="4" cols="50"></textarea>
<br><br>

<button onclick="postComment(<?php echo $task_id; ?>)">Post Comment</button>

<script src="../../assets/js/comments.js"></script>

</body>
</html>