<?php

include __DIR__ . "/../../controllers/activityFeedController.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Activity Feed</title>
</head>
<body>

<h1>Activity Feed: <?php echo $project["name"]; ?></h1>

<a href="../project/projectDetails.php?id=<?php echo $project_id; ?>">Project Details</a>
|
<a href="../task/taskBoard.php?project_id=<?php echo $project_id; ?>">Task Board</a>

<br><br>

<label>Filter by Member:</label>

<select id="memberFilter" onchange="filterActivity(<?php echo $project_id; ?>)">
    <option value="">All Members</option>

    <?php

    while($member = $members->fetch_assoc())
    {

    ?>

        <option value="<?php echo $member["id"]; ?>">
            <?php echo $member["name"]; ?>
        </option>

    <?php

    }

    ?>
</select>

<br><br>
<hr>

<div id="activityList">

<?php

while($activity = $activities->fetch_assoc())
{

?>

    <div style="border-bottom:1px solid black; padding:10px;">

        <b>
            <?php echo strtoupper(substr($activity["name"], 0, 1)); ?>
        </b>

        &nbsp;

        <b><?php echo $activity["name"]; ?></b>

        <?php echo $activity["action_text"]; ?>

        <br>

        <small><?php echo timeAgo($activity["created_at"]); ?></small>

    </div>

<?php

}

?>

</div>

<script src="../../assets/js/activity.js"></script>

</body>
</html>