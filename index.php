<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyEvent - Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --soft-blue: #e6f2ff;
            --primary-color: #4a90e2;
            --text-color: #333;
            --light-text: #6c757d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--soft-blue);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo {
            max-height: 50px;
            margin-right: 15px;
        }

        .hero-section {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem 0;
        }

        .hero-content {
            background-color: white;
            border-radius: 20px;
            padding: 4rem 3rem; /* Increased padding for larger card */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 600px; /* Increased width for larger card */
            width: 100%;
        }

        .hero-title {
            font-size: 2.5rem; /* Larger title */
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        .hero-subtitle {
            font-size: 1.2rem; /* Larger subtitle */
            color: var(--light-text);
            margin-bottom: 2rem;
        }

        .btn-primary {
            padding: 1rem 1.5rem;
            font-size: 1.2rem; /* Larger button text */
            border-radius: 12px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        footer {
            background-color: white;
            padding: 1rem 0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-content {
                padding: 2.5rem 2rem;
                margin: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="myevent.png" alt="MyEvent Logo" class="logo">
                <span class="fw-bold">MyEvent</span>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="hero-section">
        <div class="hero-content text-center">
            <h1 class="hero-title">Welcome to MyEvent</h1>
            <p class="hero-subtitle">Discover, Create, and Manage Exceptional Events</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="login.php" class="btn btn-primary">Login</a>
                <a href="register.php" class="btn btn-primary">Register</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="m-0 text-muted">&copy; 2025 MyEvent. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
