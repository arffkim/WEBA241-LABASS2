<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyEvent - Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .logo {
            max-height: 50px;
            margin-right: 15px;
        }

        .register-section {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem 0;
        }

        .register-content {
            background-color: white;
            border-radius: 20px;
            padding: 4rem 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .register-title {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        .form-control {
            font-size: 1.2rem;
            padding: 1rem;
            border-radius: 12px;
        }

        .btn-primary {
            padding: 1rem 1.5rem;
            font-size: 1.2rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .extra-links {
            margin-top: 1.5rem;
            font-size: 1rem;
            color: var(--light-text);
        }

        footer {
            background-color: white;
            padding: 1rem 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .register-title {
                font-size: 2rem;
            }

            .register-content {
                padding: 2.5rem 2rem;
                margin: 0 1rem;
            }
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyEvent - Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Styles remain the same */
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="myevent.png" alt="MyEvent Logo" class="logo">
                <span class="fw-bold">MyEvent</span>
            </a>
        </div>
    </nav>

    <!-- Register Section -->
    <main class="register-section">
        <div class="register-content text-center">
            <h1 class="register-title">Register for MyEvent</h1>
            <form id="registerForm" action="register_handler.php" method="POST">
                <div class="mb-4 text-start">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullname" required
                        placeholder="Enter your full name">
                </div>
                <div class="mb-4 text-start">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        placeholder="Enter your email">
                </div>
                <div class="mb-4 text-start">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" required
                        placeholder="Enter your phone number">
                </div>
                <div class="mb-4 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required
                        placeholder="Enter your password">
                </div>
                <div class="mb-4 text-start">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required
                        placeholder="Confirm your password">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <div class="extra-links">
                <p>Already have an account? <a href="login.php" class="text-primary">Login here</a></p>
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
