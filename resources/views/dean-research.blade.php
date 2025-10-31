<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Repository - CED's Academic Resources Management</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        :root {
            --primary-blue: #001f5b;
            --secondary-blue: #0056b3;
            --accent-blue: #4a90e2;
            --success-green: #28a745;
            --warning-yellow: #ffc107;
            --danger-red: #dc3545;
            --light-gray: #f8f9fa;
            --dark-gray: #6c757d;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #333;
        }

        /* ===== NAVIGATION ===== */
        .navbar {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            box-shadow: var(--shadow);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo { display: flex; align-items: center; font-weight: 700; font-size: 1.2rem; }
        .logo img { height: 50px; width: 50px; border-radius: 8px; margin-right: 12px; }

        .nav-links { display: flex; gap: 1.5rem; align-items: center; }

        .nav-links a {
            color: white; text-decoration: none; font-weight: 500;
            padding: 8px 16px; border-radius: 8px; transition: var(--transition); position: relative;
        }
        .nav-links a:hover { background: rgba(255, 255, 255, 0.2); transform: translateY(-2px); }
        .nav-links a.active { background: rgba(255, 255, 255, 0.3); }

        .navbar-toggler {
            border: none; color: white; font-size: 1.5rem; padding: 8px; border-radius: 8px; transition: var(--transition);
        }
        .navbar-toggler:hover { background: rgba(255, 255, 255, 0.2); }

        .profile-img {
            width: 35px; height: 35px; border-radius: 50%; object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.3); transition: var(--transition);
        }
        .profile-img:hover { border-color: rgba(255, 255, 255, 0.7); transform: scale(1.1); }

        .profile-section-nav {
            display: flex; flex-direction: column; align-items: center; gap: 4px;
            padding: 4px 12px; border-radius: 8px; transition: var(--transition); text-decoration: none;
        }
        .profile-section-nav:hover { background: rgba(255,255,255,0.2); }
        .profile-name-nav {
            color: white; font-size: 0.75rem; font-weight: 500; white-space: nowrap; max-width: 120px;
            overflow: hidden; text-overflow: ellipsis; text-align: center; line-height: 1.1;
        }

        /* ===== MOBILE SIDEBAR ===== */
        .mobile-sidebar {
            height: 100vh; height: 100dvh;
            width: 0; position: fixed; top: 0; left: 0;
            background: linear-gradient(180deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            overflow-x: hidden; overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            overscroll-behavior: contain;
            touch-action: pan-y;
            transition: var(--transition); z-index: 1050; padding-top: 60px;
            padding-bottom: calc(24px + env(safe-area-inset-bottom));
        }
        .mobile-sidebar a {
            display: block; color: white; padding: 15px 20px; text-decoration: none; font-weight: 500;
            margin: 5px 15px; border-radius: 8px; transition: var(--transition);
        }
        .mobile-sidebar a:hover,
        .mobile-sidebar a.active { background: rgba(255, 255, 255, 0.2); transform: translateX(5px); }
        .mobile-sidebar .closebtn {
            position: absolute; top: 15px; right: 25px; font-size: 30px; cursor: pointer; color: white; transition: var(--transition);
        }
        .mobile-sidebar .closebtn:hover { color: var(--warning-yellow); }

        .mobile-sidebar .profile-section {
            text-align: center; margin: 20px 0; padding: 0 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2); padding-bottom: 20px;
        }
        .mobile-sidebar .profile-section img {
            width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }
        .mobile-sidebar .role-badge {
            background: rgba(255, 255, 255, 0.2); color: white; padding: 6px 16px; border-radius: 20px;
            font-size: 0.85rem; font-weight: 600; display: inline-block; margin-top: 5px;
        }
        .mobile-sidebar .logout-section { width: 100%; padding: 15px; margin-top: 2rem; }
        .mobile-sidebar .logout-btn {
            width: 100%; background: var(--danger-red); color: white; border: none; padding: 12px; border-radius: 8px;
            font-weight: 500; transition: var(--transition);
        }
        .mobile-sidebar .logout-btn:hover { background: #c82333; transform: translateY(-2px); }

        @media (max-width: 991px) {
            .mobile-sidebar.open { width: min(280px, 85vw); }
        }
        @media (max-width: 480px) {
            .mobile-sidebar.open { width: min(260px, 90vw); }
        }

        /* ===== LOGOUT MODAL ===== */
        .modal-overlay {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(4px); z-index: 2000;
            align-items: center; justify-content: center; animation: fadeIn 0.3s ease;
        }
        .modal-overlay.active { display: flex; }
        .logout-modal {
            background: white; border-radius: var(--border-radius); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            max-width: 450px; width: 90%; overflow: hidden; animation: slideIn 0.3s ease; position: relative;
        }
        .modal-headers {
            background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%);
            color: white; padding: 1.5rem 2rem; display: flex; align-items: center; gap: 1rem;
        }
        .modal-headers i { font-size: 2rem; }
        .modal-headers-content h3 { margin: 0; font-size: 1.3rem; font-weight: 600; }
        .modal-headers-content p { margin: 0.25rem 0 0 0; font-size: 0.9rem; opacity: 0.9; }
        .logout-modal .modal-body { padding: 2rem; text-align: center; }
        .logout-modal .modal-body p { font-size: 1.1rem; color: var(--dark-gray); margin: 0 0 1.5rem 0; line-height: 1.6; }
        .modal-actions { display: flex; gap: 1rem; justify-content: center; }

        .modal-btn {
            padding: 12px 24px; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem;
            cursor: pointer; transition: var(--transition); display: inline-flex; align-items: center; gap: 0.5rem;
        }
        .modal-btn-cancel { background: var(--light-gray); color: var(--dark-gray); }
        .modal-btn-cancel:hover { background: #e2e6ea; transform: translateY(-2px); }
        .modal-btn-confirm { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; }
        .modal-btn-confirm:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4); }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideIn { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* ===== MAIN CONTENT ===== */
        .main-container { padding: 2rem 0; }

        .page-header { text-align: center; margin-bottom: 2rem; padding: 0 1rem; }
        .page-title {
            font-size: 2.5rem; font-weight: 700; color: var(--primary-blue);
            margin-bottom: 0.5rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .page-subtitle { font-size: 1.1rem; color: var(--dark-gray); font-weight: 400; }

        /* ===== INFO BANNER ===== */
        .info-banner {
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.1) 0%, rgba(0, 86, 179, 0.05) 100%);
            border-left: 4px solid var(--accent-blue);
            padding: 1.25rem 1.5rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        .info-banner i {
            font-size: 1.8rem;
            color: var(--accent-blue);
        }
        .info-banner-content h4 {
            color: var(--primary-blue);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        .info-banner-content p {
            color: var(--dark-gray);
            margin: 0;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* ===== ACTION BAR ===== */
        .action-bar {
            background: white; border-radius: var(--border-radius); box-shadow: var(--shadow);
            padding: 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between;
            align-items: center; flex-wrap: wrap; gap: 1rem;
        }
        .toggle-buttons { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
        .toggle-btn {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white; border: none; padding: 12px 24px; border-radius: 25px; font-size: 1rem; font-weight: 600;
            cursor: pointer; transition: var(--transition); display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--shadow);
        }
        .toggle-btn.active { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); }
        .toggle-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 31, 91, 0.3); }

        .search-form { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
        .search-input {
            padding: 12px 20px; border: 2px solid var(--primary-blue); border-radius: 25px; width: 350px;
            font-size: 1rem; transition: var(--transition); outline: none;
        }
        .search-input:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1); }
        .search-btn {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: var(--transition);
        }
        .search-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }
        .clear-btn {
            background: var(--dark-gray); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: var(--transition);
        }
        .clear-btn:hover { background: #5a6268; transform: translateY(-2px); }

        /* ===== TABLE CONTAINER ===== */
        .table-container {
            background: white; border-radius: var(--border-radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 2rem;
        }
        .table-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white; padding: 1rem 1.5rem; text-align: center;
        }
        .table-header h3 {
            margin: 0; font-size: 1.3rem; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        }

        .data-table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        .data-table thead th { white-space: nowrap; vertical-align: middle; }
        .data-table thead th i { margin-right: 0.4rem; vertical-align: middle; }
        .data-table th,
        .data-table td { padding: 15px 12px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.1); }
        .data-table th { font-weight: 600; color: var(--primary-blue); letter-spacing: 0.3px; font-size: 0.85rem; }
        .data-table tbody tr { transition: var(--transition); }
        .data-table tbody tr:hover { background: rgba(0, 31, 91, 0.03); }

        .abstract-preview {
            width: 200px;
            cursor: pointer;
            color: var(--primary-blue);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
            background: var(--light-gray);
            transition: var(--transition);
            display: inline-block;
            border: 1px solid transparent;
            overflow-wrap: anywhere;
            word-break: break-word;
            white-space: normal;
        }
        .abstract-preview:hover {
            background: rgba(74, 144, 226, 0.1);
            border-color: var(--accent-blue);
            color: var(--primary-blue);
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(74, 144, 226, 0.2);
        }
        .read-more-text { font-size: 0.8rem; color: var(--accent-blue); font-weight: 500; margin-top: 4px; display: block; }

        .status-badge {
            display: inline-flex; align-items: center; gap: 0.3rem; padding: 6px 12px; border-radius: 20px;
            font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .status-badge.approved { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color: white; }
        .status-badge.pending { background: linear-gradient(135deg, var(--warning-yellow) 0%, #ffb800 100%); color: #856404; }
        .status-badge.returned { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; }

        .action-links { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
        .action-btn {
            padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 500;
            transition: var(--transition); border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.3rem;
        }
        .action-btn.view { background: var(--accent-blue); color: white; }
        .action-btn.download { background: var(--success-green); color: white; }
        .action-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }

        .comment-display-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid var(--accent-blue);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            min-width: 300px;
            max-width: 500px;
        }
        .comment-header {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--light-gray);
        }
        .comment-header i { color: var(--accent-blue); font-size: 1rem; }
        .comment-text { font-size: 0.9rem; line-height: 1.6; color: var(--dark-gray); word-wrap: break-word; white-space: pre-wrap; }
        .no-comment-text { font-style: italic; color: var(--dark-gray); opacity: 0.6; font-size: 0.85rem; text-align: center; padding: 10px 0; }

        .custom-modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px); z-index: 1060; justify-content: center; align-items: center; padding: 1rem; overflow-y: auto;
        }
        .modal-content { background: white; border-radius: var(--border-radius); box-shadow: 0 20px 60px rgba(0,0,0,0.3); width: 100%; max-width: 600px; max-height: 90vh; overflow: hidden; animation: modalSlideIn 0.3s ease-out; position: relative; }
        .modal-content.large { max-width: 800px; }
        @keyframes modalSlideIn { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-header { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; padding: 1.5rem 2rem; border-bottom: none; position: relative; }
        .modal-title { font-size: 1.4rem; font-weight: 600; margin: 0; display: flex; align-items: center; gap: 0.5rem; }
        .close-modal {
            position: absolute; top: 15px; right: 20px; background: none; border: none; color: white; font-size: 24px; cursor: pointer; transition: var(--transition);
            width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 50%;
        }
        .close-modal:hover { background: rgba(255, 255, 255, 0.2); transform: rotate(90deg); }
        .modal-body { padding: 2rem; max-height: 60vh; overflow-y: auto; }

        .abstract-modal-content { line-height: 1.6; font-size: 1rem; color: #333; text-align: justify; }
        .abstract-info {
            background: var(--light-gray); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border-left: 4px solid var(--accent-blue);
        }
        .abstract-info h5 { color: var(--primary-blue); margin-bottom: 0.5rem; font-weight: 600; }
        .abstract-info p { margin: 0.25rem 0; color: var(--dark-gray); }

        .modal-footer {
            padding: 1.5rem 2rem; background: var(--light-gray); border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex; justify-content: flex-end; gap: 1rem;
        }
        .modal-btn.secondary { background: var(--dark-gray); color: white; }
        .modal-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }

        .empty-state { text-align: center; padding: 3rem 2rem; color: var(--dark-gray); }
        .empty-state i { font-size: 4rem; color: var(--primary-blue); margin-bottom: 1rem; opacity: 0.6; }
        .empty-state h4 { margin-bottom: 0.5rem; color: var(--primary-blue); }

        .instructor-name { color: var(--primary-blue); font-weight: 600; }
        .datetime-info { font-size: 0.85rem; color: var(--dark-gray); line-height: 1.3; }
        .datetime-info .date { font-weight: 600; color: var(--primary-blue); }
        .datetime-info .time { color: var(--dark-gray); }

        /* ===== FLASH ALERTS ===== */
        .flash-alert {
            position: fixed; top: 90px; right: 20px; display: flex; align-items: center; gap: 0.6rem;
            padding: 12px 16px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            z-index: 2001; opacity: 0; transform: translateY(-10px);
            transition: opacity 0.25s ease, transform var(--transition);
            max-width: 460px;
        }
        .flash-alert.show { opacity: 1; transform: translateY(0); }
        .flash-alert i { font-size: 1.1rem; }
        .flash-alert .message { flex: 1; }
        .flash-alert .close {
            background: transparent; border: 0; color: inherit; cursor: pointer; width: 32px; height: 32px;
            border-radius: 50%; display: grid; place-items: center; font-size: 18px; transition: var(--transition);
        }
        .flash-alert .close:hover { background: rgba(255,255,255,0.2); transform: rotate(90deg); }
        .flash-alert.success { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color: #fff; }
        .flash-alert.danger { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: #fff; }

        /* ===== PAGINATION ===== */
        .pagination-container {
            display: none; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 1rem 1.25rem; background: #fff; border-top: 1px solid rgba(0,0,0,0.08);
        }
        .page-btn {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: #fff; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; transition: var(--transition);
        }
        .page-btn:hover { transform: translateY(-1px); box-shadow: var(--shadow); }
        .page-btn:disabled {
            background: var(--dark-gray); opacity: 0.6; cursor: not-allowed; transform: none; box-shadow: none;
        }
        .pagination-pages { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
        .page-number,
        .page-ellipsis {
            min-width: 40px; height: 40px; padding: 0 12px; border-radius: 10px; border: 0;
            background: #f1f3f5; color: #4b5563; font-weight: 600;
            display: inline-flex; align-items: center; justify-content: center;
            cursor: pointer; transition: var(--transition);
        }
        .page-number:hover { transform: translateY(-1px); box-shadow: var(--shadow); }
        .page-number.active { background: var(--accent-blue); color: #fff; }
        .page-ellipsis { background: transparent; cursor: default; color: var(--dark-gray); min-width: auto; padding: 0 6px; }

        @media (max-width: 992px) {
            .table-container { overflow-x: auto; }
            .data-table { min-width: 1400px; }
        }
        @media (max-width: 768px) {
            .page-title { font-size: 2rem; }
            .action-bar { flex-direction: column; align-items: stretch; }
            .search-form { justify-content: stretch; }
            .search-input { width: 100%; }
            .data-table { font-size: 0.8rem; }
            .data-table th,
            .data-table td { padding: 10px 8px; }
            .abstract-preview { width: 150px; }
            .toggle-buttons { width: 100%; justify-content: center; flex-wrap: wrap; }
            .info-banner { flex-direction: column; text-align: center; }
            .comment-display-box { min-width: 250px; max-width: 400px; }
            .pagination-container { flex-direction: column; gap: 0.75rem; }
            .pagination-pages { justify-content: center; }
        }
        @media (max-width: 480px) {
            .page-title { font-size: 1.7rem; }
            .action-bar { padding: 1rem; }
            .comment-display-box { min-width: 200px; max-width: 300px; }
            .abstract-preview { width: 120px; }
            .modal-body { padding: 1rem; }
            .modal-footer { padding: 1rem; flex-direction: column; }
            .modal-btn { width: 100%; }
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="CED Logo">
            <span style="color: white;">CED's Academic Resources Management</span>
        </div>

        <button class="navbar-toggler d-lg-none" type="button" onclick="openSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-links d-none d-lg-flex">
            <a href="{{ route('dean.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="{{ route('dean.research') }}" class="active">
                <i class="fas fa-microscope me-2"></i>Research
            </a>
            <a href="{{ route('dean.syllabus') }}">
                <i class="fas fa-book me-2"></i>Syllabus
            </a>
            <a href="{{ route('dean.exam') }}">
                <i class="fas fa-clipboard-list me-2"></i>Exam Bank
            </a>
            <a href="{{ route('account.settings') }}" class="profile-section-nav">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profile-img">
                @else
                    <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                @endif
                <span class="profile-name-nav">{{ Auth::user()->name }}</span>
            </a>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar -->
<div id="mobileSidebar" class="mobile-sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">
        <i class="fas fa-times"></i>
    </a>

    <div class="profile-section">
        @if(Auth::user()->profile_picture)
            <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture">
        @else
            <img src="{{ asset('images/default-user.png') }}" alt="Default User Icon">
        @endif
        <div style="color: white; font-weight: 600; margin-top: 10px;">{{ Auth::user()->name }}</div>
        <span class="role-badge">{{ strtoupper(Auth::user()->role) }}</span>
    </div>

    <a href="{{ route('dean.dashboard') }}" onclick="closeSidebar()"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ route('dean.research') }}" class="active" onclick="closeSidebar()"><i class="fas fa-microscope me-2"></i>Research</a>
    <a href="{{ route('dean.syllabus') }}" onclick="closeSidebar()"><i class="fas fa-book me-2"></i>Syllabus</a>
    <a href="{{ route('dean.exam') }}" onclick="closeSidebar()"><i class="fas fa-clipboard-list me-2"></i>Exam Bank</a>
    <a href="{{ route('account.settings') }}" onclick="closeSidebar()"><i class="fas fa-user me-2"></i>View Profile</a>
    <a href="{{ route('dean.settings.edit') }}" onclick="closeSidebar()"><i class="fas fa-user-edit me-2"></i>Edit Profile</a>
    <a href="{{ route('dean.generate.research') }}" onclick="closeSidebar()"><i class="fas fa-flask me-2"></i>Generate Research</a>
    <a href="{{ route('dean.generate.syllabus') }}" onclick="closeSidebar()"><i class="fas fa-file-alt me-2"></i>Generate Syllabus</a>
    <a href="{{ route('dean.generate.exam') }}" onclick="closeSidebar()"><i class="fas fa-tasks me-2"></i>Generate Exam</a>
    <a href="{{ route('dean.accounts.index') }}" onclick="closeSidebar()"><i class="fas fa-user-lock me-2"></i>Disable Accounts</a>

    <div class="logout-section">
        <button type="button" class="logout-btn" onclick="showLogoutModal()">
            <i class="fas fa-sign-out-alt me-2"></i>Logout
        </button>
    </div>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="modal-overlay" onclick="closeModalOnOverlay(event)">
    <div class="logout-modal">
        <div class="modal-headers">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="modal-headers-content">
                <h3>Confirm Logout</h3>
                <p>Are you sure you want to leave?</p>
            </div>
        </div>
        <div class="modal-body">
            <p>You will be signed out of your account and redirected to the login page.</p>
            <div class="modal-actions">
                <button type="button" class="modal-btn modal-btn-cancel" onclick="closeLogoutModal()">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button type="button" class="modal-btn modal-btn-confirm" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Yes, Logout
                </button>
            </div>
        </div>
    </div>
</div>

<form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
    @csrf
</form>

<!-- Main Content -->
<div class="main-container">
    <div class="container">

        @if(session('success'))
            <div id="flashSuccess" class="flash-alert success" role="alert">
                <i class="fas fa-check-circle"></i>
                <span class="message">{{ session('success') }}</span>
                <button type="button" class="close" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div id="flashError" class="flash-alert danger" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <span class="message">{{ session('error') }}</span>
                <button type="button" class="close" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Research Repository</h1>
            <p class="page-subtitle">View all faculty research submissions</p>
        </div>

        <!-- Info Banner -->
        <div class="info-banner">
            <i class="fas fa-info-circle"></i>
            <div class="info-banner-content">
                <h4>View-Only Access</h4>
                <p>You have read-only access to the research repository. All research submissions are managed and reviewed by the evaluator before final approval.</p>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="action-bar">
            <div class="toggle-buttons">
                <button class="toggle-btn active" id="allBtn" onclick="showAllResearch()">
                    <i class="fas fa-list"></i>
                    All Research
                </button>
                <button class="toggle-btn" id="pendingBtn" onclick="showPendingResearch()">
                    <i class="fas fa-clock"></i>
                    Pending
                </button>
                <button class="toggle-btn" id="approvedBtn" onclick="showApprovedResearch()">
                    <i class="fas fa-check-circle"></i>
                    Approved
                </button>
            </div>

            <form class="search-form" action="{{ route('dean.research') }}" method="GET">
                @php
                    $years = $researches->pluck('publication_year')->filter()->unique()->sortDesc();
                @endphp
                <input type="hidden" name="view" id="searchView" value="{{ request('view', 'all') }}">

                <input type="text"
                       name="search"
                       class="search-input"
                       placeholder="Search research papers..."
                       value="{{ request('search') }}"
                       style="width: 320px;">

                <select name="year" id="yearFilter" class="form-select" style="padding: 12px 16px; border: 2px solid var(--primary-blue); border-radius: 25px; width: 200px;">
                    <option value="">Publication Year</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>

                <button type="submit" class="search-btn">
                    <i class="fas fa-search me-1"></i>Search
                </button>
                <a href="{{ route('dean.research', ['view' => request('view', 'all')]) }}" class="clear-btn" style="text-decoration:none;">
                    <i class="fas fa-times me-1"></i>Clear
                </a>
            </form>
        </div>

        <!-- Research Table -->
        <div class="table-container">
            <div class="table-header">
                <h3 id="tableTitle">
                    <i class="fas fa-microscope me-2"></i>All Research Submissions
                </h3>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-book me-1"></i>TITLE</th>
                            <th><i class="fas fa-user-check me-1"></i>AUTHOR</th>
                            <th><i class="fas fa-tag me-1"></i>RESEARCH AREA</th>
                            <th><i class="fas fa-file-alt me-1"></i>ABSTRACT</th>
                            <th><i class="fas fa-key me-1"></i>KEYWORDS</th>
                            <th><i class="fas fa-calendar-day me-1"></i>PUBLICATION YEAR</th>
                            <th><i class="fas fa-user me-1"></i>INSTRUCTOR</th>
                            <th><i class="fas fa-calendar me-1"></i>SUBMITTED</th>
                            <th><i class="fas fa-info-circle me-1"></i>STATUS</th>
                            <th><i class="fas fa-cog me-1"></i>ACTIONS</th>
                            <th><i class="fas fa-comment me-1"></i>EVALUATOR COMMENT</th>
                        </tr>
                    </thead>
                    <tbody id="researchTableBody">
                        @forelse ($researches as $research)
                            <tr class="research-row"
                                data-status="{{ $research->status }}"
                                data-year="{{ $research->publication_year }}"
                                data-search-text="{{ strtolower(($research->id ?? '') . ' ' . ($research->title ?? '') . ' ' . ($research->author ?? '') . ' ' . ($research->research_area ?? '') . ' ' . ($research->abstract ?? '') . ' ' . ($research->keyword ?? '') . ' ' . (($research->user->name ?? '')) . ' ' . ($research->publication_year ?? '')) }}">
                                <td><strong>{{ $research->id }}</strong></td>
                                <td><strong>{{ $research->title }}</strong></td>
                                <td>{{ $research->author }}</td>
                                <td><span class="badge bg-primary">{{ $research->research_area }}</span></td>
                                <td>
                                    <a href="javascript:void(0)"
                                       class="abstract-preview"
                                       onclick='showAbstract(@json($research->title), @json($research->author), @json($research->research_area), @json($research->abstract), @json($research->keyword), @json($research->publication_year))'>
                                        {{ \Illuminate\Support\Str::limit($research->abstract, 80) }}
                                        <small class="read-more-text"><i class="fas fa-eye me-1"></i>Click to read full</small>
                                    </a>
                                </td>
                                <td>{{ $research->keyword }}</td>
                                <td><span class="badge bg-info">{{ $research->publication_year }}</span></td>
                                <td><strong><span class="instructor-name">{{ $research->user->name ?? 'N/A' }}</span></strong></td>
                                <td>
                                    <div class="datetime-info">
                                        <div class="date">{{ $research->created_at->setTimezone('Asia/Manila')->format('M d, Y') }}</div>
                                        <div class="time">{{ $research->created_at->setTimezone('Asia/Manila')->format('h:i A') }}</div>
                                    </div>
                                </td>
                                <td>
                                    @if ($research->status === 'Approved')
                                        <span class="status-badge approved">
                                            <i class="fas fa-check-circle"></i>Approved
                                        </span>
                                    @elseif ($research->status === 'Returned')
                                        <span class="status-badge returned">
                                            <i class="fas fa-exclamation-triangle"></i>Returned
                                        </span>
                                    @else
                                        <span class="status-badge pending">
                                            <i class="fas fa-clock"></i>Pending
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-links">
                                        @if ($research->status === 'Approved')
                                            <a href="{{ asset('storage/' . $research->file_path) }}" target="_blank" class="action-btn view">
                                                <i class="fas fa-eye"></i>View
                                            </a>
                                            <a href="{{ route('faculty.research.download', $research->id) }}" class="action-btn download">
                                                <i class="fas fa-download"></i>Download
                                            </a>
                                        @else
                                            <a href="{{ route('faculty.research.view', $research->id) }}" target="_blank" class="action-btn view">
                                                <i class="fas fa-eye"></i>View
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="comment-display-box">
                                        <div class="comment-header">
                                            <i class="fas fa-user-check me-2"></i>
                                            <span>Evaluator's Comment</span>
                                        </div>
                                        @if($research->evaluator_comment)
                                            <div class="comment-text">{{ $research->evaluator_comment }}</div>
                                        @else
                                            <div class="no-comment-text">
                                                <i class="fas fa-comment-slash me-1"></i>No evaluator comment yet
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="12">
                                    <div class="empty-state">
                                        <i class="fas fa-microscope"></i>
                                        <h4 id="emptyTitle">No Research Submissions Found</h4>
                                        <p id="emptyMessage">There are no research submissions in the repository at this time.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-container" id="paginationContainer">
                <button type="button" class="page-btn prev" id="prevPageBtn">
                    <i class="fas fa-chevron-left"></i> Back
                </button>

                <div class="pagination-pages" id="paginationPages"></div>

                <button type="button" class="page-btn next" id="nextPageBtn">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Abstract Modal -->
<div id="abstractModal" class="custom-modal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fas fa-file-alt"></i>Research Abstract
            </h3>
            <button class="close-modal" onclick="closeAbstractModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="modal-body">
            <div class="abstract-info">
                <h5 id="abstractTitle">Research Title</h5>
                <p><strong>Author:</strong> <span id="abstractAuthor">Author Name</span></p>
                <p><strong>Research Area:</strong> <span id="abstractArea">Research Area</span></p>
                <p><strong>Publication Year:</strong> <span id="abstractYear">Publication Year</span></p>
                <p><strong>Keywords:</strong> <span id="abstractKeywords">Keywords</span></p>
            </div>

            <div class="abstract-modal-content">
                <h5 style="color: var(--primary-blue); margin-bottom: 1rem; border-bottom: 2px solid var(--accent-blue); padding-bottom: 0.5rem;">
                    <i class="fas fa-align-left me-2"></i>Abstract
                </h5>
                <div id="abstractContent">
                    Abstract content will appear here...
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="modal-btn secondary" onclick="closeAbstractModal()">
                <i class="fas fa-times me-1"></i>Close
            </button>
        </div>
    </div>
</div>

<script>
let currentView = '{{ request("view", "all") }}';

const PAGE_SIZE = 5;
let currentPage = 1;

const initialSearchTermRaw = @json(request('search', ''));
const initialYearFilterRaw = @json(request('year', ''));
const filterSearchTerm = (initialSearchTermRaw || '').toString().toLowerCase().trim();
const filterYear = (initialYearFilterRaw || '').toString().trim();
const filtersActive = filterSearchTerm !== '' || filterYear !== '';

function openSidebar() {
    const sidebar = document.getElementById('mobileSidebar');
    sidebar.style.width = window.innerWidth <= 480 ? 'min(260px, 90vw)' : 'min(280px, 85vw)';
    sidebar.classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    const sidebar = document.getElementById('mobileSidebar');
    sidebar.style.width = '0';
    sidebar.classList.remove('open');
    document.body.style.overflow = 'auto';
}

function showAbstract(title, author, area, abstract, keywords, year) {
    document.getElementById('abstractTitle').textContent = title || '';
    document.getElementById('abstractAuthor').textContent = author || '';
    document.getElementById('abstractArea').textContent = area || '';
    document.getElementById('abstractKeywords').textContent = keywords || '';
    document.getElementById('abstractYear').textContent = year || '';
    document.getElementById('abstractContent').textContent = abstract || '';
    document.getElementById('abstractModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeAbstractModal() {
    document.getElementById('abstractModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function initFlashAutoHide(id, delayMs) {
    const el = document.getElementById(id);
    if (!el) return;
    requestAnimationFrame(() => el.classList.add('show'));
    const remove = () => {
        el.classList.remove('show');
        setTimeout(() => {
            if (el && el.parentNode) {
                el.parentNode.removeChild(el);
            }
        }, 250);
    };
    const closeBtn = el.querySelector('[data-close]');
    if (closeBtn) {
        closeBtn.addEventListener('click', remove);
    }
    setTimeout(remove, delayMs || 2500);
}

function showLogoutModal() {
    document.getElementById('logoutModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeLogoutModal() {
    document.getElementById('logoutModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}
function closeModalOnOverlay(event) {
    if (event.target.id === 'logoutModal') {
        closeLogoutModal();
    }
}
function confirmLogout() {
    document.getElementById('logoutForm').submit();
}

function getAllowedStatusesForView() {
    if (currentView === 'approved') return ['Approved'];
    if (currentView === 'pending') return ['Pending', 'Returned'];
    return ['Pending', 'Returned', 'Approved'];
}

function showAllResearch() {
    currentView = 'all';
    document.getElementById('searchView').value = 'all';
    document.getElementById('allBtn').classList.add('active');
    document.getElementById('pendingBtn').classList.remove('active');
    document.getElementById('approvedBtn').classList.remove('active');
    document.getElementById('tableTitle').innerHTML = '<i class="fas fa-microscope me-2"></i>All Research Submissions';
    updateEmptyState('all');
    currentPage = 1;
    applyFiltersAndPagination();
}
function showPendingResearch() {
    currentView = 'pending';
    document.getElementById('searchView').value = 'pending';
    document.getElementById('pendingBtn').classList.add('active');
    document.getElementById('approvedBtn').classList.remove('active');
    document.getElementById('allBtn').classList.remove('active');
    document.getElementById('tableTitle').innerHTML = '<i class="fas fa-clock me-2"></i>Pending Research Submissions';
    updateEmptyState('pending');
    currentPage = 1;
    applyFiltersAndPagination();
}
function showApprovedResearch() {
    currentView = 'approved';
    document.getElementById('searchView').value = 'approved';
    document.getElementById('approvedBtn').classList.add('active');
    document.getElementById('pendingBtn').classList.remove('active');
    document.getElementById('allBtn').classList.remove('active');
    document.getElementById('tableTitle').innerHTML = '<i class="fas fa-check-circle me-2"></i>Approved Research Submissions';
    updateEmptyState('approved');
    currentPage = 1;
    applyFiltersAndPagination();
}

function updateEmptyState(view) {
    const emptyTitle = document.getElementById('emptyTitle');
    const emptyMessage = document.getElementById('emptyMessage');
    if (!emptyTitle || !emptyMessage) return;
    if (view === 'approved') {
        emptyTitle.textContent = 'No Approved Research Found';
        emptyMessage.textContent = 'There are no approved research submissions at this time.';
    } else if (view === 'pending') {
        emptyTitle.textContent = 'No Pending Research Found';
        emptyMessage.textContent = 'There are no pending research submissions at this time.';
    } else {
        emptyTitle.textContent = 'No Research Submissions Found';
        emptyMessage.textContent = 'There are no research submissions in the repository at this time.';
    }
}

function applyFiltersAndPagination() {
    const allowed = getAllowedStatusesForView();
    const rows = Array.from(document.querySelectorAll('.research-row'));
    const matching = rows.filter(row => {
        const status = row.getAttribute('data-status') || '';
        if (!allowed.includes(status)) return false;
        const text = row.getAttribute('data-search-text') || '';
        const rowYear = (row.getAttribute('data-year') || '').toString().trim();
        const matchesSearch = filterSearchTerm === '' || text.includes(filterSearchTerm);
        const matchesYear = filterYear === '' || rowYear === filterYear;
        return matchesSearch && matchesYear;
    });

    const total = matching.length;
    const totalPages = Math.max(1, Math.ceil(total / PAGE_SIZE));
    if (currentPage > totalPages) currentPage = totalPages;

    rows.forEach(row => {
        row.style.display = 'none';
    });

    if (total > 0) {
        const startIdx = (currentPage - 1) * PAGE_SIZE;
        matching.slice(startIdx, startIdx + PAGE_SIZE).forEach(row => {
            row.style.display = '';
        });
        updateEmptyRow(false);
    } else {
        updateEmptyRow(true);
    }

    updatePaginationControls(total, currentPage, totalPages);
}

function getPaginationItems(totalPages, currentPage) {
    const items = [];
    if (totalPages <= 7) {
        for (let i = 1; i <= totalPages; i++) items.push(i);
        return items;
    }
    if (currentPage <= 4) {
        items.push(1, 2, 3, 4, 5, '...', totalPages);
        return items;
    }
    if (currentPage >= totalPages - 3) {
        items.push(1, '...', totalPages - 4, totalPages - 3, totalPages - 2, totalPages - 1, totalPages);
        return items;
    }
    items.push(1, '...', currentPage - 1, currentPage, currentPage + 1, '...', totalPages);
    return items;
}

function updatePaginationControls(total, page, totalPages) {
    const container = document.getElementById('paginationContainer');
    const prevBtn = document.getElementById('prevPageBtn');
    const nextBtn = document.getElementById('nextPageBtn');
    const pagesEl = document.getElementById('paginationPages');
    if (!container || !prevBtn || !nextBtn || !pagesEl) return;

    if (total === 0 || total <= PAGE_SIZE) {
        container.style.display = 'none';
        return;
    }

    container.style.display = 'flex';
    prevBtn.disabled = page <= 1;
    nextBtn.disabled = page >= totalPages;

    pagesEl.innerHTML = '';
    const items = getPaginationItems(totalPages, page);
    items.forEach(item => {
        if (item === '...') {
            const ell = document.createElement('span');
            ell.className = 'page-ellipsis';
            ell.textContent = '...';
            pagesEl.appendChild(ell);
        } else {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'page-number' + (item === page ? ' active' : '');
            btn.dataset.page = String(item);
            btn.textContent = String(item);
            pagesEl.appendChild(btn);
        }
    });
}

function updateEmptyRow(showEmpty) {
    const emptyRow = document.getElementById('emptyRow');
    if (!emptyRow) return;
    if (showEmpty) {
        const titleEl = document.getElementById('emptyTitle');
        const messageEl = document.getElementById('emptyMessage');
        if (filtersActive) {
            if (titleEl) titleEl.textContent = 'No Research Found';
            if (messageEl) messageEl.textContent = 'No research submissions match your filters.';
        } else {
            updateEmptyState(currentView);
        }
        emptyRow.style.display = '';
    } else {
        emptyRow.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const viewParam = urlParams.get('view') || 'all';

    if (viewParam === 'approved') {
        showApprovedResearch();
    } else if (viewParam === 'pending') {
        showPendingResearch();
    } else {
        showAllResearch();
    }

    initFlashAutoHide('flashSuccess', 2500);
    initFlashAutoHide('flashError', 3500);

    const absModal = document.getElementById('abstractModal');
    if (absModal) {
        absModal.addEventListener('click', function (event) {
            if (event.target === this) {
                closeAbstractModal();
            }
        });
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeAbstractModal();
            closeLogoutModal();
            closeSidebar();
            ['flashSuccess', 'flashError'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.classList.remove('show');
                    setTimeout(() => {
                        if (el.parentNode) {
                            el.parentNode.removeChild(el);
                        }
                    }, 200);
                }
            });
        }
    });

    let resizeTimeout;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function () {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        }, 250);
    });

    const prevBtn = document.getElementById('prevPageBtn');
    const nextBtn = document.getElementById('nextPageBtn');
    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                applyFiltersAndPagination();
            }
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            currentPage++;
            applyFiltersAndPagination();
        });
    }
    const pagesEl = document.getElementById('paginationPages');
    if (pagesEl) {
        pagesEl.addEventListener('click', function (e) {
            const btn = e.target.closest('.page-number');
            if (!btn || !btn.dataset.page) return;
            const newPage = parseInt(btn.dataset.page, 10);
            if (!isNaN(newPage) && newPage !== currentPage) {
                currentPage = newPage;
                applyFiltersAndPagination();
            }
        });
    }
});
</script>

<script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
