
<!-- update -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h2 {
            color: #007bff;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #007bff;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Update Task</h2>
        <label>Title:</label>
        <p id="taskTitle"></p>
        <label for="newTitle">Change title to:</label>
        <input type="text" id="newTitle">
        <button onclick="updateTask()">Update Title</button>
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
       
        function updateTask() {
            const params = new URLSearchParams(window.location.search);
            const taskId = params.get('id');
            const newTitle = document.getElementById('newTitle').value;

            // Send a PATCH request to update the task title
            fetch(`http://127.0.0.1:8000/api/tasks/${taskId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    title: newTitle,
                }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Handle the success response (optional)
                console.log('Task title updated successfully:', data);
            })
            .catch(error => {
                // Handle errors
                console.error('Error updating task title:', error);
            });

            // Redirect back to the view page
            window.location.href = 'index';
        }
    </script>
</body>

</html>