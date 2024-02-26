<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>To-Do List</h1>
    <div class="sorting-options">
      <a href="list.php?sort=time">Sort by Time</a>
      <a href="list.php?sort=name">Sort by Name</a>
    </div>
    <table class="todo-table">
      <thead>
        <tr>
          <!-- <th>ID</th> -->
          <th>Title</th>
          <th>Content</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Create connection
        $conn = new mysqli("localhost", "root", "", "todo_app");
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Check if sorting option is set in the URL
        $orderBy = isset($_GET['sort']) && ($_GET['sort'] == 'name') ? 'title' : 'created_at';
        
        $sql = "SELECT id, title, content, created_at FROM todo_items ORDER BY $orderBy DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            // echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['content']}</td>";
            echo "<td>{$row['created_at']}</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='4'>No to-do items found.</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
      </tbody>
    </table>
    <a href="index.php" class="back-button">Back</a> 
  </div>
</body>
</html>
