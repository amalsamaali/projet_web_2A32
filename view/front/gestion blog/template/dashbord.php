<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tableau-de-bord.css"> <!-- Lien vers le fichier CSS séparé -->
</head>
<body>
    <div class="sidebar">
        <div class="logo">tripped</div>
        <a href="#"><i class="fas fa-house-user"></i> Dashboard</a>
        <a href="#"><i class="fas fa-calendar-day"></i> Bookings</a>
        <a href="#"><i class="fas fa-bus"></i> Transports</a>
        <a href="#"><i class="fas fa-users"></i> Customers</a>
        <a href="#"><i class="fas fa-star-half-alt"></i> Reviews</a>
        <a href="tableau-de-bord-tour.php"><i class="fas fa-route"></i> Tours</a>
        <a href="#"><i class="fa-solid fa-gear"></i> Settings</a>
        <a href="#" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <div class="top-content">
            <h1>Dashboard</h1>
            <input type="text" class="search" placeholder="Search...">
            <div class="user-info">
                <i class="fas fa-user"></i>
                <span>John Doe</span>
            </div>
        </div>

        <div class="merged-card">
            <div class="card-item">
                <div class="card-title">People Going</div>
                <div class="card-value">274</div>
                <div class="card-description">24% more people than last trip with some itinerary</div>
            </div>
            <div class="card-item">
                <div class="card-title">Destinations Covered</div>
                <div class="card-value">12</div>
                <div class="card-description">12 places to visit in 7 days trip itinerary</div>
            </div>
            <div class="card-item">
                <div class="card-title">People Interested</div>
                <div class="card-value">540</div>
                <div class="card-description">540 showed interest in going for this trip</div>
            </div>
        </div>

        <div class="stats-info">
            <h2>Stats Info</h2>
            <div class="stat-cards">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-title">Active Users</div>
                    <div class="stat-value">1,200</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-title">New Bookings</div>
                    <div class="stat-value">45</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f6f9;
    display: flex;
}

.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #f4f6f9;
    color: #aaa;
    padding-top: 50px;
    position: fixed;
    transition: width 0.3s ease;
}

.sidebar .logo {
    text-align: center;
    font-size: 40px;
    font-weight: 600;
    color: #000;
    padding-bottom: 30px;
}

.sidebar a {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    color: #aaa;
    text-decoration: none;
    font-size: 15px;
    transition: background-color 0.3s ease;
    border-radius: 8px;
    margin-right: 55px;
    margin-left: 30px;
}

.sidebar a i {
    margin-right: 15px;
    font-size: 20px;
}

.sidebar a:hover {
    color: #ffffff;
    background-color: #00A2E8;
}

.sidebar .logout {
    margin-top: 140px;
    padding: 10px 15px;
    text-align: center;
    background-color: transparent;
    border-radius: 8px;
}

.content {
    margin-left: 250px;
    padding: 20px;
    width: calc(100% - 250px);
    height: 100vh;
    background-color: #fff;
}

.top-content {
    display: flex;
    align-items: center;
}

.content h1 {
    font-size: 38px;
    color: #333;
    margin-right: 80px;
}

.search {
    border: 1px solid #ddd;
    padding: 5px 15px;
    border-radius: 20px;
    width: 400px;
    height: 35px;
}

.user-info {
    display: flex;
    align-items: center;
    margin-left: 250px;
}

.user-info i {
    font-size: 16px;
    color: #333;
    margin-right: 10px;
}

.user-info span {
    font-size: 16px;
    color: #333;
}

.merged-card {
    background-color: #3580BB;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: flex;
    justify-content: space-between;
    gap: 20px;
    color: #fff;
    margin-top: 30px;
}

.merged-card .card-item {
    text-align: left;
    width: 30%;
    padding: 15px;
    background-color: #3580BB;
    border-radius: 8px;
    box-sizing: border-box;
}

.merged-card .card-item:not(:last-child) {
    border-right: 1px solid rgba(255, 255, 255, 0.2);
}

.merged-card .card-item .card-title {
    font-size: 18px;
    margin-bottom: 10px;
}

.merged-card .card-item .card-value {
    font-size: 28px;
    font-weight: bold;
}

.merged-card .card-item .card-description {
    font-size: 14px;
    margin-top: 10px;
    font-style: italic;
}

.stats-info {
    margin-top: 40px;
}

.stats-info h2 {
    font-size: 26px;
    color: #333;
    margin-bottom: 20px;
}

.stat-cards {
    display: flex;
    gap: 20px;
}

.stat-card {
    background-color: #f4f6f9;
    border-radius: 8px;
    padding: 20px;
    width: 250px;
    text-align: left;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    flex-direction: column;
}

.stat-card .stat-title {
    font-size: 16px;
    color: #333;
    margin-left: 10px;
    font-weight: bold;
    flex: 1;
}

.stat-card .stat-value {
    font-size: 24px;
    font-weight: bold;
    color: #2f3640;
    margin-top: 10px;
}

.stat-card .stat-icon {
    font-size: 30px;
    color: #3580BB;
}
