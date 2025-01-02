<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body, html {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f8ff;
            color: #333;
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            max-height: 50px;
            margin-right: 15px;
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #4a90e2;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #4a90e2;
            border: none;
        }

        .btn-primary:hover {
            background-color: #357ab8;
        }

        footer {
            background: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
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
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="form-container">
            <h1 class="form-title">Add Event</h1>
            <form id="eventForm">
                <div class="mb-3">
                    <label for="title" class="form-label">Event Title</label>
                    <input type="text" class="form-control" id="title" name="title" required placeholder="Enter the event title">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required placeholder="Enter event description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required placeholder="Enter event location">
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Event Type</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="" disabled selected>-- Select Event Type --</option>
                        <option value="Conference">Conference</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Seminar">Seminar</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="dateFrom" class="form-label">Date From</label>
                        <input type="date" class="form-control" id="dateFrom" name="dateFrom" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dateTo" class="form-label">Date To</label>
                        <input type="date" class="form-control" id="dateTo" name="dateTo" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="days" class="form-label">Number of Days</label>
                    <input type="text" class="form-control" id="days" name="days" readonly>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit Event</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="m-0 text-muted">&copy; 2025 MyEvent. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- SweetAlert and AJAX Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const dateFrom = document.getElementById('dateFrom');
        const dateTo = document.getElementById('dateTo');
        const daysField = document.getElementById('days');

        dateTo.addEventListener('input', () => {
            const fromDate = new Date(dateFrom.value);
            const toDate = new Date(dateTo.value);

            if (fromDate && toDate && toDate >= fromDate) {
                const days = Math.ceil((toDate - fromDate) / (1000 * 60 * 60 * 24)) + 1;
                daysField.value = days;
            } else {
                daysField.value = '';
            }
        });

        $("#eventForm").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                url: "add_event_handler.php", // Backend script to handle form submission
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    const res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Event Added!",
                            text: res.message,
                        }).then(() => {
                            window.location.href = "mainpage.php"; // Redirect after success
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: res.message,
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong. Please try again.",
                    });
                },
            });
        });
    </script>
</body>
</html>
