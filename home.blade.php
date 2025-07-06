<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 {
            margin: 0;
            color: rgb(62, 120, 255);
        }

        .home_login_btn {
            background-color:rgb(227, 227, 227);
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 20px;
            
        }

        .home_page {
            
            padding: 50px 20px;
            background-color:rgba(22, 43, 204, 0.7);
            display: flex;
            padding: 2rem;
            background: linear-gradient(90deg, #ffcc00 50%,rgb(63, 162, 255) 50%);
            

        }
        .home_page_left {
            width: 50%;
            padding-right: 2rem;
        }

        .home_page h1 {
            font-size: 2.5em;
            line-height: 1.2;
            color: #000;
        }
        .home_page h1 span {
            color: #4a90e2;
        }

        .home_page p {
            font-size: 1rem;
            margin-top: 1rem;
        }
        .home_page_right {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .calendar_image {
            width: 90%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        .home_page_low_content {
            max-width: 800px;
            text-align: center;
            margin: auto;
            font: 1rem;
            padding: 1.5rem 2rem;
        }

        footer {
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

        
    </style>
</head>
<body>
    <header>
        <h2>EduSync</h2>
        <button class="home_login_btn">Login</button>
    </header>
    <section class="home_page">
        <div class="home_page_left">
            <h1>EDUSYNC <br />
                EVENT <br />
                MANAGEMENT <br />
                <span>SOFTWARE</span>
            </h1>
        <p>All-in-one platforms to manage event, activity,
             reports, event schedule, proposal and more.</p>
        </div>
        
        <div class="home_page_right">
<img src="{{ asset('image/calendar.jpg') }}" alt="" class="calendar_image" >
        </div>

    </section>
    <section class="home_page_low_content">
        <p>EduSync is a digital event management system that helps schools and
            colleges plan and manage student activities more easily. It makes 
            tasks like scheduling, getting approvals, and sending updates easy to do,
            which helpskeep everything organized and on time. By putting all the 
            details in one place, EduSync removes the need for paperwork and scattered 
            messages, making it easier top run events smoothly from start to finish.
        </p>
    </section>
    <footer>
        <div class="footer-text">
            @copy; 2025 <strong>EduSync</strong>.
        </div>
        <div class="footer-links">
            <span>Resources</span>
            <span>About</span>
        </div>
    </footer>
</body>
</html>
