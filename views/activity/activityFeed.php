<?php
include "../../controllers/activityFeedController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Activity Feed</title>

    <style>
        .activity-item {
            border-bottom: 1px solid #ccc;
            padding: 10px;
        }

        .avatar {
            display: inline-block;
            background: #222;
            color: white;
            padding: 6px 9px;
            border-radius: 50%;
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <h1>Activity Feed: <?php echo $project["name"]; ?></h1>

    <p>
        <a href="../project/projectDetails.php?id=<?php echo $project_id; ?>">Project Details</a> |
        <a href="../task/taskBoard.php?project_id=<?php echo $project_id; ?>">Task Board</a>
    </p>

    <label>Filter by Member:</label>

    <select id="memberFilter" onchange="filterActivity(<?php echo $project_id; ?>)">
        <option value="">All Members</option>

        <?php while ($member = $members->fetch_assoc()) { ?>
            <option value="<?php echo $member['id']; ?>">
                <?php echo $member["name"]; ?>
            </option>
        <?php } ?>
    </select>

    <hr>

    <div id="activityList">
        <?php while ($activity = $activities->fetch_assoc()) { ?>
            <div class="activity-item">
                <span class="avatar">
                    <?php echo strtoupper(substr($activity["name"], 0, 1)); ?>
                </span>

                <strong><?php echo $activity["name"]; ?></strong>
                <?php echo $activity["action_text"]; ?>

                <br>

                <small><?php echo timeAgo($activity["created_at"]); ?></small>
            </div>
        <?php } ?>
    </div>

    <script src="../../assets/js/activity.js"></script>

</body>
</html>