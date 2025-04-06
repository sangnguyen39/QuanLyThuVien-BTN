
@extends("admin.master")

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
            <div class="value">12,501</div>
        </div>
        <div class="kpi-card">
            <h3>Đã cho mượn</h3>
            <div class="icon"><span class="icon-placeholder"></span></div>
            <div class="value">1,501</div>
        </div>
        <div class="kpi-card">
            <h3>Thể loại sách</h3>
            <div class="icon"><span class="icon-placeholder"></span></div>
            <div class="value">1,302</div>
            <div
                style="width: 80px; height: 80px; border: 2px solid #ccc; border-radius: 50%; margin: 10px auto; position: relative;">
                <div
                    style="width: 80px; height: 80px; border-radius: 50%; border-left: 2px solid #007bff; position: absolute; clip: rect(0px, 80px, 80px, 40px);">
                </div>
                <div
                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 0.8em; color: #555;">
                    60%</div>
            </div>
        </div>
        <div class="kpi-card">
            <h3>Sách hiện có</h3>
            <div class="icon"><span class="icon-placeholder"></span></div>
            <div class="value">11,000</div>
        </div>
        <div class="kpi-card">
            <h3>Số bạn đọc trễ hạn</h3>
            <div class="icon"><span class="icon-placeholder"></span></div>
            <div class="value">151</div>
        </div>
    </div>

    <div class="filter-bar">
        <label for="time-filter">Thời gian:</label>
        <select id="time-filter">
            <option>All-time</option>
            <option>Last Month</option>
            <option>This Year</option>
        </select>

        <label for="keyword-filter">Lọc theo Khoa:</label>
        <select id="keyword-filter">
            <option>All</option>
            <option>Khoa học Tự nhiên</option>
            <option>Khoa học Xã hội</option>
        </select>

        <label for="type-filter">Lọc theo Lớp:</label>
        <select id="type-filter">
            <option>All</option>
            <option>Lớp 10</option>
            <option>Lớp 11</option>
            <option>Lớp 12</option>
        </select>

        <label for="category-filter">Lọc theo loại sách:</label>
        <select id="category-filter">
            <option>All</option>
            <option>Văn học</option>
            <option>Khoa học</option>
        </select>
    </div>

    <div class="chart-section">
        <div class="chart-card">
            <h3>Số lượng mượn sách theo tháng</h3>
            <div style="height: 200px; border: 1px solid #ddd;">
            </div>
        </div>
        <div class="chart-card">
            <h3>Số lượng mượn sách qua thời gian</h3>
            <div style="height: 200px; border: 1px solid #ddd;">
            </div>
        </div>
    </div>

    <div class="data-grid">
        <div class="data-card">
            <h3>Danh sách sinh viên quá hạn</h3>
            <ul class="data-list">
                <li><span class="label">Google Ads</span> <span class="value">139</span></li>
                <li><span class="label">Facebook Ads</span> <span class="value">283</span></li>
                <li><span class="label">Influencers</span> <span class="value">782</span></li>
                <li><span class="label">Website</span> <span class="value">1,923</span></li>
                <li><span class="label">Android APP</span> <span class="value">103</span></li>
            </ul>
        </div>
        <div class="data-card">
            <h3>Sách được ưu thích nhất</h3>
            <ul class="data-list">
                <li><span class="label">People Added</span> <span class="value">139</span></li>
                <li><span class="label">Product Created</span> <span class="value">283</span></li>
                <li><span class="label">UTM Created</span> <span class="value">782</span></li>
                <li><span class="label">Email Send Created</span> <span class="value">1,923</span></li>
                <li><span class="label">Content added</span> <span class="value">103</span></li>
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

