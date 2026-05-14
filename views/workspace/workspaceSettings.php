<?php
include "../../controllers/workspaceSettingsController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Workspace Settings</title>
</head>
<body>

    <h1>Workspace Settings</h1>
    <h2>Workspace Information</h2>

<p>
    <strong>Workspace Name:</strong>
    <?php echo $workspace["name"]; ?>
</p>

<p>
    <strong>Invite Code:</strong>
    <span style="font-size:20px; font-weight:bold; color:blue;">
        <?php echo $workspace["invite_code"]; ?>
    </span>
</p>

<p>Share this invite code with teammates so they can join this workspace.</p>

<hr>

    <p><a href="workspaceHome.php">Workspace Home</a></p>
    <p><a href="../project/projectList.php">Project List</a></p>

    <h2>Members</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Joined At</th>
            <th>Action</th>
        </tr>

        <?php while ($member = $members->fetch_assoc()) { ?>
            <tr id="member-<?php echo $member['member_id']; ?>">
                <td><?php echo $member["name"]; ?></td>
                <td><?php echo $member["email"]; ?></td>
                <td><?php echo $member["joined_at"]; ?></td>
                <td>
                    <?php if ($member["user_id"] != $_SESSION["user_id"]) { ?>
                        <button onclick="removeMember(<?php echo $member['member_id']; ?>)">Remove</button>
                    <?php } else { ?>
                        Owner
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <script src="../../assets/js/workspace.js"></script>

</body>
</html>