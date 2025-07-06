<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Creator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .activity-card {
            transition: all 0.3s ease;
        }
        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-indigo-700 mb-2">Activity Creator</h1>
                <p class="text-gray-600">Plan and organize your activities with ease</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create New Activity</h2>
                
                <?php
                // Database connection
                $host = 'localhost'; // Change if necessary
                $db = 'activity_db'; // Your database name
                $user = 'root'; // Your database username
                $pass = ''; // Your database password

                $conn = new mysqli($host, $user, $pass, $db);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Initialize variables
                $title = $description = $date = $time = '';
                $errors = [];
                $activities = [];

                // Check if form is submitted
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Sanitize and validate inputs
                    $title = htmlspecialchars(trim($_POST['title'] ?? ''));
                    $description = htmlspecialchars(trim($_POST['description'] ?? ''));
                    $date = htmlspecialchars(trim($_POST['date'] ?? ''));
                    $time = htmlspecialchars(trim($_POST['time'] ?? ''));

                    // Validate inputs
                    if (empty($title)) $errors['title'] = 'Title is required';
                    if (empty($description)) $errors['description'] = 'Description is required';
                    if (empty($date)) $errors['date'] = 'Date is required';
                    if (empty($time)) $errors['time'] = 'Time is required';

                    // If no errors, create activity
                    if (empty($errors)) {
                        $stmt = $conn->prepare("INSERT INTO activities (title, description, date, time) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $title, $description, $date, $time);
                        $stmt->execute();
                        $stmt->close();

                        // Reset form fields
                        $title = $description = $date = $time = '';
                        
                        // Success message
                        $success = 'Activity created successfully!';
                    }
                }

                // Fetch activities from the database
                $result = $conn->query("SELECT * FROM activities ORDER BY created_at DESC");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $activities[] = $row;
                    }
                }

                $conn->close();
                ?>

                <?php if (isset($success)): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                        <input type="text" id="title" name="title" value="<?php echo $title; ?>"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 <?php echo isset($errors['title']) ? 'border-red-500' : 'border-gray-300'; ?>">
                        <?php if (isset($errors['title'])): ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo $errors['title']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 <?php echo isset($errors['description']) ? 'border-red-500' : 'border-gray-300'; ?>"><?php echo $description; ?></textarea>
                        <?php if (isset($errors['description'])): ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo $errors['description']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="date" class="block text-gray-700 font-medium mb-2">Date</label>
                            <input type="date" id="date" name="date" value="<?php echo $date; ?>"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 <?php echo isset($errors['date']) ? 'border-red-500' : 'border-gray-300'; ?>">
                            <?php if (isset($errors['date'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo $errors['date']; ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="time" class="block text-gray-700 font-medium mb-2">Time</label>
                            <input type="time" id="time" name="time" value="<?php echo $time; ?>"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 <?php echo isset($errors['time']) ? 'border-red-500' : 'border-gray-300'; ?>">
                            <?php if (isset($errors['time'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo $errors['time']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                        Create Activity
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Your Activities</h2>
                
                <?php if (empty($activities)): ?>
                    <div class="text-center py-8">
                        <img src="https://placehold.co/300x200" alt="No activities yet - illustration of empty calendar with clock" class="mx-auto mb-4 rounded-lg">
                        <p class="text-gray-500">No activities created yet. Add your first activity above!</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php foreach ($activities as $activity): ?>
                            <div class="activity-card bg-white border border-gray-200 rounded-lg p-4 hover:shadow-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-semibold text-gray-800"><?php echo $activity['title']; ?></h3>
                                    <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full">
                                        <?php echo date('M j', strtotime($activity['date'])); ?>
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-3"><?php echo $activity['description']; ?></p>
                                <div class="flex justify-between items-center text-sm text-gray-500">
                                    <span><?php echo $activity['time']; ?></span>
                                    <span><?php echo date('g:i A', strtotime($activity['created_at'])); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
