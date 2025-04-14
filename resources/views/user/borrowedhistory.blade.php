{{-- resources/views/account/borrow-history.blade.php --}}
<x-app-layout>
    
    <x-account-panel>
        <div class="history-header">
            <h2>LỊCH SỬ MƯỢN SÁCH</h2>
        </div>
        
        <div class="history-container">
        <table class="table">
    <thead>
        <tr>
            <th>Tiêu đề sách</th>
            <th>Ngày mượn</th>
            <th>Hạn trả</th>
            <th>Ngày trả</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->tieu_de }}</td>
                <td>{{ $item->ngay_muon }}</td>
                <td>{{ $item->han_tra }}</td>
                <td>{{ $item->ngay_tra ?? 'Chưa trả' }}</td>
                <td>
                    @switch($item->trang_thai)
                        @case('borrowed')
                            <span class="badge bg-warning">Đang mượn</span>
                            @break
                        @case('returned')
                            <span class="badge bg-success">Đã trả</span>
                            @break
                        @case('overdue')
                            <span class="badge bg-danger">Quá hạn</span>
                            @break
                        @default
                            <span class="badge bg-secondary">Không rõ</span>
                    @endswitch
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
        </div>

        <style>
            .history-header {
                text-align: center;
                margin-bottom: 2rem;
                border-bottom: 2px solid #3b82f6;
                padding-bottom: 1rem;
            }
            
            .history-header h2 {
                color: #1e40af;
                font-weight: 700;
                font-size: 1.75rem;
                margin: 0;
            }
            
            .history-container {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                padding: 1rem;
                margin-bottom: 2rem;
            }
            
            #borrow-history-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }
            
            #borrow-history-table th {
                background-color: #f8fafc;
                color: #334155;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.875rem;
                letter-spacing: 0.025em;
                padding: 0.75rem 1rem;
                border-bottom: 2px solid #e2e8f0;
            }
            
            #borrow-history-table td {
                padding: 1rem;
                border-bottom: 1px solid #f1f5f9;
                vertical-align: middle;
            }
            
            #borrow-history-table tr:hover {
                background-color: #f8fafc;
            }
            
            .book-title {
                font-weight: 600;
                color: #1e3a8a;
            }
            
            .status-badge {
                display: inline-block;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.025em;
            }
            
            .status-borrowed {
                background-color: #fef3c7;
                color: #92400e;
            }
            
            .status-returned {
                background-color: #dcfce7;
                color: #166534;
            }
            
            .status-overdue {
                background-color: #fee2e2;
                color: #b91c1c;
            }
            
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                margin-bottom: 1rem;
                color: #475569;
            }
            
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.375rem 0.75rem;
                margin-left: 0.25rem;
                border-radius: 0.375rem;
                background-color: #f8fafc;
                border: 1px solid #e2e8f0;
                color: #475569 !important;
            }
            
            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                background-color: #3b82f6 !important;
                color: white !important;
                border-color: #3b82f6;
            }
            
            .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
                background-color: #e2e8f0 !important;
                border-color: #cbd5e1;
                color: #1e40af !important;
            }
        </style>

        @push('scripts')
        <script>
            $(document).ready(function() {
                $('#borrow-history-table').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json"
                    },
                    "pageLength": 10,
                    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tất cả"]],
                    "order": [[1, 'desc']], // Sắp xếp theo ngày mượn mới nhất
                    "responsive": true,
                    "autoWidth": false
                });
            });
        </script>
        @endpush
    </x-account-panel>
</x-app-layout>