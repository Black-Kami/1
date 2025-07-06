<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            background-color: #f5f5f5;
        }
        
        .calendar {
            width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #4285f4;
            color: white;
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
        }
        
        .day {
            background: white;
            height: 40px;
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
            color: #aaa;
            background: #f9f9f9;
        }
    </style>
</head>
<body>
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

    <script>
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
    </script>
</body>
</html>
