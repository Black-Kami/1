<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-align: center;

        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            height: auto;
            color: var(--text);

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

        main {
            width: 100%;
            display: flex;
            height: auto;
        }

        .article_container {
            width: 100%;
            display: grid;
            flex: 1;
            grid-template-columns: 1fr;
            grid-template-rows: 1fr;
            grid-template-areas:
                "dashboard";
            height: 100%;
        }

        .dashboard.active {
            width: 100%;
            grid-area: dashboard;
            display: grid;
            height: fit-content;
            background-color: grey;
            grid-template-areas:
                "head            head"
                "calendar        pending"
                "calendar        current_event"
                "calendar        upcoming_event"
                "event_status    event_status";
            grid-template-columns: 4fr 1fr;
            grid-template-rows: 50px 245px 245px 238px 335px;
            grid-gap: 5px;
            padding-left: 5px;

        }

        .head {
            grid-area: head;
            text-align: left;
            display: flex;
            align-items: center;
            background-color: whitesmoke;
            border-radius: 5px;
            padding-left: 2rem;
        }

        .dashboard {
            display: none;
            grid-area: dashboard;
        }

        .navigation {
            padding-top: 20px;
            width: 100px;
            background-color: rgba(45, 77, 193, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
        }

        .navigation button {
            cursor: pointer;
        }

        .navigation button:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .calendar {
            background-color: rgba(98, 242, 156, 0.8);
            grid-area: calendar;
            border-radius: 10px;
            min-width: 4fr;
            overflow: hidden;
        }

        .current_event {

            background-color: rgba(255, 110, 110, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            grid-area: current_event;
        }

        .pending {

            background-color: rgba(255, 110, 110, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            grid-area: pending;
        }

        .upcoming_event {

            background-color: rgba(255, 110, 110, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            grid-area: upcoming_event;
        }

        .event_status {
            background-color: rgba(35, 35, 16, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            grid-area: event_status;

        }

        .event_folder_status {
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: 25%;
            display: flex;
            padding: 1rem 2rem;
            gap: 4rem;
            align-items: center;
            display: flex;
            font-size: 1.2rem;
        }

        button {
            border: none;
            font-size: large;
            background-color: transparent;
        }

        .event_folder {
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 5px;
            width: 100%;
            height: 73%;

        }

        footer {
            width: 100%;
            background-color: #333;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-text {
            font-size: 0.9rem;
        }

        .footer-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
/**/
        
        .calendar-header {
            display: flex;
            font-weight: bolder;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #4285f4;
            color: white;
            height: 70px;
        }
        
        .calendar-nav {
            display: flex;
            gap: 15px;
        }
        
        .calendar-nav button {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        
        .weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            padding: 10px 0;
            background: #eee;
            font-weight: bold;
        }
        
        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #ddd;
            border: 1px solid #ccc;
        }
        
        .day {
            background: white;
            height: 103px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .day:hover {
            background: #f0f0f0;
        }
        
        .day.today {
            background: #e1f5fe;
            font-weight: bold;
        }
        
        .day.other-month {
            background:rgba(176, 175, 175, 0.6);
            font-weight: bolder;
        }
    </style>
</head>

<body class="min-h-screen py-0 px-0">
    <header>

        <h2>EduSync</h2>
    </header>
    <main class="max-w-0x5 mx-auto">
        <nav class="navigation">
            <button onclick="showArticle(0)">
                <i class="fas fa-home"></i><br> Home
            </button>
            <button onclick="showArticle(1)">
                <i class="fas fa-file-alt"></i><br> Activity
            </button>
            <button onclick="showArticle(2)">
                <i class="fas fa-group"></i><br> Group
            </button>
            <button onclick="showArticle(3)">
                <i class="fas fa-file-alt"></i><br> Evaluation
            </button>
            <button onclick="showArticle(4)">
                <i class="fas fa-file-alt"></i><br> Event
            </button>

        </nav>
        <section class="article_container">
            <div class="dashboard active" id="article-0">
                <div class="head">
                    <h2 style="font-weight: bolder;">Dashboard</h2>
                </div>
                <div class="calendar">

                    <div class="calendar-header">
                        <button id="prev-month">&lt;</button>
                        <div id="month-year">Month Year</div>
                        <button id="next-month">&gt;</button>
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

                    <div class="days" id="days-container">
                        <!-- Days will be inserted here by JavaScript -->
                    </div>
                </div>
                <div class="pending">
                    <?php
                    $pendingEvents = 0;
                    echo "<h1 style='font-size: 24px; padding: 5px 15px; text-align: left;'>Pending Events {$pendingEvents}</h1>";
                    
                    
                    ?>
                </div>
                <div class="current_event">
                    <?php
                    $currentEvent = 0;
                    echo "<h1 style='font-size: 24px; padding: 5px 15px; text-align: left;'>Current Event {$currentEvent}</h1>";
                    ?>
                </div>
                <div class="upcoming_event">
                    <?php
                    $upcomingEvent = 0;
                    echo "<h1 style='font-size: 24px; padding: 5px 15px; text-align: left;'>Upcoming Event {$upcomingEvent}</h1>";
                    ?>
                </div>
                <div class="event_status">
                    <div class="event_folder_status">

                        <h2 style="font-weight: bolder">Event</h2>

                        <button onclick="showStatus(0)">Proposal</button>
                        <button onclick="showStatus(1)">Completed</button>
                        <button onclick="showStatus(2)">Rejected</button>

                    </div>
                    <div class="event_folder">
                        <div class="folder_status active" id="Status-0">
1
                        </div>
                        <div class="folder_status" id="Status-1">
2
                        </div>
                        <div class="folder_status" id="Status-2">
3
                        </div>
                    </div>

                </div>
            </div>
            <div class="dashboard" id="article-1">

            </div>
            <div class="dashboard" id="article-2">
                <h2>Group</h2>
                <p>Group content goes here.</p>
            </div>
            <div class="dashboard" id="article-3">
                <h2>Evaluation</h2>
                <p>Evaluation content goes here.</p>
            </div>
            <div class="dashboard" id="article-4">
                <h2>Event</h2>
                <p>Event content goes here.</p>
            </div>
            </div>
        </section>

    </main>
    <footer>
        <div class="footer-text">
            @copy; 2025 <strong>EduSync</strong>.
        </div>
        <div class="footer-links">
            <span>Resources</span>
            <span>About</span>
        </div>
    </footer>
    <script>
        function showArticle(index) {
            document.querySelectorAll('.dashboard').forEach((article, q) => {
                article.classList.toggle('active', q === index);
            });
        }
        

 document.addEventListener('DOMContentLoaded', function() {
            // DOM elements
            const monthYearEl = document.getElementById('month-year');
            const daysContainer = document.getElementById('days-container');
            const prevMonthBtn = document.getElementById('prev-month');
            const nextMonthBtn = document.getElementById('next-month');
            
            // Current date state
            let currentDate = new Date();
            
            // Render the calendar
            function renderCalendar() {
                // Get the month and year
                const month = currentDate.getMonth();
                const year = currentDate.getFullYear();
                
                // Update the month-year display
                monthYearEl.textContent = `${getMonthName(month)} ${year}`;
                
                // Get the first day of the month
                const firstDay = new Date(year, month, 1).getDay();
                
                // Get the last day of the month
                const lastDay = new Date(year, month + 1, 0).getDate();
                
                // Get the last day of the previous month
                const prevLastDay = new Date(year, month, 0).getDate();
                
                // Clear the days container
                daysContainer.innerHTML = '';
                
                // Previous month days
                for (let i = firstDay; i > 0; i--) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'day other-month';
                    dayElement.textContent = prevLastDay - i + 1;
                    daysContainer.appendChild(dayElement);
                }
                
                // Current month days
                const today = new Date();
                for (let i = 1; i <= lastDay; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'day';
                    dayElement.textContent = i;
                    
                    // Highlight today
                    if (i === today.getDate() && 
                        month === today.getMonth() && 
                        year === today.getFullYear()) {
                        dayElement.classList.add('today');
                    }
                    
                    daysContainer.appendChild(dayElement);
                }
                
                // Calculate how many next month days we need to show
                const daysLeft = 42 - (firstDay + lastDay);
                
                // Next month days
                for (let i = 1; i <= daysLeft; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'day other-month';
                    dayElement.textContent = i;
                    daysContainer.appendChild(dayElement);
                }
            }
            
            // Helper function to get month name
            function getMonthName(month) {
                const months = [
                    'January', 'February', 'March', 'April', 
                    'May', 'June', 'July', 'August', 
                    'September', 'October', 'November', 'December'
                ];
                return months[month];
            }
            
            // Event listeners for navigation
            prevMonthBtn.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });
            
            nextMonthBtn.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });
            
            // Initial render
            renderCalendar();
        });
        function showStatus(number){
            document.querySelectorAll('.folder_status').forEach((Status, i) => {
                Status.classList.toggle('active', i === number);
            });
        }
    </script>
</body>

</html>