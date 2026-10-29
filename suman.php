
<?php
// Database connection details
$servername = "localhost";
$username = "2439648";
$password = "39Kathmandu@";
$dbname = "db2439648";

// Connect to the MySQL database
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

// Check the connection
if ($conn->connect_error) {
    die("Database connection failed.");
}

// Set character encoding
$conn->set_charset("utf8mb4");

// Retrieve all books
$sql = "SELECT Book_id, Book_name, Genre, Price, Date_of_release
        FROM books
        ORDER BY Book_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Books Database</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }
    </style>
</head>

<body>

    <h1>Books Database</h1>

    <?php if ($result === false): ?>

        <p>Unable to retrieve the books.</p>

    <?php elseif ($result->num_rows > 0): ?>

        <table>
            <thead>
                <tr>
                    <th>Book name</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Date of release</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars(
                                $row['Book_name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row['Genre'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= '&pound;' . number_format(
                                (float) $row['Price'],
                                2
                            ) ?>
                        </td>

                        <td>
                            <?= date(
                                'd/m/Y',
                                strtotime($row['Date_of_release'])
                            ) ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <?php else: ?>

        <p>No books found in the database.</p>

    <?php endif; ?>

    <?php
    $result?->free();
    $conn->close();
    ?>

</body>
</html>
