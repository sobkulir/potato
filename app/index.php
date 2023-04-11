<!DOCTYPE html>
<html>
<head>
    <title>Hello, worlding!</title>
</head>
<body>
<?php
        include './queries.php';
        function printMitreData() {
            $data = getMitreData();
            echo $data;

            // If the data is a string, it means there was an error.
            // Output the error message.
            if (is_string($data)) {
                echo $data;
                return;
            }

            // Otherwise, output the data as a table.
            echo "<table>";
            echo "<thead><tr><th>ID</th><th>Name</th><th>Description</th></tr></thead>";
            echo "<tbody>";
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }

        printMitreData();
    ?>
</body>
</html>
