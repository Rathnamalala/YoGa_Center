<?php
include 'db.php'; // Include the database connection

// Handle the review submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    // Insert review into the database
    $sql = "INSERT INTO reviews (name, review, rating) VALUES ('$name', '$review', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all reviews from the database
$sql = "SELECT * FROM reviews ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each review
    while($row = $result->fetch_assoc()) {
        echo "<div class='review'>";
        echo "<h3>" . $row["name"] . " - Rating: " . str_repeat("⭐", $row["rating"]) . "</h3>";
        echo "<p>" . $row["review"] . "</p>";
        echo "<small>Submitted on: " . $row["created_at"] . "</small>";
        echo "</div><hr>";
    }
} else {
    echo "No reviews yet.";
}
?>
