<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            color: #007bff;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #007bff;
        }

        p {
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        .button-container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Task Details</h2>
        <label>Title:</label>
        <p id="taskTitle"></p>
        <label>Description:</label>
        <p id="taskDescription"></p>
        <div class="button-container">
            <button onclick="navigateToUpdatePage()">Update</button>
            <button onclick="deleteTask()">Delete</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch task details using the task ID from the URL
            const params = new URLSearchParams(window.location.search);
            const taskId = params.get('id');
            fetch(`http://127.0.0.1:8000/api/tasks/${taskId}`)
                .then(response => response.json())
                .then(task => {
                    // Display task details
                    document.getElementById('taskTitle').textContent = task.title;
                    document.getElementById('taskDescription').textContent = task.description;
                })
                .catch(error => console.error('Error fetching task details:', error));
        });

        function navigateToUpdatePage() {
            // Redirect to the update page with the task ID
            const params = new URLSearchParams(window.location.search);
            const taskId = params.get('id');
            window.location.href = `update?id=${taskId}`;
        }

        function deleteTask() {
            const params = new URLSearchParams(window.location.search);
            const taskId = params.get('id');

            // Send a DELETE request to the server
            fetch(`http://127.0.0.1:8000/api/tasks/${taskId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle the success response (optional)
                    console.log('Task deleted successfully:', data);

                   
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error deleting task:', error);
                });
                 // Log the redirect URL
                 console.log('Redirecting to index page...');
                window.location.href = 'index';
        }
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\laravel\todo_app\resources\views/view.blade.php ENDPATH**/ ?>