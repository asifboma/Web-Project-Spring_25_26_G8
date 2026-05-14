<?php
include "../../controllers/taskDetailsController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Details</title>
</head>
<body>

    <h1><?php echo $task["title"]; ?></h1>

    <p>
        <a href="taskBoard.php?project_id=<?php echo $task['project_id']; ?>">Back to Task Board</a>
    </p>

    <p><strong>Description:</strong> <?php echo $task["description"]; ?></p>
    <p><strong>Assigned To:</strong> <?php echo $task["assigned_name"]; ?></p>
    <p><strong>Priority:</strong> <?php echo $task["priority"]; ?></p>
    <p><strong>Due Date:</strong> <?php echo $task["due_date"]; ?></p>
    <p><strong>Status:</strong> <?php echo $task["status"]; ?></p>

    <hr>

    <h2>Comments</h2>

    <div id="commentsList">
        <?php while ($comment = $comments->fetch_assoc()) { ?>
            <div id="comment-<?php echo $comment['id']; ?>" style="border:1px solid #ccc; padding:8px; margin:8px 0;">
                <p>
                    <strong><?php echo $comment["name"]; ?></strong>
                    at <?php echo $comment["created_at"]; ?>
                </p>

                <p><?php echo $comment["body"]; ?></p>

                <?php if ($comment["user_id"] == $_SESSION["user_id"]) { ?>
                    <button onclick="deleteComment(<?php echo $comment['id']; ?>)">Delete</button>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <h3>Post Comment</h3>

    <textarea id="commentBody" rows="4" cols="50"></textarea>
    <br>
    <button onclick="postComment(<?php echo $task_id; ?>)">Post Comment</button>

    <script src="../../assets/js/comments.js"></script>

</body>
</html>