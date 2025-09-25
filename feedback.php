<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect & sanitize
    $name       = htmlspecialchars(trim($_POST["name"] ?? ""));
    $age        = htmlspecialchars(trim($_POST["age"] ?? ""));
    $phone      = htmlspecialchars(trim($_POST["phone"] ?? ""));
    $location   = htmlspecialchars(trim($_POST["location"] ?? ""));
    $waited     = htmlspecialchars(trim($_POST["waited"] ?? ""));
    $waitTime   = htmlspecialchars(trim($_POST["waitTime"] ?? ""));
    $experience = htmlspecialchars(trim($_POST["experience"] ?? ""));
    $suggestions= htmlspecialchars(trim($_POST["suggestions"] ?? ""));
    $service    = htmlspecialchars(trim($_POST["service"] ?? ""));

    // Basic validation
    if (empty($name) || empty($age) || empty($phone) || empty($location)) {
        $error = "❌ All required fields must be filled!";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "❌ Invalid phone number. Must be 10 digits.";
    } elseif (!is_numeric($age) || $age < 18) {
        $error = "❌ You must be 18 or older.";
    } else {
        // Prepare data for storage
        $data = "Name: $name\nAge: $age\nPhone: $phone\nLocation: $location\nWaited: $waited\nWait Time: $waitTime\nExperience: $experience\nSuggestions: $suggestions\nService Rating: $service\n-------------------------\n";
        file_put_contents("feedback_submissions.txt", $data, FILE_APPEND);

        // Show thank-you message
        echo "<h3>✅ Thank you, $name! Your feedback has been recorded.</h3>";
        echo "<p><strong>Phone:</strong> $phone<br>";
        echo "<strong>Service Rating:</strong> $service<br>";
        echo "<strong>Your experience:</strong> $experience</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Queue Feedback Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f7f8;
      margin: 0;
      padding: 20px;
    }

    .feedback-form {
      background: #fff;
      padding: 25px;
      max-width: 600px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .feedback-form h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .feedback-form label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    .feedback-form input[type="text"],
    .feedback-form input[type="number"],
    .feedback-form select,
    .feedback-form textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .feedback-form textarea {
      resize: vertical;
      min-height: 80px;
    }

    .feedback-form button {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .feedback-form button:hover {
      background-color: #218838;
    }

    .error {
      color: red;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>
<body 

<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

<form class="feedback-form" method="post" action="">
  <h2>Customer Feedback - Queue Experience</h2>

  <label for="name">Full Name</label>
  <input type="text" id="name" name="name" required>

  <label for="age">Age</label>
  <input type="number" id="age" name="age" min="1" required>

  <label for="phone">Phone number</label>
  <input type="text" id="phone" name="phone" required>

  <label for="location">Location</label>
  <input type="text" id="location" name="location" required>

  <label for="waited">Did you have to wait?</label>
  <select id="waited" name="waited">
    <option value="">-- Select --</option>
    <option value="yes">Yes</option>
    <option value="no">No</option>
  </select>

  <label for="waitTime">Average Waiting Time (in minutes)</label>
  <input type="number" id="waitTime" name="waitTime" min="0">

  <label for="experience">How was your overall experience?</label>
  <textarea id="experience" name="experience" placeholder="Share your thoughts..."></textarea>

  <label for="suggestions">Any suggestions for improving our facility?</label>
  <textarea id="suggestions" name="suggestions"></textarea>

  <label for="service">How would you rate our service?</label>
  <select id="service" name="service">
    <option value="">-- Select --</option>
    <option value="excellent">Excellent</option>
    <option value="good">Good</option>
    <option value="average">Average</option>
    <option value="poor">Poor</option>
  </select>

  <button type="submit">Submit Feedback</button>
</form>

</body>
</html>