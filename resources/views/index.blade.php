<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h2, h3 {
            color: #007bff;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #007bff;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }

        .buttons-container {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Todo-List</h2>

        <!-- Create Task Form -->
        <form id="taskForm">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <br>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
            <br>
            <button type="button" onclick="createTask()">Create Task</button>
        </form>

        <hr>

        <div class="container">
            <h2>Task Titles</h2>

            <ul id="taskList"></ul>
        </div>

        <script>
            // Fetch task titles from the API endpoint (replace with your actual API endpoint)
            fetchTasks();

            function fetchTasks() {
                fetch('http://127.0.0.1:8000/api/tasks')
                    .then(response => response.json())
                    .then(data => {
                        // Get the taskList ul element
                        const taskList = document.getElementById('taskList');

                        // Loop through the data and create li elements for each task title
                        data.forEach((task, index) => {
                            const li = document.createElement('li');
                            li.textContent = `${index + 1}. ${task.title}`;

                            // View container div
                            const buttonsContainer = document.createElement('div');
                            buttonsContainer.className = 'buttons-container';

                            // View button
                            const viewButton = document.createElement('button');
                            viewButton.textContent = 'View';
                            viewButton.addEventListener('click', () => viewTask(task.id, task.title, task.description));
                            buttonsContainer.appendChild(viewButton);

                            // Append the buttonsContainer to the li
                            li.appendChild(buttonsContainer);

                            // Append the task li to the taskList
                            taskList.appendChild(li);
                        });
                    })
                    .catch(error => console.error('Error fetching task titles:', error));
            }

            function createTask() {
                const title = document.getElementById('title').value;
                const description = document.getElementById('description').value;

                // Send a POST request to the server to create a new task
                fetch('http://127.0.0.1:8000/api/tasks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // Add any additional headers if required
                    },
                    body: JSON.stringify({
                        title: title,
                        description: description,
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
                    console.log('Task created successfully:', data);

                    // Clear the form fields
                    document.getElementById('title').value = '';
                    document.getElementById('description').value = '';

                    const taskList = document.getElementById('taskList');
                    taskList.innerHTML = '';

                    // Refresh the task list
                    fetchTasks();
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error creating task:', error);
                });
            }

            // Function to view task details (you can implement this as needed)
            function viewTask(id, title, description) {
             // Redirect to the view page with the task ID
            window.location.href = `view?id=${id}`;
            }
           
        </script>
    </div>
</body>

</html>