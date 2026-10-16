<?php
declare(strict_types=1);

$apiBaseUrl = getenv('BACKEND_API_URL') ?: (getenv('PHARMACY_API_URL') ?: 'http://localhost:8080/api');
$pageTitle = 'Tổng quan';
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f4f7fb">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> | MediCare</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <script>
    window.PHARMACY_API_BASE_URL =
        <?= json_encode($apiBaseUrl, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    </script>
    <script src="assets/js/app.js" defer></script>
</head>

<body>
    <div class="app-shell">
        <aside class="sidebar" id="sidebar">
            <a class="brand" href="#" aria-label="MediCare - Trang chủ">
                <span class="brand-mark">✚</span>
                <span class="brand-copy"><strong>medi<span>care</span></strong><small>PHARMACY SYSTEM</small></span>
            </a>

            <div class="location-switch">
                <span class="location-icon">⌖</span>
                <span><small>CHI NHÁNH</small><strong>Nhà thuốc Trung Tâm</strong></span>
                <span class="chevron">⌄</span>
            </div>

            <nav class="main-nav" aria-label="Điều hướng chính">
                <p class="nav-label">MENU CHÍNH</p>
                <button class="nav-item active" data-view="overview"><span class="nav-icon">▦</span>Tổng quan</button>
                <button class="nav-item" data-view="pos"><span class="nav-icon">▣</span>Bán hàng POS <span
                        class="nav-tag">F2</span></button>
                <button class="nav-item" data-view="inventory"><span class="nav-icon">▤</span>Quản lý kho <span
                        class="nav-count">3</span></button>
                <button class="nav-item" data-view="prescriptions"><span class="nav-icon">▧</span>Đơn thuốc <span
                        class="nav-count blue">5</span></button>

                <p class="nav-label nav-label-spaced">QUẢN LÝ</p>
                <button class="nav-item" data-view="medicines"><span class="nav-icon">⚕</span>Danh mục thuốc</button>
                <button class="nav-item" data-view="orders"><span class="nav-icon">🛍</span>Đơn hàng</button>
                <button class="nav-item" data-view="customers"><span class="nav-icon">♙</span>Khách hàng</button>
                <button class="nav-item" data-view="reports"><span class="nav-icon">▥</span>Báo cáo</button>
            </nav>

            <div class="sidebar-bottom">
                <div class="support-card">
                    <div class="support-icon">?</div>
                    <strong>Cần hỗ trợ?</strong>
                    <span>Đội ngũ MediCare luôn sẵn sàng giúp bạn.</span>
                    <a href="mailto:support@medicare.vn">Liên hệ hỗ trợ <span>↗</span></a>
                </div>
                <button class="profile">
                    <span class="avatar">ML</span>
                    <span class="profile-copy"><strong>Nguyễn Minh Long</strong><small>Dược sĩ · Quản lý</small></span>
                    <span class="profile-menu">•••</span>
                </button>
            </div>
        </aside>

        <main class="main-area">
            <header class="topbar">
                <button class="mobile-menu" id="mobileMenu" aria-label="Mở menu">☰</button>
                <div class="breadcrumbs"><span>Trang chủ</span><span class="crumb-divider">/</span><strong
                        id="breadcrumbCurrent">Tổng quan</strong></div>
                <div class="topbar-actions">
                    <label class="search-box">
                        <span>⌕</span>
                        <input id="globalSearch" type="search" placeholder="Tìm thuốc, mã vạch..." autocomplete="off">
                        <kbd>⌘ K</kbd>
                    </label>
                    <button class="icon-button help-button" aria-label="Trợ giúp">?</button>
                    <button class="icon-button notification-button" aria-label="Thông báo">♧<i></i></button>
                    <span class="topbar-divider"></span>
                    <span class="top-date"><strong>Thứ Hai</strong><small>12 Tháng 10, 2026</small></span>
                </div>
            </header>

            <div class="content">
                <section class="view-panel" id="view-overview">
                    <div class="page-heading">
                        <div>
                            <div class="eyebrow"><span class="live-dot"></span>HỆ THỐNG ĐANG HOẠT ĐỘNG</div>
                            <h1>Chào buổi sáng, anh Long <span class="wave">✦</span></h1>
                            <p>Đây là tình hình hoạt động của nhà thuốc hôm nay.</p>
                        </div>
                        <button class="button button-primary" data-open-view="pos"><span>＋</span> Tạo đơn hàng
                            mới</button>
                    </div>

                    <div class="stats-grid">
                        <article class="stat-card">
                            <div class="stat-top"><span>DOANH THU HÔM NAY</span><span class="stat-icon mint">↗</span>
                            </div>
                            <div class="stat-value">12.850.000 <small>₫</small></div>
                            <div class="stat-foot"><span class="trend positive">↗ 12.8%</span><span>so với hôm
                                    qua</span></div>
                            <div class="sparkline green">
                                <i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
                            </div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-top"><span>ĐƠN HÀNG</span><span class="stat-icon lavender">▣</span></div>
                            <div class="stat-value">48 <small>đơn</small></div>
                            <div class="stat-foot"><span class="trend positive">↗ 8.2%</span><span>so với hôm qua</span>
                            </div>
                            <div class="sparkline purple">
                                <i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
                            </div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-top"><span>SẮP HẾT HÀNG</span><span class="stat-icon amber">▤</span></div>
                            <div class="stat-value">12 <small>sản phẩm</small></div>
                            <div class="stat-foot"><span class="trend warning">Cần nhập thêm</span><span>tồn kho
                                    thấp</span></div>
                            <div class="sparkline orange">
                                <i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
                            </div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-top"><span>ĐƠN THUỐC CHỜ DUYỆT</span><span class="stat-icon rose">▧</span>
                            </div>
                            <div class="stat-value">05 <small>đơn</small></div>
                            <div class="stat-foot"><span class="trend neutral">Cần xử lý</span><span>đơn thuốc điện
                                    tử</span></div>
                            <div class="sparkline red">
                                <i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
                            </div>
                        </article>
                    </div>

                    <div class="dashboard-grid">
                        <section class="panel revenue-panel">
                            <div class="panel-heading">
                                <div>
                                    <h2>Doanh thu bán hàng</h2>
                                    <p>Theo dõi hiệu quả kinh doanh của nhà thuốc</p>
                                </div>
                                <select class="select-control" aria-label="Khoảng thời gian báo cáo">
                                    <option>7 ngày qua</option>
                                    <option>30 ngày qua</option>
                                </select>
                            </div>
                            <div class="chart-legend"><span><i class="legend-dot"></i>Doanh thu</span><strong>₫
                                    68.420.000 <small class="trend positive">↗ 8,4%</small></strong></div>
                            <div class="chart">
                                <div class="chart-y">
                                    <span>₫15tr</span><span>₫10tr</span><span>₫5tr</span><span>₫0</span>
                                </div>
                                <div class="chart-main">
                                    <div class="gridline"></div>
                                    <div class="gridline"></div>
                                    <div class="gridline"></div>
                                    <div class="gridline"></div>
                                    <svg viewBox="0 0 700 185" preserveAspectRatio="none" role="img"
                                        aria-label="Biểu đồ doanh thu 7 ngày">
                                        <defs>
                                            <linearGradient id="chartFill" x1="0" x2="0" y1="0" y2="1">
                                                <stop offset="0%" stop-color="#19a77a" stop-opacity=".18" />
                                                <stop offset="100%" stop-color="#19a77a" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                        <path
                                            d="M0 143 C38 133 48 106 100 119 S162 150 200 100 S266 112 300 83 S365 102 400 66 S465 98 500 55 S565 74 600 37 S662 55 700 16 L700 185 L0 185Z"
                                            fill="url(#chartFill)" />
                                        <path
                                            d="M0 143 C38 133 48 106 100 119 S162 150 200 100 S266 112 300 83 S365 102 400 66 S465 98 500 55 S565 74 600 37 S662 55 700 16"
                                            fill="none" stroke="#18a77a" stroke-width="3"
                                            vector-effect="non-scaling-stroke" />
                                    </svg>
                                    <div class="chart-x"><span>T2, 06</span><span>T3, 07</span><span>T4,
                                            08</span><span>T5, 09</span><span>T6, 10</span><span>T7, 11</span><span>CN,
                                            12</span></div>
                                </div>
                            </div>
                        </section>

                        <section class="panel quick-panel">
                            <div class="panel-heading">
                                <div>
                                    <h2>Thao tác nhanh</h2>
                                    <p>Các chức năng thường dùng</p>
                                </div><span class="more-button">•••</span>
                            </div>
                            <div class="quick-actions">
                                <button class="quick-action" data-open-view="pos"><span
                                        class="quick-icon q-green">▣</span><span><strong>Bán hàng POS</strong><small>Tạo
                                            hóa đơn mới</small></span><b>›</b></button>
                                <button class="quick-action" data-open-view="inventory"><span
                                        class="quick-icon q-blue">＋</span><span><strong>Nhập kho</strong><small>Thêm lô
                                            thuốc mới</small></span><b>›</b></button>
                                <button class="quick-action" data-open-view="prescriptions"><span
                                        class="quick-icon q-violet">▧</span><span><strong>Duyệt đơn
                                            thuốc</strong><small>05 đơn đang chờ</small></span><b>›</b></button>
                                <button class="quick-action" data-open-view="medicines"><span
                                        class="quick-icon q-orange">⌕</span><span><strong>Tra cứu
                                            thuốc</strong><small>Tìm theo tên hoặc mã
                                            vạch</small></span><b>›</b></button>
                            </div>
                        </section>
                    </div>

                    <section class="panel table-panel">
                        <div class="panel-heading table-heading">
                            <div>
                                <h2>Giao dịch gần đây</h2>
                                <p>Các đơn hàng mới nhất tại chi nhánh</p>
                            </div>
                            <button class="text-button" data-open-view="orders">Xem tất cả <span>→</span></button>
                        </div>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>MÃ ĐƠN</th>
                                        <th>KHÁCH HÀNG</th>
                                        <th>SẢN PHẨM</th>
                                        <th>THANH TOÁN</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THỜI GIAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="order-id">#DH-2026-0848</td>
                                        <td><span class="customer-cell"><i class="customer-avatar ca-green">TH</i>Trần
                                                Thu Hà</span></td>
                                        <td>Paracetamol 500mg <small>+ 2 sản phẩm</small></td>
                                        <td class="money-cell">245.000 ₫</td>
                                        <td><span class="status-pill status-success"><i></i>Hoàn thành</span></td>
                                        <td class="muted">10:42 AM</td>
                                    </tr>
                                    <tr>
                                        <td class="order-id">#DH-2026-0847</td>
                                        <td><span class="customer-cell"><i class="customer-avatar ca-blue">NM</i>Nguyễn
                                                Minh</span></td>
                                        <td>Vitamin C 1000mg <small>+ 1 sản phẩm</small></td>
                                        <td class="money-cell">186.000 ₫</td>
                                        <td><span class="status-pill status-pending"><i></i>Chờ thanh toán</span></td>
                                        <td class="muted">10:28 AM</td>
                                    </tr>
                                    <tr>
                                        <td class="order-id">#DH-2026-0846</td>
                                        <td><span class="customer-cell"><i class="customer-avatar ca-peach">PL</i>Phạm
                                                Lan Anh</span></td>
                                        <td>Amoxicillin 500mg <small>+ 3 sản phẩm</small></td>
                                        <td class="money-cell">372.000 ₫</td>
                                        <td><span class="status-pill status-success"><i></i>Hoàn thành</span></td>
                                        <td class="muted">09:56 AM</td>
                                    </tr>
                                    <tr>
                                        <td class="order-id">#DH-2026-0845</td>
                                        <td><span class="customer-cell"><i class="customer-avatar ca-violet">ĐQ</i>Đỗ
                                                Quốc Bảo</span></td>
                                        <td>Nước muối sinh lý <small>+ 1 sản phẩm</small></td>
                                        <td class="money-cell">98.000 ₫</td>
                                        <td><span class="status-pill status-success"><i></i>Hoàn thành</span></td>
                                        <td class="muted">09:31 AM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <footer class="page-footer"><span>© 2026 MediCare Pharmacy Management</span><span>Phiên bản 1.0.0 <i
                                class="footer-dot"></i> Dữ liệu được cập nhật trực tiếp</span></footer>
                </section>

                <section class="view-panel hidden" id="view-inventory">
                    <div class="page-heading">
                        <div>
                            <div class="eyebrow"><span class="live-dot"></span>QUẢN LÝ HÀNG HÓA</div>
                            <h1>Quản lý kho</h1>
                            <p>Theo dõi tồn kho và ưu tiên xuất lô gần hết hạn theo FEFO.</p>
                        </div>
                        <button class="button button-primary" id="addStockButton"><span>＋</span> Nhập kho</button>
                    </div>
                    <div class="stats-grid inventory-stats">
                        <article class="stat-card">
                            <div class="stat-top"><span>TỔNG MẶT HÀNG</span><span class="stat-icon mint">▤</span></div>
                            <div class="stat-value">1.284 <small>sản phẩm</small></div>
                            <div class="stat-foot"><span>Danh mục đang kinh doanh</span></div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-top"><span>SẮP HẾT HÀNG</span><span class="stat-icon amber">!</span></div>
                            <div class="stat-value">12 <small>sản phẩm</small></div>
                            <div class="stat-foot"><span class="trend warning">Tồn dưới định mức</span></div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-top"><span>SẮP HẾT HẠN</span><span class="stat-icon rose">◷</span></div>
                            <div class="stat-value">03 <small>lô thuốc</small></div>
                            <div class="stat-foot"><span class="trend warning">Trong vòng 90 ngày</span></div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-top"><span>GIÁ TRỊ TỒN KHO</span><span class="stat-icon lavender">₫</span>
                            </div>
                            <div class="stat-value">284.5 <small>triệu ₫</small></div>
                            <div class="stat-foot"><span>Giá trị theo giá nhập</span></div>
                        </article>
                    </div>
                    <section class="panel table-panel inventory-table-panel">
                        <div class="panel-heading inventory-toolbar">
                            <div>
                                <h2>Tồn kho theo lô</h2>
                                <p>Lô ưu tiên FEFO được hiển thị trước trong từng sản phẩm</p>
                            </div>
                            <div class="toolbar-controls"><label class="table-search">⌕ <input id="inventorySearch"
                                        type="search" placeholder="Tìm thuốc, mã lô..."></label><select
                                    class="select-control">
                                    <option>Tất cả trạng thái</option>
                                    <option>Sắp hết hạn</option>
                                    <option>Sắp hết hàng</option>
                                </select></div>
                        </div>
                        <div class="fefo-note"><span>↗</span><span><strong>Nguyên tắc FEFO đang bật</strong> — Ưu tiên
                                xuất lô có hạn sử dụng gần nhất để giảm hủy hàng.</span></div>
                        <div class="table-wrap">
                            <table id="inventoryTable">
                                <thead>
                                    <tr>
                                        <th>TÊN THUỐC</th>
                                        <th>MÃ LÔ</th>
                                        <th>HẠN SỬ DỤNG</th>
                                        <th>TỒN KHO</th>
                                        <th>VỊ TRÍ</th>
                                        <th>TRẠNG THÁI</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-search="paracetamol 500mg par-2406-a">
                                        <td><span class="medicine-cell"><i
                                                    class="medicine-icon med-tablet">✚</i><span><strong>Paracetamol
                                                        500mg</strong><small>Viên nén · DHG Pharma</small></span></span>
                                        </td>
                                        <td class="order-id">PAR-2406-A</td>
                                        <td><strong class="expiry-near">15/11/2026</strong><small class="sub-cell">Còn
                                                34 ngày</small></td>
                                        <td><strong>84</strong> viên</td>
                                        <td class="muted">Kệ A-02</td>
                                        <td><span class="status-pill status-expiry"><i></i>Sắp hết hạn</span></td>
                                        <td><button class="row-menu" aria-label="Thao tác">•••</button></td>
                                    </tr>
                                    <tr data-search="amoxicillin 500mg amx-2408-b">
                                        <td><span class="medicine-cell"><i
                                                    class="medicine-icon med-capsule">✚</i><span><strong>Amoxicillin
                                                        500mg</strong><small>Viên nang · Imexpharm</small></span></span>
                                        </td>
                                        <td class="order-id">AMX-2408-B</td>
                                        <td><strong>02/03/2027</strong><small class="sub-cell">Còn 142 ngày</small></td>
                                        <td><strong>240</strong> viên</td>
                                        <td class="muted">Kệ B-01</td>
                                        <td><span class="status-pill status-success"><i></i>Còn hàng</span></td>
                                        <td><button class="row-menu" aria-label="Thao tác">•••</button></td>
                                    </tr>
                                    <tr data-search="vitamin c 1000mg vit-2501-c">
                                        <td><span class="medicine-cell"><i
                                                    class="medicine-icon med-orange">✚</i><span><strong>Vitamin C
                                                        1000mg</strong><small>Viên sủi · Bayer</small></span></span>
                                        </td>
                                        <td class="order-id">VIT-2501-C</td>
                                        <td><strong>19/07/2027</strong><small class="sub-cell">Còn 281 ngày</small></td>
                                        <td><strong class="low-stock">8</strong> hộp</td>
                                        <td class="muted">Kệ C-04</td>
                                        <td><span class="status-pill status-low"><i></i>Sắp hết hàng</span></td>
                                        <td><button class="row-menu" aria-label="Thao tác">•••</button></td>
                                    </tr>
                                    <tr data-search="omeprazole 20mg OME-2502-A">
                                        <td><span class="medicine-cell"><i
                                                    class="medicine-icon med-blue">✚</i><span><strong>Omeprazole
                                                        20mg</strong><small>Viên nang · Stada</small></span></span></td>
                                        <td class="order-id">OME-2502-A</td>
                                        <td><strong>28/08/2027</strong><small class="sub-cell">Còn 321 ngày</small></td>
                                        <td><strong>156</strong> viên</td>
                                        <td class="muted">Kệ A-06</td>
                                        <td><span class="status-pill status-success"><i></i>Còn hàng</span></td>
                                        <td><button class="row-menu" aria-label="Thao tác">•••</button></td>
                                    </tr>
                                    <tr data-search="nuoc muoi sinh ly nso-2504-a">
                                        <td><span class="medicine-cell"><i
                                                    class="medicine-icon med-tablet">＋</i><span><strong>Nước muối sinh
                                                        lý 0.9%</strong><small>Dung dịch ·
                                                        Pharmedic</small></span></span></td>
                                        <td class="order-id">NSO-2504-A</td>
                                        <td><strong>12/12/2027</strong><small class="sub-cell">Còn 427 ngày</small></td>
                                        <td><strong>320</strong> chai</td>
                                        <td class="muted">Kệ D-02</td>
                                        <td><span class="status-pill status-success"><i></i>Còn hàng</span></td>
                                        <td><button class="row-menu" aria-label="Thao tác">•••</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-pagination"><span>Hiển thị <strong>1–5</strong> trong <strong>1.284</strong>
                                sản phẩm</span>
                            <div><button disabled>←</button><button
                                    class="current-page">1</button><button>2</button><button>3</button><span>…</span><button>→</button>
                            </div>
                        </div>
                    </section>
                </section>

                <section class="view-panel hidden" id="view-pos">
                    <div class="page-heading">
                        <div>
                            <div class="eyebrow"><span class="live-dot"></span>ĐIỂM BÁN HÀNG</div>
                            <h1>Bán hàng POS</h1>
                            <p>Quét mã vạch hoặc tìm thuốc để thêm vào đơn hàng.</p>
                        </div><span class="pos-status"><i></i>Quầy số 01 · Đang hoạt động</span>
                    </div>
                    <div class="pos-layout">
                        <section class="panel pos-products">
                            <label class="barcode-search"><span>▦</span><input id="barcodeSearch" type="search"
                                    placeholder="Quét mã vạch hoặc nhập tên thuốc..." autofocus><kbd>F3</kbd></label>
                            <div class="product-section-heading">
                                <div>
                                    <h2>Sản phẩm phổ biến</h2>
                                    <p>Chọn sản phẩm để thêm vào đơn</p>
                                </div><button class="text-button" data-open-view="medicines">Tất cả thuốc →</button>
                            </div>
                            <div class="product-grid" id="productGrid">
                                <button class="product-card" data-id="1" data-name="Paracetamol 500mg"
                                    data-price="2500"><span class="product-art art-green">✚</span><span
                                        class="product-name">Paracetamol 500mg</span><small>Vỉ 10 viên · Còn
                                        84</small><strong>2.500 ₫</strong></button>
                                <button class="product-card" data-id="2" data-name="Vitamin C 1000mg"
                                    data-price="45000"><span class="product-art art-orange">✚</span><span
                                        class="product-name">Vitamin C 1000mg</span><small>Hộp 20 viên · Còn
                                        8</small><strong>45.000 ₫</strong></button>
                                <button class="product-card" data-id="3" data-name="Omeprazole 20mg"
                                    data-price="3200"><span class="product-art art-blue">✚</span><span
                                        class="product-name">Omeprazole 20mg</span><small>Viên nang · Còn
                                        156</small><strong>3.200 ₫</strong></button>
                                <button class="product-card" data-id="4" data-name="Nước muối sinh lý 0.9%"
                                    data-price="12000"><span class="product-art art-violet">＋</span><span
                                        class="product-name">Nước muối sinh lý</span><small>Chai 500ml · Còn
                                        320</small><strong>12.000 ₫</strong></button>
                                <button class="product-card" data-id="5" data-name="Amoxicillin 500mg"
                                    data-price="1800"><span class="product-art art-pink">✚</span><span
                                        class="product-name">Amoxicillin 500mg</span><small>Viên nang · Còn
                                        240</small><strong>1.800 ₫</strong><span class="prescription-label">Cần đơn
                                        thuốc</span></button>
                                <button class="product-card" data-id="6" data-name="Oresol" data-price="5000"><span
                                        class="product-art art-yellow">＋</span><span
                                        class="product-name">Oresol</span><small>Gói · Còn 92</small><strong>5.000
                                        ₫</strong></button>
                            </div>
                        </section>
                        <section class="panel cart-panel">
                            <div class="cart-heading">
                                <div>
                                    <h2>Đơn hàng mới</h2>
                                    <p>Mã đơn: <strong>#POS-TẠM</strong></p>
                                </div><button class="clear-cart" id="clearCart">Xóa đơn</button>
                            </div>
                            <label class="customer-input"><span>♙</span><input id="customerName" type="text"
                                    placeholder="Tên hoặc số điện thoại khách hàng"></label>
                            <div class="cart-items" id="cartItems">
                                <div class="empty-cart"><span>🛒</span><strong>Chưa có sản phẩm</strong><small>Chọn
                                        thuốc để thêm vào đơn hàng</small></div>
                            </div>
                            <div class="cart-summary">
                                <div><span>Tạm tính</span><strong id="subtotal">0 ₫</strong></div>
                                <div><span>Giảm giá</span><button class="discount-button" id="discountButton">＋ Thêm
                                        giảm giá</button></div>
                                <div class="summary-total"><span>Tổng thanh toán</span><strong id="total">0 ₫</strong>
                                </div>
                            </div>
                            <div class="payment-method"><span>Phương thức thanh toán</span>
                                <div><button class="payment-option selected" data-payment="CASH"><span>₫</span>Tiền
                                        mặt</button><button class="payment-option"
                                        data-payment="BANK_TRANSFER"><span>▤</span>Chuyển khoản</button></div>
                            </div>
                            <button class="button button-primary checkout-button" id="checkoutButton"
                                disabled><span>✓</span> Thanh toán <strong id="checkoutTotal">0 ₫</strong></button>
                            <p class="pos-disclaimer">Thuốc kê đơn chỉ được bán sau khi dược sĩ kiểm tra đơn thuốc hợp
                                lệ.</p>
                        </section>
                    </div>
                </section>

                <section class="view-panel hidden" id="view-prescriptions">
                    <div class="page-heading">
                        <div>
                            <div class="eyebrow"><span class="live-dot"></span>DƯỢC SĨ THẨM ĐỊNH</div>
                            <h1>Đơn thuốc điện tử</h1>
                            <p>Tiếp nhận và thẩm định đơn thuốc do khách hàng gửi lên.</p>
                        </div><button class="button button-secondary">Lịch sử thẩm định</button>
                    </div>
                    <section class="panel table-panel">
                        <div class="panel-heading">
                            <div>
                                <h2>Đơn chờ xử lý</h2>
                                <p>05 đơn thuốc đang chờ dược sĩ thẩm định</p>
                            </div><select class="select-control">
                                <option>Tất cả trạng thái</option>
                                <option>Chờ duyệt</option>
                                <option>Đã duyệt</option>
                            </select>
                        </div>
                        <div class="prescription-list">
                            <article class="prescription-card">
                                <div class="prescription-file">▧</div>
                                <div class="prescription-info"><strong>Đơn thuốc · Nguyễn Thị Mai</strong><span>Gửi lúc
                                        10:32 · Mã đơn #DT-10285</span><small>3 loại thuốc · Đính kèm 1 ảnh đơn
                                        thuốc</small></div><span class="status-pill status-pending"><i></i>Chờ thẩm
                                    định</span><button class="button button-small button-primary review-button">Xem đơn
                                    thuốc</button>
                            </article>
                            <article class="prescription-card">
                                <div class="prescription-file">▧</div>
                                <div class="prescription-info"><strong>Đơn thuốc · Trần Văn Nam</strong><span>Gửi lúc
                                        09:48 · Mã đơn #DT-10284</span><small>2 loại thuốc · Đính kèm 2 ảnh đơn
                                        thuốc</small></div><span class="status-pill status-pending"><i></i>Chờ thẩm
                                    định</span><button class="button button-small button-primary review-button">Xem đơn
                                    thuốc</button>
                            </article>
                            <article class="prescription-card">
                                <div class="prescription-file">▧</div>
                                <div class="prescription-info"><strong>Đơn thuốc · Lê Thu Hương</strong><span>Gửi lúc
                                        09:15 · Mã đơn #DT-10283</span><small>4 loại thuốc · Đính kèm 1 ảnh đơn
                                        thuốc</small></div><span class="status-pill status-pending"><i></i>Chờ thẩm
                                    định</span><button class="button button-small button-primary review-button">Xem đơn
                                    thuốc</button>
                            </article>
                        </div>
                    </section>
                </section>

                <section class="view-panel hidden" id="view-generic">
                    <div class="page-heading">
                        <div>
                            <div class="eyebrow"><span class="live-dot"></span>MEDICARE PHARMACY</div>
                            <h1 id="genericTitle">Danh mục</h1>
                            <p>Tính năng đang được kết nối với hệ thống quản lý nhà thuốc.</p>
                        </div>
                    </div>
                    <section class="panel placeholder-panel"><span>✚</span>
                        <h2 id="genericHeading">Đang chuẩn bị</h2>
                        <p>Giao diện này sẽ hiển thị dữ liệu thực khi kết nối Spring Boot API.</p><button
                            class="button button-primary" data-open-view="overview">Quay lại tổng quan</button>
                    </section>
                </section>
            </div>
        </main>
    </div>

    <div class="toast" id="toast" role="status" aria-live="polite"></div>
    <div class="modal-backdrop hidden" id="stockModal" role="dialog" aria-modal="true"
        aria-labelledby="stockModalTitle">
        <form class="modal-card" id="stockForm">
            <div class="modal-heading">
                <div><span class="eyebrow">QUẢN LÝ KHO</span>
                    <h2 id="stockModalTitle">Ghi nhận nhập kho</h2>
                </div><button type="button" class="modal-close" data-close-modal aria-label="Đóng">×</button>
            </div>
            <label>Mã thuốc<input name="medicineId" type="number" min="1" required placeholder="Nhập ID thuốc từ hệ thống"></label>
            <div class="modal-fields"><label>Mã lô<input name="batch" required
                        placeholder="Ví dụ: PAR-2609-A"></label><label>Số lượng<input name="quantity" type="number"
                        min="1" required placeholder="0"></label></div>
            <div class="modal-fields"><label>Hạn sử dụng<input name="expiry" type="date" required></label><label>Vị trí
                    kệ<input name="location" placeholder="Ví dụ: A-02"></label></div>
            <div class="modal-actions"><button type="button" class="button button-secondary"
                    data-close-modal>Hủy</button><button type="submit" class="button button-primary">Lưu phiếu
                    nhập</button></div>
        </form>
    </div>
</body>

</html>