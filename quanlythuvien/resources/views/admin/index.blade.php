@extends('admin.master')
@section('main-content')
<div class="main-content">
    <div class="top-bar">
        <h1>Dashboard</h1>
        <div class="date-navigation">
            <button class="active">Today</button>
            <button>Yesterday</button>
            <button>Week</button>
            <button>Month</button>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <h3>Tổng sách</h3>
            <div class="icon"><span class="icon-placeholder"></span></div>
            <div class="value">{{number_format($totalBooks)}}</div>
        </div>
        <div class="kpi-card">
            <h3>Đã cho mượn</h3>
            <div class="icon"><span class="icon-placeholder"></span></div>
            <div class="value">{{number_format($borrowedCount)}}</div>
        </div>
        <div class="kpi-card">
            <h3>Thể loại sách</h3>
            <div class="icon"><span class="icon-placeholder"></span></div>
            <div class="value">{{number_format($overdueCount)}}</div>
        </div>
        <div class="kpi-card">
            <h3>Sách hiện có</h3>
            <div class="icon"><span class="icon-placeholder"></span></div>
            <div class="value">{{ number_format($totalBooks - $borrowedCount) }}</div>
        </div>
        <div class="kpi-card">
            <h3>Số bạn đọc trễ hạn</h3>
            <div class="icon"><span class="icon-placeholder"></span></div>
            <div class="value">{{ number_format($overdueCount) }}</div>
        </div>
    </div>


    <div class="chart-section">
        <div class="chart-card">
            <h3>Số lượng mượn sách theo tháng</h3>
            <canvas id="borrowChart" style="height: 50px;  border: 1px solid #ddd;"></canvas>
        </div>
    </div>

    <div class="data-grid">
        <div class="data-card">
            <h3>Danh sách sinh viên quá hạn</h3>
            <ul class="data-list">
                @foreach($overdueMembers as $member)
                    <li><span class="label">{{ $member->full_name }}</span> <span class="value">{{ $member->borrow_id }}</span></li>
                @endforeach
            </ul>
        </div>
        <div class="data-card">
            <h3>Sách đọc nhiều nhất</h3>
            <ul class="data-list">
                <li><span class="label">Quizzes taken</span> <span class="value">139</span></li>
                <li><span class="label">Questions Answered</span> <span class="value">283</span></li>
                <li><span class="label">Assignments completed</span> <span class="value">782</span></li>
                <li><span class="label">Badges earned</span> <span class="value">1,923</span></li>
                <li><span class="label">Reinforcements taken</span> <span class="value">1,392</span></li>
            </ul>
        </div>
    </div>
</div>
@endsection

<!--Main Content-->
