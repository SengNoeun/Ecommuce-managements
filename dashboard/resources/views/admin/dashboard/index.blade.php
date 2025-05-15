@extends('Layout.app')
@section('content')

<style>
    .container {
        width: 100%;
        padding: 20px;
    }

    .box-list {
        box-sizing: border-box;
        overflow: hidden;
        margin: 10px auto;
        width: 100%;
        padding: 10px;
    }

    .box-list .box1 {
        background-color: rgb(78, 57, 181);
        width: 23.5%;
        padding: 15px;
        margin: 10px;
        float: left;
        height: 140px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        opacity: 0;
        animation: flyIn 0.6s ease-out forwards;
    }

    .box-list .box1:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .box1 .icon {
        font-size: 2.5rem;
        margin-bottom: 8px;
        color: #ffffff;
    }

    .box1 h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 10px 0;
        color: #ffffff;
    }

    .box1 p {
        font-size: 1rem;
        color: #ffffff;
    }

    /* Fly-in animation keyframes */
    @keyframes flyIn {
        0% {
            opacity: 0;
            transform: translateX(-100px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes flyInLeft {
        0% {
            opacity: 0;
            transform: translateX(-100px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes flyInRight {
        0% {
            opacity: 0;
            transform: translateX(100px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Staggered delays for boxes */
    .box-list .box1:nth-child(1) { animation-delay: 0.1s; }
    .box-list .box1:nth-child(2) { animation-delay: 0.2s; }
    .box-list .box1:nth-child(3) { animation-delay: 0.3s; }
    .box-list .box1:nth-child(4) { animation-delay: 0.4s; }
    .box-list .box1:nth-child(5) { animation-delay: 0.5s; }
    .box-list .box1:nth-child(6) { animation-delay: 0.6s; }
    .box-list .box1:nth-child(7) { animation-delay: 0.7s; }
    .box-list .box1:nth-child(8) { animation-delay: 0.8s; }

    .box-list .box1:nth-child(odd) { animation-name: flyInLeft; }
    .box-list .box1:nth-child(even) { animation-name: flyInRight; }

    /* Table styling */
    .dashboard-table {
        margin: 20px auto;
        width: 100%;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        opacity: 0;
        animation: flyInTable 0.8s ease-out 0.9s forwards; /* Delayed after boxes */
    }

    @keyframes flyInTable {
        0% {
            opacity: 0;
            transform: translateY(50px); /* Fly in from bottom */
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dashboard-table .table {
        margin-bottom: 0;
    }

    .dashboard-table .table thead {
        background-color: rgb(78, 57, 181);
        color: #fff;
    }

    .dashboard-table .table thead th {
        font-weight: 600;
        padding: 12px;
    }

    .dashboard-table .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .dashboard-table .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .dashboard-table .table td {
        padding: 12px;
        vertical-align: middle;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .box-list .box1 {
            width: 46%;
        }
    }

    @media (max-width: 576px) {
        .box-list .box1 {
            width: 100%;
            margin: 10px 0;
        }

        .dashboard-table {
            font-size: 0.9rem;
        }
    }
</style>

<div class="container">
    <div class="box-list">
        <div class="box1">
            <i class="fas fa-users icon"></i>
            <h3>{{$totalUsers}}</h3>
            <p>New Users</p>
        </div>
        <div class="box1">
            <i class="fas fa-shopping-cart icon"></i>
            <h3>760</h3>
            <p>Sales</p>
        </div>
        <div class="box1">
            <i class="fas fa-chart-line icon"></i>
            <h3>12.5%</h3>
            <p>Bounce Rate</p>
        </div>
        <div class="box1">
            <i class="fas fa-globe icon"></i>
            <h3>820</h3>
            <p>Visitors</p>
        </div>
        <div class="box1">
            <i class="fas fa-dollar-sign icon"></i>
            <h3>$18,230</h3>
            <p>Revenue</p>
        </div>
        <div class="box1">
            <i class="fas fa-tasks icon"></i>
            <h3>310/400</h3>
            <p>Purchases</p>
        </div>
        <div class="box1">
            <i class="fas fa-star icon"></i>
            <h3>41,410</h3>
            <p>Likes</p>
        </div>
        <div class="box1">
            <i class="fas fa-envelope icon"></i>
            <h3>250/500</h3>
            <p>Inquiries</p>
        </div>
    </div>

    <!-- New Table Section -->
    
</div>

<!-- Bootstrap 5 JS (Optional for interactivity) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection