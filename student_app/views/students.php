<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 0px 10px #ccc;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #0d6efd;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }
    </style>
</head>

<body>

<h2>Student List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
    </tr>

    <?php while($row = $students->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['department']; ?></td>
        </tr>
    <?php } ?>

</table>

</body>
</html>