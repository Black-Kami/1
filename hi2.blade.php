<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking Calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS will go here */
        :root {
            --primary: #3498db;
            --secondary: #e74c3c;
            --accent: #f39c12;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #2ecc71;
            --warning: #f1c40f;
            --danger: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }
        header {
            width: auto;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        /* Calendar Styles */
        .calendar-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: linear-gradient(135deg, var(--primary), #2980b9);
            color: white;
        }

        .month-nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .month-nav button {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background 0.2s;
        }

        .month-nav button:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .month-year {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            background-color: var(--light);
            padding: 10px 0;
            text-align: center;
            font-weight: bold;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background-color: #ddd;
        }

        .day {
            background: white;
            min-height: 100px;
            padding: 5px;
            position: relative;
            cursor: pointer;
        }

        .day:hover {
            background-color: #f9f9f9;
        }

        .day-number {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .event {
            background-color: var(--primary);
            color: white;
            font-size: 0.8rem;
            padding: 2px 5px;
            border-radius: 3px;
            margin-bottom: 2px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
        }

        .event.pending {
            background-color: var(--warning);
            color: var(--dark);
        }

        .event.approved {
            background-color: var(--success);
        }

        .event.rejected {
            background-color: var(--danger);
        }

        .day.other-month {
            background-color: #f8f9fa;
            color: #aaa;
        }

        .day.today {
            background-color: #e3f2fd;
        }

        .day.today .day-number {
            color: var(--primary);
            font-weight: bold;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            color: var(--dark);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #777;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-success:hover {
            background-color: #27ae60;
        }

        .btn-warning {
            background-color: var(--warning);
            color: var(--dark);
        }

        .btn-warning:hover {
            background-color: #f39c12;
        }

        /* Admin Dashboard */
        .dashboard {
            margin-top: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .dashboard-header {
            padding: 15px 20px;
            background: linear-gradient(135deg, var(--dark), #34495e);
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--light);
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .pending-badge {
            background-color: var(--warning);
            color: var(--dark);
        }

        .approved-badge {
            background-color: var(--success);
            color: white;
        }

        .rejected-badge {
            background-color: var(--danger);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .month-year {
                font-size: 1.2rem;
            }

            .weekdays,
            .days {
                font-size: 0.9rem;
            }

            .event {
                font-size: 0.7rem;
                padding: 1px 3px;
            }

            th,
            td {
                padding: 8px 10px;
                font-size: 0.9rem;
            }
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background-color: var(--success);
            color: white;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            transform: translateX(200%);
            transition: transform 0.3s ease;
            z-index: 1100;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.error {
            background-color: var(--danger);
        }

        .notification.warning {
            background-color: var(--warning);
            color: var(--dark);
        }
        

    </style>
</head>

<body>
   
    <div class="container">
        <header>
            <h1>Event Booking Calendar</h1>
            <button id="toggleAdminBtn" class="btn btn-warning">Toggle Admin View</button>
        </header>

        <div class="calendar-container">
            <div class="calendar-header">
                <div class="month-nav">
                    <button id="prevMonth"><i class="fas fa-chevron-left"></i></button>
                    <h2 class="month-year">Month Year</h2>
                    <button id="nextMonth"><i class="fas fa-chevron-right"></i></button>
                </div>
                <button id="todayBtn" class="btn btn-primary">Today</button>
            </div>

            <div class="weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>

            <div class="days" id="calendarDays">
                <!-- Days will be generated by JavaScript -->
            </div>
        </div>

        <!-- Admin Dashboard (Hidden by default) -->
        <div class="dashboard" id="adminDashboard" style="display: none;">
            <div class="dashboard-header">
                <h2>Booking Approvals</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="approvalsTable">
                    <!-- Bookings will be filled by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Event Modal -->
    <div class="modal" id="eventModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Event</h2>
                <button class="close-btn" id="closeEventModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="form-group">
                        <label for="eventName">Event Name</label>
                        <input type="text" id="eventName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="eventDate">Date</label>
                        <input type="date" id="eventDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="eventTime">Time</label>
                        <input type="time" id="eventTime" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="cancelEventModal">Cancel</button>
                <button class="btn btn-primary" id="saveEvent">Save Event</button>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    <div class="modal" id="bookingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Event Booking</h2>
                <button class="close-btn" id="closeBookingModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <div class="form-group">
                        <label for="yourName">Your Name</label>
                        <input type="text" id="yourName" class="form-control" required>
                    </div>
                    <div id="bookingEventInfo">
                        <!-- Event info will be filled by JavaScript -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="cancelBookingModal">Cancel</button>
                <button class="btn btn-primary" id="submitBooking">Submit Booking</button>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal" id="rejectModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Reject Booking</h2>
                <button class="close-btn" id="closeRejectModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="rejectForm">
                    <div class="form-group">
                        <label for="rejectReason">Reason for rejection</label>
                        <textarea id="rejectReason" class="form-control" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" id="cancelRejectModal">Cancel</button>
                <button class="btn btn-danger" id="confirmReject">Confirm Rejection</button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div class="notification" id="notification"></div>

    <script>
        // Calendar functionality
document.addEventListener('DOMContentLoaded', function() {
    // Calendar data and state
    const state = {
        currentDate: new Date(),
        events: [
            {
                id: 1,
                name: 'Team Meeting',
                date: new Date(new Date().setDate(new Date().getDate() + 2)).toISOString(),
                createdBy: 'admin'
            },
            {
                id: 2,
                name: 'Product Launch',
                date: new Date(new Date().setDate(new Date().getDate() + 5)).toISOString(),
                createdBy: 'admin'
            }
        ],
        bookings: [
            {
                id: 1,
                eventId: 1,
                userName: 'John Doe',
                status: 'pending',
                reason: ''
            }
        ],
        isAdmin: false,
        selectedDate: null,
        selectedEvent: null,
        selectedBooking: null
    };

    // DOM elements
    const elements = {
        monthYear: document.querySelector('.month-year'),
        calendarDays: document.getElementById('calendarDays'),
        prevMonth: document.getElementById('prevMonth'),
        nextMonth: document.getElementById('nextMonth'),
        todayBtn: document.getElementById('todayBtn'),
        toggleAdminBtn: document.getElementById('toggleAdminBtn'),
        adminDashboard: document.getElementById('adminDashboard'),
        approvalsTable: document.getElementById('approvalsTable'),
        
        // Event modal
        eventModal: document.getElementById('eventModal'),
        closeEventModal: document.getElementById('closeEventModal'),
        cancelEventModal: document.getElementById('cancelEventModal'),
        eventForm: document.getElementById('eventForm'),
        eventName: document.getElementById('eventName'),
        eventDate: document.getElementById('eventDate'),
        eventTime: document.getElementById('eventTime'),
        saveEvent: document.getElementById('saveEvent'),
        
        // Booking modal
        bookingModal: document.getElementById('bookingModal'),
        closeBookingModal: document.getElementById('closeBookingModal'),
        cancelBookingModal: document.getElementById('cancelBookingModal'),
        bookingForm: document.getElementById('bookingForm'),
        bookingEventInfo: document.getElementById('bookingEventInfo'),
        yourName: document.getElementById('yourName'),
        submitBooking: document.getElementById('submitBooking'),
        
        // Reject modal
        rejectModal: document.getElementById('rejectModal'),
        closeRejectModal: document.getElementById('closeRejectModal'),
        cancelRejectModal: document.getElementById('cancelRejectModal'),
        rejectForm: document.getElementById('rejectForm'),
        rejectReason: document.getElementById('rejectReason'),
        confirmReject: document.getElementById('confirmReject'),
        
        // Notification
        notification: document.getElementById('notification')
    };

    // Initialize the calendar
    function initCalendar() {
        renderCalendar();
        renderAdminDashboard();
        setupEventListeners();
    }

    // Render the calendar
    function renderCalendar() {
        const year = state.currentDate.getFullYear();
        const month = state.currentDate.getMonth();
        
        // Set month and year in header
        elements.monthYear.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;
        
        // Get first day of month and total days in month
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();
        
        // Clear previous days
        elements.calendarDays.innerHTML = '';
        
        // Add empty cells for days before the first day of the month
        for (let i = 0; i < firstDay; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.className = 'day other-month';
            elements.calendarDays.appendChild(emptyDay);
        }
        
        // Add cells for each day of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            const date = new Date(year, month, day);
            
            // Check if this is today
            const isToday = date.getDate() === today.getDate() && 
                           date.getMonth() === today.getMonth() && 
                           date.getFullYear() === today.getFullYear();
            
            dayElement.className = `day ${isToday ? 'today' : ''}`;
            
            // Add day number
            const dayNumber = document.createElement('div');
            dayNumber.className = 'day-number';
            dayNumber.textContent = day;
            dayElement.appendChild(dayNumber);
            
            // Add events for this day
            const eventsForDay = state.events.filter(event => {
                const eventDate = new Date(event.date);
                return eventDate.getDate() === day && 
                       eventDate.getMonth() === month && 
                       eventDate.getFullYear() === year;
            });
            
            eventsForDay.forEach(event => {
                const eventElement = document.createElement('div');
                eventElement.className = 'event';
                eventElement.textContent = event.name;
                eventElement.dataset.eventId = event.id;
                
                // Check if there's a booking for this event
                const booking = state.bookings.find(b => b.eventId === event.id);
                if (booking) {
                    eventElement.classList.add(booking.status);
                }
                
                eventElement.addEventListener('click', () => handleEventClick(event));
                dayElement.appendChild(eventElement);
            });
            
            // Add click handler for the day
            dayElement.addEventListener('click', () => handleDayClick(date));
            elements.calendarDays.appendChild(dayElement);
        }
    }

    // Render admin dashboard
    function renderAdminDashboard() {
        elements.approvalsTable.innerHTML = '';
        
        state.bookings.forEach(booking => {
            const event = state.events.find(e => e.id === booking.eventId);
            if (!event) return;
            
            const row = document.createElement('tr');
            
            // Event name
            const eventCell = document.createElement('td');
            eventCell.textContent = event.name;
            row.appendChild(eventCell);
            
            // Event date
            const dateCell = document.createElement('td');
            dateCell.textContent = new Date(event.date).toLocaleString();
            row.appendChild(dateCell);
            
            // User name
            const userCell = document.createElement('td');
            userCell.textContent = booking.userName;
            row.appendChild(userCell);
            
            // Status
            const statusCell = document.createElement('td');
            const statusBadge = document.createElement('span');
            statusBadge.className = `status-badge ${booking.status}-badge`;
            statusBadge.textContent = booking.status.charAt(0).toUpperCase() + booking.status.slice(1);
            statusCell.appendChild(statusBadge);
            row.appendChild(statusCell);
            
            // Actions
            const actionsCell = document.createElement('td');
            
            if (booking.status === 'pending') {
                // Approve button
                const approveBtn = document.createElement('button');
                approveBtn.className = 'btn btn-success btn-sm';
                approveBtn.textContent = 'Approve';
                approveBtn.addEventListener('click', () => approveBooking(booking.id));
                actionsCell.appendChild(approveBtn);
                
                // Reject button
                const rejectBtn = document.createElement('button');
                rejectBtn.className = 'btn btn-danger btn-sm';
                rejectBtn.textContent = 'Reject';
                rejectBtn.addEventListener('click', () => showRejectModal(booking.id));
                actionsCell.appendChild(rejectBtn);
            }
            
            row.appendChild(actionsCell);
            elements.approvalsTable.appendChild(row);
        });
    }

    // Setup event listeners
    function setupEventListeners() {
        // Navigation buttons
        elements.prevMonth.addEventListener('click', () => {
            state.currentDate.setMonth(state.currentDate.getMonth() - 1);
            renderCalendar();
        });
        
        elements.nextMonth.addEventListener('click', () => {
            state.currentDate.setMonth(state.currentDate.getMonth() + 1);
            renderCalendar();
        });
        
        elements.todayBtn.addEventListener('click', () => {
            state.currentDate = new Date();
            renderCalendar();
        });
        
        // Toggle admin view
        elements.toggleAdminBtn.addEventListener('click', () => {
            state.isAdmin = !state.isAdmin;
            elements.adminDashboard.style.display = state.isAdmin ? 'block' : 'none';
            elements.toggleAdminBtn.textContent = state.isAdmin ? 'User View' : 'Admin View';
        });
        
        // Event modal
        elements.closeEventModal.addEventListener('click', () => {
            elements.eventModal.style.display = 'none';
        });
        
        elements.cancelEventModal.addEventListener('click', () => {
            elements.eventModal.style.display = 'none';
        });
        
        elements.saveEvent.addEventListener('click', () => {
            if (elements.eventForm.checkValidity()) {
                const newEvent = {
                    id: state.events.length + 1,
                    name: elements.eventName.value,
                    date: new Date(`${elements.eventDate.value}T${elements.eventTime.value}`).toISOString(),
                    createdBy: 'admin'
                };
                
                state.events.push(newEvent);
                renderCalendar();
                elements.eventModal.style.display = 'none';
                elements.eventForm.reset();
                showNotification('Event created successfully!');
            } else {
                elements.eventForm.reportValidity();
            }
        });
        
        // Booking modal
        elements.closeBookingModal.addEventListener('click', () => {
            elements.bookingModal.style.display = 'none';
        });
        
        elements.cancelBookingModal.addEventListener('click', () => {
            elements.bookingModal.style.display = 'none';
        });
        
        elements.submitBooking.addEventListener('click', () => {
            if (elements.bookingForm.checkValidity()) {
                const newBooking = {
                    id: state.bookings.length + 1,
                    eventId: state.selectedEvent.id,
                    userName: elements.yourName.value,
                    status: 'pending',
                    reason: ''
                };
                
                state.bookings.push(newBooking);
                renderCalendar();
                renderAdminDashboard();
                elements.bookingModal.style.display = 'none';
                elements.bookingForm.reset();
                showNotification('Booking submitted successfully!');
            } else {
                elements.bookingForm.reportValidity();
            }
        });
        
        // Reject modal
        elements.closeRejectModal.addEventListener('click', () => {
            elements.rejectModal.style.display = 'none';
        });
        
        elements.cancelRejectModal.addEventListener('click', () => {
            elements.rejectModal.style.display = 'none';
        });
        
        elements.confirmReject.addEventListener('click', () => {
            if (elements.rejectForm.checkValidity()) {
                const booking = state.bookings.find(b => b.id === state.selectedBooking);
                if (booking) {
                    booking.status = 'rejected';
                    booking.reason = elements.rejectReason.value;
                    renderCalendar();
                    renderAdminDashboard();
                    elements.rejectModal.style.display = 'none';
                    elements.rejectForm.reset();
                    showNotification('Booking rejected!');
                }
            } else {
                elements.rejectForm.reportValidity();
            }
        });
    }

    // Handle day click
    function handleDayClick(date) {
        state.selectedDate = date;
        
        if (state.isAdmin) {
            // Show add event modal for admin
            elements.eventDate.value = date.toISOString().split('T')[0];
            elements.eventTime.value = '09:00';
            elements.eventModal.style.display = 'flex';
        }
    }

    // Handle event click
    function handleEventClick(event) {
        state.selectedEvent = event;
        
        if (state.isAdmin) {
            // Admin can view/edit event
            showNotification(`Viewing event: ${event.name}`);
        } else {
            // User can book the event
            elements.bookingEventInfo.innerHTML = `
                <h4>${event.name}</h4>
                <p>Date: ${new Date(event.date).toLocaleString()}</p>
            `;
            elements.bookingModal.style.display = 'flex';
        }
    }

    // Approve booking
    function approveBooking(bookingId) {
        const booking = state.bookings.find(b => b.id === bookingId);
        if (booking) {
            booking.status = 'approved';
            renderCalendar();
            renderAdminDashboard();
            showNotification('Booking approved!');
        }
    }

    // Show reject modal
    function showRejectModal(bookingId) {
        state.selectedBooking = bookingId;
        elements.rejectModal.style.display = 'flex';
    }

    // Show notification
    function showNotification(message, type = 'success') {
        elements.notification.textContent = message;
        elements.notification.className = `notification show ${type}`;
        
        setTimeout(() => {
            elements.notification.classList.remove('show');
        }, 3000);
    }

    // Initialize the calendar
    initCalendar();
});

    </script>


</body>

</html>