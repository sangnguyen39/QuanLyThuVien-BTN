@extends('admin.master')
@section('main-content')
    <div class="main-content">
        <div class="top-bar">
            <h2>Dashboard</h2> 
        </div>
        <hr>

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
                <canvas id="borrowChart" style="width: 100%; height: 400px; border: 1px solid rgb(221, 221, 221);"></canvas>
            </div>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Hiển thị thông báo tải dữ liệu
                    console.log("Đang tải dữ liệu...");

                    fetch('{{route('admin.monthly-loans')}}')
                        .then(response => {
                            if (!response.ok) {
                                // Kiểm tra mã trạng thái HTTP chi tiết hơn
                                if (response.status === 400) {
                                    throw new Error("Yêu cầu không hợp lệ.");
                                } else if (response.status === 500) {
                                    throw new Error("Lỗi máy chủ.");
                                } else {
                                    throw new Error(`Lỗi HTTP! Trạng thái: ${response.status}`);
                                }
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data); // Kiểm tra dữ liệu từ API

                            // Kiểm tra nếu dữ liệu trống hoặc không hợp lệ
                            if (!Array.isArray(data) || data.length === 0) {
                                console.error("Dữ liệu không hợp lệ hoặc trống.");
                                // Hiển thị thông báo cho người dùng chi tiết hơn
                                alert("Không có dữ liệu để hiển thị. Vui lòng kiểm tra lại.");
                                return;
                            }

                            // Tạo mảng nhãn (labels) cho trục X, kết hợp tháng và năm
                            const labels = data.map(item => `${item.month}/${item.year}`);
                            console.log(labels); // Kiểm tra mảng labels
                            // Tạo mảng số lượt mượn (data) cho trục Y
                            const dataCounts = data.map(item => item.total_loans);

                            // Kiểm tra nếu phần tử 'borrowChart' có tồn tại trong DOM
                            const ctx = document.getElementById('borrowChart');
                            if (!ctx) {
                                console.error("Không tìm thấy phần tử borrowChart.");
                                return; // Dừng thực thi nếu không tìm thấy phần tử
                            }

                            // Khởi tạo biểu đồ
                            try {
                                var borrowChart = new Chart(ctx.getContext('2d'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Số lượt mượn',
                                            data: dataCounts,
                                            backgroundColor: 'rgba(54, 162, 235, 0.6)', // Màu xanh dương
                                            borderColor: 'rgba(54, 162, 235, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Số lượt mượn'
                                                }
                                            },
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Tháng/Năm'
                                                },
                                                ticks: {
                                                    autoSkip: true,
                                                    maxRotation: 90,
                                                    minRotation: 45,
                                                    callback: function (value, index, values) {
                                                        // Rút gọn nhãn nếu quá dài
                                                        let label = values[index];
                                                        if (label.length > 30) {
                                                            return label.substring(0, 30) + '...';
                                                        }
                                                        return label;
                                                    }
                                                }
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top'
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function (tooltipItem) {
                                                        return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                                console.log("Biểu đồ đã được tải thành công.");
                            } catch (error) {
                                console.error("Lỗi khi khởi tạo biểu đồ:", error);
                                // Hiển thị thông báo cho người dùng chi tiết hơn
                                alert("Có lỗi xảy ra khi tải biểu đồ. Vui lòng thử lại sau.");
                            }
                        })
                        .catch(error => {
                            console.error("Lỗi khi lấy dữ liệu:", error);
                            // Hiển thị thông báo cho người dùng chi tiết hơn
                            alert("Có lỗi xảy ra khi tải dữ liệu. Vui lòng kiểm tra kết nối mạng và thử lại sau.");
                        });
                });
            </script>
        @endpush

        <div class="data-grid">
            <div class="data-card">
                <h3>Danh sách sinh viên quá hạn ({{ count($overdueMembers) }})</h3>
                @if($overdueMembers->isEmpty())
                    <div class="alert alert-warning">
                        Không có sinh viên nào quá hạn.
                    </div>
                @else
                <div class="table-responsive">
                    <table class="overdue-table">
                        <thead>
                            <tr>
                                <th>Họ và tên</th>
                                <th>Tiêu đề sách</th>
                                <th>Số ngày quá hạn</th>
                                <th>Mã mượn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($overdueMembers as $member)
                                <tr>
                                    <td>{{ $member->full_name }}</td>
                                    <td>{{ $member->book_title }}</td>
                                    <td>{{ $member->days_overdue }}</td>
                                    <td>{{ $member->borrow_id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="data-card">
                <h3>Sách đọc nhiều nhất</h3>
                <div class="table-responsive">
                    <table class="overdue-table">
                        <thead>
                            <tr>
                                <th>Tên sách</th>
                                <th>Tác giả</th>
                                <th>Số lần mượn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($popularBooks as $book)
                                <tr>
                                    <td>{{ $book->book_title }}</td>
                                    <td>{{ $book->nha_xuat_ban }}</td>
                                    <td>{{ $book->borrow_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<!--Main Content-->