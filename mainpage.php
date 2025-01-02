<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Redirecting...</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: 'You are not logged in. Please log in first.',
        }).then(() => {
            window.location.href = 'login.php'; // Redirect to login page after alert
        });
    </script>
    </body>
    </html>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page - View Events</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body,
        html {
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

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .event-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            cursor: pointer;
        }

        .event-card h5 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #4a90e2;
        }

        .event-card p {
            font-size: 0.9rem;
            color: #666;
        }

        .pagination {
            justify-content: center;
        }

        footer {
            background: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        .add-event-btn {
            background-color: #5cb85c;
            color: white;
            border: none;
        }

        .add-event-btn:hover {
            background-color: #4cae4c;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="myevent.png" alt="MyEvent Logo" class="logo" style="max-height: 50px; margin-right: 10px;">
                <span class="fw-bold">MyEvent</span>
            </a>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content container">
        <h1 class="mb-4">Available Events</h1>

        <!-- Search Bar -->
        <div class="d-flex justify-content-between mb-4">
            <input type="text" id="searchBar" class="form-control me-2" placeholder="Search for events..."
                oninput="filterEvents()">
            <a href="addevent.php" class="btn add-event-btn">Add Event</a>
        </div>

        <!-- Event Cards -->
        <div id="cardContainer" class="card-container">
            <!-- Cards will be dynamically generated here using database data -->
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination" id="pagination">
                <!-- Pagination buttons will be dynamically generated -->
            </ul>
        </nav>
    </div>

    <!-- Event Details Modal -->
    <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventDetailsModalLabel">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Title:</strong> <span id="eventTitle"></span></p>
                    <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                    <p><strong>Type:</strong> <span id="eventType"></span></p>
                    <p><strong>Location:</strong> <span id="eventLocation"></span></p>
                    <p><strong>Date From:</strong> <span id="eventDateFrom"></span></p>
                    <p><strong>Date To:</strong> <span id="eventDateTo"></span></p>
                    <p><strong>Days:</strong> <span id="eventDays"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="m-0 text-muted">&copy; 2025 MyEvent. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        const itemsPerPage = 12;
        let currentPage = 1;
        let events = [];

        async function fetchEvents() {
            try {
                const response = await fetch('fetch_events.php'); // Backend file to fetch events
                const data = await response.json();
                events = data;
                renderEvents();
            } catch (error) {
                console.error("Error fetching events:", error);
            }
        }

        function renderEvents(page = 1) {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const visibleEvents = events.slice(startIndex, endIndex);

            const cardContainer = document.getElementById("cardContainer");
            cardContainer.innerHTML = "";

            visibleEvents.forEach(event => {
                const card = document.createElement("div");
                card.className = "event-card";
                card.setAttribute("onclick", `showEventDetails('${event.id}', '${event.title}', '${event.description}', '${event.type}', '${event.location}', '${event.date_from}', '${event.date_to}', '${event.days}')`);
                card.innerHTML = `
            <h5>${event.title}</h5>
            <p><strong>Description:</strong> ${event.description}</p>
            <p><strong>Type:</strong> ${event.type}</p>
            <p><strong>Location:</strong> ${event.location}</p>
            <p><strong>Date:</strong> ${event.date_from} to ${event.date_to}</p>
            <p><strong>Days:</strong> ${event.days}</p>
        `;
                cardContainer.appendChild(card);
            });

            renderPagination();
        }



        function renderPagination() {
            const pagination = document.getElementById("pagination");
            const totalPages = Math.ceil(events.length / itemsPerPage);
            pagination.innerHTML = "";

            for (let i = 1; i <= totalPages; i++) {
                const pageItem = document.createElement("li");
                pageItem.className = `page-item ${i === currentPage ? "active" : ""}`;
                pageItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                pagination.appendChild(pageItem);
            }
        }

        function changePage(page) {
            currentPage = page;
            renderEvents(page);
        }

        function filterEvents() {
            const searchBar = document.getElementById('searchBar').value.toLowerCase();
            const filteredEvents = events.filter(event =>
                event.title.toLowerCase().includes(searchBar) ||
                event.description.toLowerCase().includes(searchBar)
            );
            currentPage = 1;
            renderFilteredEvents(filteredEvents); // Render the filtered events
        }

        function renderFilteredEvents(filteredEvents) {
            const cardContainer = document.getElementById("cardContainer");
            cardContainer.innerHTML = "";

            filteredEvents.forEach(event => {
                const card = document.createElement("div");
                card.className = "event-card";
                card.setAttribute("onclick", `showEventDetails('${event.id}', '${event.title}', '${event.description}', '${event.type}', '${event.location}', '${event.date_from}', '${event.date_to}', '${event.days}')`);
                card.innerHTML = `
            <h5>${event.title}</h5>
            <p><strong>Description:</strong> ${event.description}</p>
            <p><strong>Type:</strong> ${event.type}</p>
            <p><strong>Location:</strong> ${event.location}</p>
            <p><strong>Date:</strong> ${event.date_from} to ${event.date_to}</p>
            <p><strong>Days:</strong> ${event.days}</p>
        `;
                cardContainer.appendChild(card);
            });

            // Hide pagination for filtered results
            document.getElementById("pagination").innerHTML = "";
        }



        function showEventDetails(id, title, description, type, location, dateFrom, dateTo, days) {
            document.getElementById('eventTitle').textContent = title;
            document.getElementById('eventDescription').textContent = description;
            document.getElementById('eventType').textContent = type;
            document.getElementById('eventLocation').textContent = location;
            document.getElementById('eventDateFrom').textContent = dateFrom;
            document.getElementById('eventDateTo').textContent = dateTo;
            document.getElementById('eventDays').textContent = days;

            // Add Edit and Delete buttons dynamically
            const modalFooter = document.querySelector('.modal-footer');
            modalFooter.innerHTML = `
        <button class="btn btn-primary" onclick="editEvent('${id}')">Edit</button>
        <button class="btn btn-danger" onclick="deleteEvent('${id}')">Delete</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    `;

            const modal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
            modal.show();
        }
        function editEvent(id) {
            // Redirect the user to the edit event page with the event ID as a query parameter
            window.location.href = `edit_event.php?id=${id}`;
        }

        function deleteEvent(id) {
            console.log(`Attempting to delete event with ID: ${id}`);
            const deleteUrl = `delete_event.php?id=${id}`;
            console.log(`DELETE request URL: ${deleteUrl}`);

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete this event? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deleteUrl, { method: 'DELETE' })
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then((data) => {
                            if (data.success) {
                                Swal.fire('Deleted!', data.message, 'success').then(() => {
                                    fetchEvents(); // Refresh events
                                });
                            } else {
                                Swal.fire('Error!', data.message, 'error');
                            }
                        })
                        .catch((error) => {
                            console.error('Error deleting event:', error);
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        });
                }
            });
        }




        fetchEvents();
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>