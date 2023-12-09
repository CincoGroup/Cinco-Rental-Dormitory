<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Screen</title>
</head>
  <style>
    body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    overflow: hidden; /* Prevent scrolling during loading */
}

.loading-screen {
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

  </style>
<body>
    <div class="loading-screen">
        <div class="loader"></div>
    </div>

    <script>
        // Simulate loading (setTimeout is used for demonstration purposes)
        setTimeout(function () {
            // Redirect to home.html after loading
            window.location.href = 'home.html';
        }, 3000); // 3000 milliseconds (3 seconds) delay for demonstration
    </script>
</body>
</html>
