<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Syllabus Repository - CED's Academic Resources Management</title>
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
            min-height: 100vh; color: #333;
        }

        .navbar { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); box-shadow: var(--shadow); padding: 1rem 0; position: sticky; top: 0; z-index: 1000; }
        .logo { display: flex; align-items: center; font-weight: 700; font-size: 1.2rem; }
        .logo img { height: 50px; width: 50px; border-radius: 8px; margin-right: 12px; }
        .nav-links { display: flex; gap: 1.5rem; align-items: center; }
        .nav-links a { color: white; text-decoration: none; font-weight: 500; padding: 8px 16px; border-radius: 8px; transition: var(--transition); position: relative; }
        .nav-links a:hover { background: rgba(255, 255, 255, 0.2); transform: translateY(-2px); }
        .nav-links a.active { background: rgba(255, 255, 255, 0.3); }
        .navbar-toggler { border: none; color: white; font-size: 1.5rem; padding: 8px; border-radius: 8px; transition: var(--transition); }
        .navbar-toggler:hover { background: rgba(255, 255, 255, 0.2); }
        .profile-img { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(255, 255, 255, 0.3); transition: var(--transition); }
        .profile-img:hover { border-color: rgba(255, 255, 255, 0.7); transform: scale(1.1); }
        .profile-section-nav { display: flex; flex-direction: column; align-items: center; gap: 4px; padding: 4px 12px; border-radius: 8px; transition: var(--transition); text-decoration: none; }
        .profile-section-nav:hover { background: rgba(255,255,255,0.2); }
        .profile-name-nav { color: white; font-size: 0.75rem; font-weight: 500; white-space: nowrap; max-width: 120px; overflow: hidden; text-overflow: ellipsis; text-align: center; }

        .mobile-sidebar { height: 100vh; height: 100dvh; width: 0; position: fixed; top: 0; left: 0; background: linear-gradient(180deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); overflow-x: hidden; overflow-y: auto; -webkit-overflow-scrolling: touch; overscroll-behavior: contain; touch-action: pan-y; transition: var(--transition); z-index: 1050; padding-top: 60px; padding-bottom: calc(24px + env(safe-area-inset-bottom)); }
        .mobile-sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; font-weight: 500; margin: 5px 15px; border-radius: 8px; transition: var(--transition); }
        .mobile-sidebar a:hover, .mobile-sidebar a.active { background: rgba(255, 255, 255, 0.2); transform: translateX(5px); }
        .mobile-sidebar .closebtn { position: absolute; top: 15px; right: 25px; font-size: 30px; cursor: pointer; color: white; transition: var(--transition); }
        .mobile-sidebar .closebtn:hover { color: var(--warning-yellow); }
        .mobile-sidebar .profile-section { text-align: center; margin: 20px 0; padding: 0 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.2); padding-bottom: 20px; }
        .mobile-sidebar .profile-section img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 10px; border: 3px solid rgba(255, 255, 255, 0.3); }
        .mobile-sidebar .profile-name-nav { color: white; font-size: 0.85rem; font-weight: 600; white-space: nowrap; max-width: 160px; overflow: hidden; text-overflow: ellipsis; display: block; margin: 4px auto 0; }
        .mobile-sidebar .role-badge { background: rgba(255, 255, 255, 0.2); color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; display: inline-block; margin-top: 5px; }
        .mobile-sidebar .logout-section { width: 100%; padding: 15px; margin-top: 2rem; margin-bottom: env(safe-area-inset-bottom); }
        .mobile-sidebar .logout-btn { width: 100%; background: var(--danger-red); color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 500; transition: var(--transition); display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
        .mobile-sidebar .logout-btn:hover { background: #c82333; transform: translateY(-2px); }
        @media (max-width: 480px) { .mobile-sidebar.open { width: min(280px, 85vw); } }
        @media (min-width: 481px) and (max-width: 991.98px) { .mobile-sidebar.open { width: min(260px, 90vw); } }

        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(4px); z-index: 2000; align-items: center; justify-content: center; animation: fadeIn 0.3s ease; }
        .modal-overlay.active { display: flex; }
        .logout-modal { background: white; border-radius: var(--border-radius); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); max-width: 450px; width: 90%; overflow: hidden; animation: slideIn 0.3s ease; position: relative; }
        .logout-modal .modal-header { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; padding: 1.5rem 2rem; display: flex; align-items: center; gap: 1rem; }
        .logout-modal .modal-header i { font-size: 2rem; }
        .modal-header-content h3 { margin: 0; font-size: 1.3rem; font-weight: 600; }
        .modal-header-content p { margin: 0.25rem 0 0 0; font-size: 0.9rem; opacity: 0.9; }
        .logout-modal .modal-body { padding: 2rem; text-align: center; }
        .modal-actions { display: flex; gap: 1rem; justify-content: center; }
        .modal-btn { padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: var(--transition); border: none; display: inline-flex; align-items: center; gap: 0.5rem; }
        .modal-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }
        .modal-btn-cancel { background: var(--light-gray); color: var(--dark-gray); }
        .modal-btn-cancel:hover { background: #e2e6ea; }
        .modal-btn-confirm { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; }
        .modal-btn-confirm:hover { box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4); }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideIn { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        .main-container { padding: 2rem 0; }
        .page-header { text-align: center; margin-bottom: 2rem; padding: 0 1rem; }
        .page-title { font-size: 2.5rem; font-weight: 700; color: var(--primary-blue); margin-bottom: 0.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .page-subtitle { font-size: 1.1rem; color: var(--dark-gray); font-weight: 400; }

        .action-bar { background: white; border-radius: var(--border-radius); box-shadow: var(--shadow); padding: 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .submit-btn { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color: white; border: none; padding: 12px 24px; border-radius: 25px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: var(--transition); display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--shadow); }
        .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(40,167,69,0.3); }
        .search-form { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
        .search-input { padding: 12px 20px; border: 2px solid var(--primary-blue); border-radius: 25px; width: 350px; font-size: 1rem; transition: var(--transition); outline: none; }
        .search-input:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(74,144,226,0.1); }
        .search-btn { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: var(--transition); }
        .search-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }
        .clear-btn { background: var(--dark-gray); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: var(--transition); }
        .clear-btn:hover { background: #5a6268; transform: translateY(-2px); }
        .help-btn { background: #fff; color: var(--primary-blue); border: 2px solid var(--primary-blue); padding: 10px; border-radius: 50%; width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center; box-shadow: var(--shadow); transition: var(--transition); }
        .help-btn:hover { background: rgba(255,255,255,0.9); transform: translateY(-2px); }

        .table-container { background: white; border-radius: var(--border-radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 2rem; }
        .table-header { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; padding: 1rem 1.5rem; text-align: center; }
        .table-header h3 { margin: 0; font-size: 1.3rem; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
        .data-table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        .data-table thead th { white-space: nowrap; vertical-align: middle; }
        .data-table thead th i { margin-right: .4rem; vertical-align: middle; }
        .data-table th, .data-table td { padding: 15px 12px; text-align: left; border-bottom: 1px solid rgba(0,0,0,0.1); }
        .data-table th { font-weight: 600; color: var(--primary-blue); letter-spacing: 0.3px; font-size: 0.85rem; }
        .data-table tbody tr { transition: var(--transition); }
        .data-table tbody tr:hover { background: rgba(0, 31, 91, 0.03); }

        .status-badge { display: inline-flex; align-items: center; gap: 0.3rem; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-badge.approved { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color: white; }
        .status-badge.pending { background: linear-gradient(135deg, var(--warning-yellow) 0%, #ffb800 100%); color: #856404; }
        .status-badge.returned { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; }

        .action-links { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
        .action-btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 500; transition: var(--transition); border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.3rem; }
        .action-btn.view { background: var(--accent-blue); color: white; }
        .action-btn.download { background: var(--success-green); color: white; }
        .action-btn.edit { background: var(--warning-yellow); color: #856404; }
        .action-btn.delete { background: var(--danger-red); color: white; }
        .action-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }

        .comment-btn { background: var(--accent-blue); color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 500; cursor: pointer; transition: var(--transition); display: inline-flex; align-items: center; gap: 0.3rem; min-width: 80px; justify-content: center; }
        .comment-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); background: var(--secondary-blue); }
        .comment-btn.no-comment { background: var(--dark-gray); cursor: not-allowed; }
        .comment-btn.no-comment:hover { transform: none; background: var(--dark-gray); }

        .custom-modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px); z-index: 1060; justify-content: center; align-items: center; padding: 1rem; overflow-y: auto; }
        .modal-content { background: white; border-radius: var(--border-radius); box-shadow: 0 20px 60px rgba(0,0,0,0.3); width: 100%; max-width: 800px; max-height: 90vh; overflow: hidden; animation: modalSlideIn 0.3s ease-out; position: relative; }
        .modal-content.small { max-width: 450px; }
        .comment-modal-content { max-width: 600px; }
        @keyframes modalSlideIn { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-header { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; padding: 1.5rem 2rem; border-bottom: none; position: relative; }
        .modal-header.danger { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); }
        .modal-title { font-size: 1.4rem; font-weight: 600; margin: 0; display: flex; align-items: center; gap: 0.5rem; }
        .close-modal { position: absolute; top: 15px; right: 20px; background: none; border: none; color: white; font-size: 24px; cursor: pointer; transition: var(--transition); width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 50%; }
        .close-modal:hover { background: rgba(255, 255, 255, 0.2); transform: rotate(90deg); }
        .modal-body { padding: 2rem; max-height: 60vh; overflow-y: auto; }

        .delete-confirmation-text { text-align: center; color: #333; font-size: 1.1rem; line-height: 1.6; margin: 1rem 0; }
        .delete-confirmation-text .syllabus-info { font-weight: 700; color: var(--danger-red); display: block; margin: 1rem 0; padding: 1rem; background: rgba(220, 53, 69, 0.1); border-radius: 8px; border-left: 4px solid var(--danger-red); }
        .delete-warning { background: #fff3cd; border: 2px solid #ffc107; border-radius: 8px; padding: 1rem; margin-top: 1rem; display: flex; align-items: center; gap: 0.75rem; }
        .delete-warning i { font-size: 1.5rem; color: #856404; }
        .delete-warning p { margin: 0; color: #856404; font-weight: 500; font-size: 0.95rem; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--primary-blue); }
        .form-control { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: var(--transition); outline: none; }
        .form-control:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(74,144,226,0.1); }
        .form-select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e"); background-position: right 12px center; background-repeat: no-repeat; background-size: 16px; appearance: none; }
        .file-upload-wrapper { position: relative; }
        .file-upload-label { display: block; border: 2px dashed #e0e0e0; padding: 20px; border-radius: 8px; text-align: center; cursor: pointer; transition: var(--transition); background: #f9f9f9; }
        .file-upload-label:hover { border-color: var(--accent-blue); background: rgba(74, 144, 226, 0.05); }
        .file-upload-label.has-file { border-color: var(--success-green); background: rgba(40,167,69,0.05); color: var(--success-green); }
        .file-upload-input { display: none; }
        .file-upload-icon { font-size: 2rem; color: var(--accent-blue); margin-bottom: 0.5rem; display: block; }

        .modal-footer { padding: 1.5rem 2rem; background: var(--light-gray); border-top: 1px solid rgba(0,0,0,0.1); display: flex; justify-content: flex-end; gap: 1rem; }
        .modal-btn { padding: 12px 24px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: var(--transition); border: none; font-size: 1rem; }
        .modal-btn.primary { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color: white; }
        .modal-btn.secondary { background: var(--dark-gray); color: white; }
        .modal-btn.danger { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; }
        .modal-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }

        .comment-text { background: var(--light-gray); padding: 1.5rem; border-radius: 8px; border-left: 4px solid var(--accent-blue); font-size: 1rem; line-height: 1.6; color: #333; white-space: pre-wrap; word-wrap: break-word; margin: 0; }
        .no-comment-text { color: var(--dark-gray); font-style: italic; text-align: center; }

        .empty-state { text-align: center; padding: 3rem 2rem; color: var(--dark-gray); }
        .empty-state i { font-size: 4rem; color: var(--primary-blue); margin-bottom: 1rem; opacity: 0.6; }
        .empty-state h4 { margin-bottom: 0.5rem; color: var(--primary-blue); }

        .datetime-info { font-size: 0.85rem; color: var(--dark-gray); line-height: 1.3; }
        .datetime-info .date { font-weight: 600; color: var(--primary-blue); }
        .datetime-info .time { color: var(--dark-gray); }
        .instructor-info { color: var(--primary-blue); font-weight: 600; }

        .flash-alert{ position:fixed; top:90px; right:20px; display:flex; align-items:center; gap:.6rem; padding:12px 16px; border-radius:10px; box-shadow:0 10px 30px rgba(0,0,0,.15); z-index:2001; opacity:0; transform:translateY(-10px); transition:opacity .25s ease, transform var(--transition), box-shadow var(--transition), background-color var(--transition); max-width:460px; }
        .flash-alert.show{ opacity:1; transform:translateY(0); }
        .flash-alert i{ font-size:1.1rem; }
        .flash-alert .message{ flex:1; }
        .flash-alert .close{ background:transparent; border:0; color:inherit; cursor:pointer; width:32px; height:32px; border-radius:50%; display:grid; place-items:center; font-size:18px; transition:var(--transition); }
        .flash-alert .close:hover{ background:rgba(255,255,255,.2); transform:rotate(90deg); }
        .flash-alert.success{ background:linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color:#fff; }
        .flash-alert.danger{ background:linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color:#fff; }

        .field-error { color: var(--danger-red); font-size: 0.9rem; margin-top: 6px; display: none; }
        .field-hint { color: var(--dark-gray); font-size: 0.85rem; margin-top: 6px; }
        .input-invalid { border-color: var(--danger-red) !important; box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.08) !important; }
        .input-valid { border-color: var(--success-green) !important; box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.08) !important; }
        .file-upload-label.error { border-color: var(--danger-red); color: var(--danger-red); background: rgba(220, 53, 69, 0.05); }
        .file-upload-label.success { border-color: var(--success-green); color: var(--success-green); background: rgba(40, 167, 69, 0.05); }
        .modal-btn.primary:disabled { opacity: 0.6; cursor: not-allowed; filter: grayscale(20%); }

        /* PAGINATION (numeric + ellipsis) */
        .pagination-container{
            display:none; align-items:center; justify-content:center; gap:.5rem;
            padding:1rem 1.25rem; background:#fff; border-top:1px solid rgba(0,0,0,.08);
        }
        .page-btn{
            background:linear-gradient(135deg,var(--primary-blue) 0%,var(--secondary-blue) 100%);
            color:#fff; border:none; padding:10px 16px; border-radius:8px; font-weight:600;
            display:inline-flex; align-items:center; gap:.5rem; cursor:pointer; transition:var(--transition);
        }
        .page-btn:hover{ transform:translateY(-1px); box-shadow:var(--shadow); }
        .page-btn:disabled{ background:var(--dark-gray); opacity:.6; cursor:not-allowed; transform:none; box-shadow:none; }
        .pagination-pages{ display:flex; align-items:center; gap:.5rem; flex-wrap:wrap; }
        .page-number, .page-ellipsis{
            min-width:40px; height:40px; padding:0 12px; border-radius:10px; border:0;
            background:#f1f3f5; color:#4b5563; font-weight:600;
            display:inline-flex; align-items:center; justify-content:center;
            cursor:pointer; transition:var(--transition);
        }
        .page-number:hover{ transform:translateY(-1px); box-shadow:var(--shadow); }
        .page-number.active{ background:var(--accent-blue); color:#fff; }
        .page-ellipsis{ background:transparent; cursor:default; color:var(--dark-gray); min-width:auto; padding:0 6px; }

        @media (max-width: 768px) {
            .page-title { font-size: 2rem; }
            .action-bar { flex-direction: column; align-items: stretch; }
            .search-form { justify-content: stretch; }
            .search-input { width: 100%; min-width: auto; }
            .data-table { font-size: 0.8rem; }
            .data-table th, .data-table td { padding: 10px 8px; }
            .modal-content { margin: 1rem; max-width: calc(100% - 2rem); }
            .modal-body { padding: 1.5rem; }
            .action-links { flex-direction: column; align-items: flex-start; }
            .form-grid { grid-template-columns: 1fr; }
            .flash-alert{ top:76px; left:12px; right:12px; max-width:none; }
            .pagination-container{ flex-direction:column; gap:.75rem; }
            .pagination-pages{ justify-content:center; }
        }
        @media (max-width: 480px) {
            .page-title { font-size: 1.7rem; }
            .action-bar { padding: 1rem; }
            .modal-body { padding: 1rem; }
            .modal-footer { padding: 1rem; flex-direction: column; }
            .modal-btn { width: 100%; }
        }
        @media (max-width: 1200px) {
            .table-container { overflow-x: auto; }
            .data-table { min-width: 1200px; }
        }
    </style>
</head>
<body>

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
            <a href="{{ route('faculty.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('faculty.research') }}"><i class="fas fa-microscope me-2"></i>Research</a>
            <a href="{{ route('faculty.syllabus') }}" class="active"><i class="fas fa-book me-2"></i>Syllabus</a>
            <a href="{{ route('faculty.exam') }}"><i class="fas fa-clipboard-list me-2"></i>Exam Bank</a>
            <a href="{{ route('settings.faculty') }}" class="profile-section-nav">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profile-img">
                @else
                    <i class="fas fa-user-circle" style="font-size: 30px; color: white;"></i>
                @endif
                <span class="profile-name-nav">{{ Auth::user()->name }}</span>
            </a>
        </div>
    </div>
</nav>

<div id="mobileSidebar" class="mobile-sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()"><i class="fas fa-times"></i></a>
    <div class="profile-section">
        @if(Auth::user()->profile_picture)
            <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture">
        @else
            <img src="{{ asset('images/default-user.png') }}" alt="Default User Icon">
        @endif
        <div style="color: white; font-weight: 600; margin-top: 10px;">{{ Auth::user()->name }}</div>
        <span class="role-badge">{{ strtoupper(Auth::user()->role) }}</span>
    </div>
    <a href="{{ route('faculty.dashboard') }}" onclick="closeSidebar()"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ route('faculty.research') }}" onclick="closeSidebar()"><i class="fas fa-microscope me-2"></i>Research</a>
    <a href="{{ route('faculty.syllabus') }}" class="active" onclick="closeSidebar()"><i class="fas fa-book me-2"></i>Syllabus</a>
    <a href="{{ route('faculty.exam') }}" onclick="closeSidebar()"><i class="fas fa-clipboard-list me-2"></i>Exam Bank</a>
    <a href="{{ route('settings.faculty') }}" onclick="closeSidebar()"><i class="fas fa-user me-2"></i>Profile</a>
    <a href="{{ route('faculty.settings.edit') }}" onclick="closeSidebar()"><i class="fas fa-user-edit me-2"></i>Edit Profile</a>
    <div class="logout-section">
        <button type="button" class="logout-btn" onclick="showLogoutModal()"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
    </div>
</div>

<div id="logoutModal" class="modal-overlay" onclick="closeModalOnOverlay(event)">
    <div class="logout-modal">
        <div class="modal-header">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="modal-header-content">
                <h3>Confirm Logout</h3>
                <p>Are you sure you want to leave?</p>
            </div>
        </div>
        <div class="modal-body">
            <p>You will be signed out of your account and redirected to the login page.</p>
            <div class="modal-actions">
                <button type="button" class="modal-btn modal-btn-cancel" onclick="closeLogoutModal()"><i class="fas fa-times"></i>Cancel</button>
                <button type="button" class="modal-btn modal-btn-confirm" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i>Yes, Logout</button>
            </div>
        </div>
    </div>
</div>

<form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>

<div class="main-container">
    <div class="container">

        @if(session('success'))
            <div id="flashSuccess" class="flash-alert success" role="alert" aria-live="polite">
                <i class="fas fa-check-circle"></i>
                <span class="message">{{ session('success') }}</span>
                <button type="button" class="close" data-close aria-label="Dismiss"><i class="fas fa-times"></i></button>
            </div>
        @endif
        @if(session('error'))
            <div id="flashError" class="flash-alert danger" role="alert" aria-live="assertive">
                <i class="fas fa-exclamation-triangle"></i>
                <span class="message">{{ session('error') }}</span>
                <button type="button" class="close" data-close aria-label="Dismiss"><i class="fas fa-times"></i></button>
            </div>
        @endif

        <div class="page-header">
            <h1 class="page-title">Syllabus Repository</h1>
            <p class="page-subtitle">Manage and submit your academic syllabus documents</p>
        </div>

        <div class="action-bar">
            <div class="d-flex align-items-center" style="gap:.5rem;">
                <button class="submit-btn" onclick="openModal()"><i class="fas fa-plus"></i>Submit New Syllabus</button>
                <button type="button" class="help-btn" onclick="openHelpModal()" aria-label="How to submit" title="How to submit"><i class="fas fa-info-circle"></i></button>
            </div>

            <form class="search-form" action="{{ route('faculty.syllabus') }}" method="GET">
                @php
                    $academicYears = $syllabuses->pluck('academic_year')->filter()->unique()->sortDesc();
                @endphp

                <input type="text" name="search" class="search-input" placeholder="Search course code or title..." value="{{ request('search') }}" style="width: 320px;">

                <select name="year" id="yearFilter" class="form-select" style="padding: 12px 16px; border: 2px solid var(--primary-blue); border-radius: 25px; width: 200px;">
                    <option value="">Academic Year</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>

                <button type="submit" class="search-btn"><i class="fas fa-search me-1"></i>Search</button>
                <a href="{{ route('faculty.syllabus') }}" class="clear-btn" style="text-decoration:none;"><i class="fas fa-times me-1"></i>Clear</a>
            </form>
        </div>

        <div class="table-container">
            <div class="table-header"><h3><i class="fas fa-book me-2"></i>Your Syllabus Submissions</h3></div>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-journal-whills me-1"></i>COURSE CODE</th>
                            <th><i class="fas fa-book me-1"></i>COURSE TITLE</th>
                            <th><i class="fas fa-calendar-week me-1"></i>SEMESTER</th>
                            <th><i class="fas fa-calendar me-1"></i>ACADEMIC YEAR</th>
                            <th><i class="fas fa-university me-1"></i>CAMPUS</th>
                            <th><i class="fas fa-building me-1"></i>COLLEGE</th>
                            <th><i class="fas fa-user me-1"></i>INSTRUCTOR</th>
                            <th><i class="fas fa-calendar me-1"></i>SUBMITTED</th>
                            <th><i class="fas fa-comment me-1"></i>COMMENT</th>
                            <th><i class="fas fa-info-circle me-1"></i>STATUS</th>
                            <th><i class="fas fa-cog me-1"></i>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="syllabusTableBody">
                        @forelse ($syllabuses as $syllabus)
                            <tr class="syllabus-row" 
                                data-status="{{ $syllabus->status }}"
                                data-search-text="{{ strtolower($syllabus->id . ' ' . $syllabus->course_code . ' ' . $syllabus->course_title . ' ' . $syllabus->instructor . ' ' . $syllabus->campus . ' ' . $syllabus->college . ' ' . $syllabus->semester . ' ' . $syllabus->academic_year) }}">
                                <td><strong>{{ $syllabus->id }}</strong></td>
                                <td><span class="badge bg-primary"><strong>{{ $syllabus->course_code }}</strong></span></td>
                                <td>{{ $syllabus->course_title }}</td>
                                <td>{{ $syllabus->semester }}</td>
                                <td>{{ $syllabus->academic_year }}</td>
                                <td>{{ $syllabus->campus }}</td>
                                <td>{{ $syllabus->college }}</td>
                                <td><div class="instructor-info">{{ $syllabus->instructor }}</div></td>
                                <td>
                                    <div class="datetime-info">
                                        <div class="date">{{ $syllabus->created_at->setTimezone('Asia/Manila')->format('M d, Y') }}</div>
                                        <div class="time">{{ $syllabus->created_at->setTimezone('Asia/Manila')->format('h:i A') }}</div>
                                    </div>
                                </td>
                                <td>
                                    @if($syllabus->evaluator_comment && trim($syllabus->evaluator_comment) !== '')
                                        <button class="comment-btn" onclick='openCommentModal(@json($syllabus->evaluator_comment))'><i class="fas fa-eye"></i>View Comment</button>
                                    @else
                                        <button class="comment-btn no-comment" disabled><i class="fas fa-minus"></i>None</button>
                                    @endif
                                </td>
                                <td>
                                    @if ($syllabus->status === 'Approved')
                                        <span class="status-badge approved"><i class="fas fa-check-circle"></i>Approved</span>
                                    @elseif ($syllabus->status === 'Returned')
                                        <span class="status-badge returned"><i class="fas fa-exclamation-triangle"></i>Returned</span>
                                    @else
                                        <span class="status-badge pending"><i class="fas fa-clock"></i>Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-links">
                                        @if ($syllabus->status === 'Approved')
                                            <a href="{{ asset('storage/' . $syllabus->file_path) }}" target="_blank" class="action-btn view"><i class="fas fa-eye"></i>View</a>
                                            <a href="{{ route('faculty.syllabus.download', $syllabus->id) }}" class="action-btn download"><i class="fas fa-download"></i>Download</a>
                                        @elseif ($syllabus->status === 'Returned')
                                            <button class="action-btn edit" onclick='openEditModal({{ $syllabus->id }}, @json($syllabus->course_code), @json($syllabus->course_title), @json($syllabus->semester), @json($syllabus->academic_year), @json($syllabus->campus), @json($syllabus->college))'><i class="fas fa-edit"></i>Edit</button>
                                            <a href="{{ route('faculty.syllabus.view', $syllabus->id) }}" target="_blank" class="action-btn view"><i class="fas fa-eye"></i>View</a>
                                        @else
                                            <a href="{{ route('faculty.syllabus.view', $syllabus->id) }}" target="_blank" class="action-btn view"><i class="fas fa-eye"></i>View</a>
                                        @endif

                                        @if ($syllabus->status !== 'Approved')
                                            <button type="button" class="action-btn delete" onclick='openDeleteModal({{ $syllabus->id }}, @json($syllabus->course_code), @json($syllabus->course_title))'><i class="fas fa-trash"></i>Delete</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="empty-state-row">
                                <td colspan="12">
                                    <div class="empty-state">
                                        <i class="fas fa-book"></i>
                                        <h4>No Syllabus Submitted</h4>
                                        <p>You haven't submitted any syllabus documents yet. Click "Submit New Syllabus" to get started.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Controls -->
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

<div id="submitModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-plus-circle"></i>Submit New Syllabus</h3>
            <button class="close-modal" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
        
        <form id="createSyllabusForm" method="POST" action="{{ route('faculty.syllabus.store') }}" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-journal-whills me-1"></i>Course Code *</label>
                            <input type="text" id="create_course_code" name="course_code" class="form-control" required placeholder="e.g., CS 101 or MATH-201" value="{{ old('course_code') }}">
                            <div id="error_create_course_code" class="field-error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-calendar-alt me-1"></i>Semester *</label>
                            <select id="create_semester" name="semester" class="form-control form-select" required>
                                <option value="" disabled {{ old('semester') ? '' : 'selected' }}>Select Semester</option>
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>
                                <option value="Mid Semester">Mid Semester</option>
                            </select>
                            <div id="error_create_semester" class="field-error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-university me-1"></i>Campus *</label>
                            <select id="campus" name="campus" class="form-control form-select" required>
                                <option value="" disabled {{ old('campus') ? '' : 'selected' }}>Select Campus</option>
                                <option value="Caramoan">Caramoan</option>
                                <option value="Goa">Goa</option>
                                <option value="Lagonoy">Lagonoy</option>
                                <option value="Sagnay">Sagnay</option>
                                <option value="Salogon">Salogon</option>
                                <option value="San Jose">San Jose</option>
                                <option value="Tinambac">Tinambac</option>
                            </select>
                            <div id="error_create_campus" class="field-error"></div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-book me-1"></i>Course Title *</label>
                            <input type="text" id="create_course_title" name="course_title" class="form-control" required placeholder="e.g., Data Structures and Algorithms" value="{{ old('course_title') }}">
                            <div id="error_create_course_title" class="field-error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-graduation-cap me-1"></i>Academic Year *</label>
                            <input type="text" id="create_academic_year" name="academic_year" class="form-control" required placeholder="e.g., 2025-2026" value="{{ old('academic_year') }}">
                            <div id="error_create_academic_year" class="field-error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-building me-1"></i>College *</label>
                            <select id="college" name="college" class="form-control form-select" required>
                                <option value="" disabled {{ old('college') ? '' : 'selected' }}>Select College</option>
                            </select>
                            <div id="error_create_college" class="field-error"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-paperclip me-1"></i>Syllabus File *</label>
                    <input type="file" name="file" id="syllabusFileUpload" class="file-upload-input" required accept=".pdf,.doc,.docx">
                    <label for="syllabusFileUpload" id="syllabusFileLabel" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                        <div id="syllabusFileText">
                            <strong>Click to upload your syllabus file</strong><br>
                            <small>Supported formats: PDF, DOC, DOCX (Max: 30MB)</small>
                        </div>
                    </label>
                    <div id="error_create_file" class="field-error"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="modal-btn secondary" onclick="closeModal()"><i class="fas fa-times me-1"></i>Cancel</button>
                <button type="submit" class="modal-btn primary" id="createSubmitBtn" disabled><i class="fas fa-paper-plane me-1"></i>Submit Syllabus</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-edit"></i>Edit Syllabus Submission</h3>
            <button class="close-modal" onclick="closeEditModal()"><i class="fas fa-times"></i></button>
        </div>
        
        <form id="editSyllabusForm" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <div class="modal-body">
                <input type="hidden" id="edit_syllabus_id" name="syllabus_id" value="{{ old('syllabus_id', session('open_edit_id')) }}">
                
                <div class="form-grid">
                    <div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-journal-whills me-1"></i>Course Code *</label>
                            <input type="text" id="edit_course_code" name="course_code" class="form-control" required placeholder="e.g., CS 101 or MATH-201" value="{{ old('course_code') }}">
                            <div id="error_edit_course_code" class="field-error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-calendar-alt me-1"></i>Semester *</label>
                            <select name="semester" id="edit_semester" class="form-control form-select" required>
                                <option value="" disabled>Select Semester</option>
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>
                                <option value="Mid Semester">Mid Semester</option>
                            </select>
                            <div id="error_edit_semester" class="field-error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-university me-1"></i>Campus *</label>
                            <select id="edit_campus" name="campus" class="form-control form-select" required>
                                <option value="" disabled>Select Campus</option>
                                <option value="Caramoan">Caramoan</option>
                                <option value="Goa">Goa</option>
                                <option value="Lagonoy">Lagonoy</option>
                                <option value="Sagnay">Sagnay</option>
                                <option value="Salogon">Salogon</option>
                                <option value="San Jose">San Jose</option>
                                <option value="Tinambac">Tinambac</option>
                            </select>
                            <div id="error_edit_campus" class="field-error"></div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-book me-1"></i>Course Title *</label>
                            <input type="text" id="edit_course_title" name="course_title" class="form-control" required placeholder="e.g., Data Structures and Algorithms" value="{{ old('course_title') }}">
                            <div id="error_edit_course_title" class="field-error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-graduation-cap me-1"></i>Academic Year *</label>
                            <input type="text" id="edit_academic_year" name="academic_year" class="form-control" required placeholder="e.g., 2025-2026" value="{{ old('academic_year') }}">
                            <div id="error_edit_academic_year" class="field-error"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-building me-1"></i>College *</label>
                            <select id="edit_college" name="college" class="form-control form-select" required>
                                <option value="" disabled>Select College</option>
                            </select>
                            <div id="error_edit_college" class="field-error"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-paperclip me-1"></i>Syllabus File (Optional - Leave empty to keep current)</label>
                    <input type="file" name="file" id="editFileUpload" class="file-upload-input" accept=".pdf,.doc,.docx">
                    <label for="editFileUpload" id="editFileLabel" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                        <div id="editFileText">
                            <strong>Click to upload new file (optional)</strong><br>
                            <small>Leave empty to keep existing file. Supported: PDF, DOC, DOCX (Max: 30MB)</small>
                        </div>
                    </label>
                    <div id="error_edit_file" class="field-error"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="modal-btn secondary" onclick="closeEditModal()"><i class="fas fa-times me-1"></i>Cancel</button>
                <button type="submit" class="modal-btn primary" id="editSubmitBtn" disabled><i class="fas fa-save me-1"></i>Update Syllabus</button>
            </div>
        </form>
    </div>
</div>

<div id="commentModal" class="custom-modal">
    <div class="modal-content comment-modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-comment"></i>Comment Details</h3>
            <button class="close-modal" onclick="closeCommentModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p id="commentText" class="comment-text"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-btn secondary" onclick="closeCommentModal()"><i class="fas fa-times me-1"></i>Close</button>
        </div>
    </div>
</div>

<div id="deleteModal" class="custom-modal">
    <div class="modal-content small">
        <div class="modal-header danger">
            <h3 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion</h3>
            <button class="close-modal" onclick="closeDeleteModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="delete-confirmation-text">
                <p>Are you sure you want to delete this syllabus?</p>
                <span class="syllabus-info" id="deleteSyllabusInfo">
                    <div id="deleteCourseCode"></div>
                    <div id="deleteCourseTitle"></div>
                </span>
            </div>
            <div class="delete-warning">
                <i class="fas fa-exclamation-circle"></i>
                <p>This action cannot be undone. All data associated with this syllabus will be permanently deleted.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-btn secondary" onclick="closeDeleteModal()"><i class="fas fa-times me-1"></i>Cancel</button>
            <form id="deleteSyllabusForm" method="POST" style="display:inline; margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-btn danger"><i class="fas fa-trash me-1"></i>Delete</button>
            </form>
        </div>
    </div>
</div>

<div id="helpModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-info-circle"></i>How to Submit</h3>
            <button class="close-modal" onclick="closeHelpModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <div class="ratio ratio-16x9">
                    <video id="helpVideo" class="w-100 h-100" controls preload="metadata" playsinline controlsList="nodownload">
                        <source src="{{ asset('videos/SubmitSyllabusTutorial.mp4') }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                        <a href="{{ asset('videos/SubmitSyllabusTutorial.mp4') }}">Download the video</a>.
                    </video>
                </div>
            </div>

            <div class="abstract-info">
                <h5>Quick summary</h5>
                <ul class="mb-0">
                    <li><small>Click <strong>Submit New Syllabus</strong>.</small></li>
                    <li><small>Fill <strong>Course Code</strong> and <strong>Course Title</strong>.</small></li>
                    <li><small>Select <strong>Semester</strong> and enter <strong>Academic Year</strong> (YYYY-YYYY).</small></li>
                    <li><small>Choose <strong>Campus</strong>, then pick the corresponding <strong>College</strong>.</small></li>
                    <li><small>Upload PDF/DOC/DOCX up to <strong>30MB</strong>.</small></li>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-btn secondary" onclick="closeHelpModal()"><i class="fas fa-times me-1"></i>Close</button>
        </div>
    </div>
</div>

<script>
let deleteSyllabusId = null;

// Route templates
const updateUrlTemplate = "{{ route('faculty.syllabus.update', ['id' => '__ID__']) }}";
const deleteUrlTemplate = "{{ route('faculty.syllabus.delete', ['id' => '__ID__']) }}";

/* Pagination state */
const PAGE_SIZE = 5;
let currentPage = 1;

function openSidebar(){
    const sidebar = document.getElementById("mobileSidebar");
    const vw = window.innerWidth || document.documentElement.clientWidth;
    const targetWidth = vw <= 480 ? Math.min(280, Math.floor(vw * 0.85)) : Math.min(260, Math.floor(vw * 0.90));
    sidebar.style.width = targetWidth + "px";
    sidebar.classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeSidebar(){
    const sidebar = document.getElementById("mobileSidebar");
    sidebar.classList.remove('open');
    sidebar.style.width = "0";
    document.body.style.overflow = 'auto';
}

function initFlashAutoHide(id, delayMs){
    const el = document.getElementById(id);
    if(!el) return;
    requestAnimationFrame(()=> el.classList.add('show'));
    const remove = () => {
        el.classList.remove('show');
        setTimeout(()=> { if(el && el.parentNode){ el.parentNode.removeChild(el); } }, 250);
    };
    const closeBtn = el.querySelector('[data-close]');
    if(closeBtn){ closeBtn.addEventListener('click', remove); }
    setTimeout(remove, delayMs || 2500);
}

function showLogoutModal(){ document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
function closeLogoutModal(){ document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = 'auto'; }
function closeModalOnOverlay(event){ if (event.target.id === 'logoutModal') closeLogoutModal(); }
function confirmLogout(){ document.getElementById('logoutForm').submit(); }

function openModal(){ document.getElementById("submitModal").style.display = "flex"; document.body.style.overflow = 'hidden'; }
function closeModal(){
    document.getElementById("submitModal").style.display = "none";
    document.body.style.overflow = 'auto';
    const form = document.querySelector('#createSyllabusForm'); if (form) form.reset();
    document.getElementById("syllabusFileText").innerHTML = '<strong>Click to upload your syllabus file</strong><br><small>Supported formats: PDF, DOC, DOCX (Max: 30MB)</small>';
    document.getElementById("syllabusFileLabel").classList.remove('has-file','error','success');
    document.getElementById("college").innerHTML = '<option value="" disabled selected>Select College</option>';
    clearCreateErrors(); updateCreateSubmitState();
}

function openEditModal(id, courseCode, courseTitle, semester, academicYear, campus, college) {
    document.getElementById('edit_syllabus_id').value = id;
    document.getElementById('edit_course_code').value = courseCode;
    document.getElementById('edit_course_title').value = courseTitle;
    document.getElementById('edit_semester').value = semester;
    document.getElementById('edit_academic_year').value = academicYear;
    document.getElementById('edit_campus').value = campus;
    populateEditCollegeDropdown(campus, college);
    document.getElementById('editSyllabusForm').action = updateUrlTemplate.replace('__ID__', id);

    validateEditForm(false);
    document.getElementById('editModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeEditModal(){
    document.getElementById('editModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    document.getElementById('editSyllabusForm').reset();
    document.getElementById('editFileText').innerHTML = '<strong>Click to upload new file (optional)</strong><br><small>Leave empty to keep existing file. Supported: PDF, DOC, DOCX (Max: 30MB)</small>';
    document.getElementById('editFileLabel').classList.remove('has-file','error','success');
    document.getElementById('edit_college').innerHTML = '<option value="" disabled selected>Select College</option>';
    clearEditErrors(); updateEditSubmitState();
}

function openCommentModal(comment){
    const commentText = document.getElementById("commentText");
    if (comment && comment.trim() !== '') { commentText.textContent = comment; commentText.classList.remove('no-comment-text'); }
    else { commentText.textContent = 'No comment available.'; commentText.classList.add('no-comment-text'); }
    document.getElementById("commentModal").style.display = "flex"; document.body.style.overflow = 'hidden';
}
function closeCommentModal(){ document.getElementById("commentModal").style.display = "none"; document.body.style.overflow = 'auto'; }

function openDeleteModal(syllabusId, courseCode, courseTitle){
    deleteSyllabusId = syllabusId;
    document.getElementById("deleteCourseCode").innerHTML = '<strong>Course Code:</strong> ' + escapeHtml(courseCode);
    document.getElementById("deleteCourseTitle").innerHTML = '<strong>Course Title:</strong> ' + escapeHtml(courseTitle);
    document.getElementById("deleteSyllabusForm").action = deleteUrlTemplate.replace('__ID__', syllabusId);
    document.getElementById("deleteModal").style.display = "flex";
    document.body.style.overflow = 'hidden';
}
function closeDeleteModal(){ document.getElementById("deleteModal").style.display = "none"; document.body.style.overflow = 'auto'; deleteSyllabusId = null; }

function openHelpModal(){
    const m = document.getElementById('helpModal');
    if (m) { m.style.display = 'flex'; document.body.style.overflow = 'hidden'; }
}
function closeHelpModal(){
    const m = document.getElementById('helpModal');
    if (m) { m.style.display = 'none'; document.body.style.overflow = 'auto'; }
    const media = document.getElementById('helpVideo');
    if (!media) return;
    const tag = media.tagName.toLowerCase();
    if (tag === 'video') { media.pause(); media.currentTime = 0; }
    else if (tag === 'iframe') { media.src = media.src; }
}

const colleges = {
    "Caramoan": ["College of Sustainable Communities and Ecosystems (CAR)"],
    "Goa": [
        "College of Arts and Humanities (CAH)",
        "College of Business and Management (CBM)",
        "College of Education (CED)",
        "College of Engineering and Computational Science (CEC)",
        "College of Sciences (COS)"
    ],
    "Lagonoy": ["College of Public Safety and Community Health (LAG)"],
    "Sagnay": ["College of Fisheries and Marine Science (SAG)"],
    "Salogon": ["College of Agribusiness and Community Development (SAL)"],
    "San Jose": ["College of Hospitality and Tourism Management (SAN)"],
    "Tinambac": ["College of Environmental Science and Design (TIN)"]
};

document.getElementById("campus").addEventListener("change", function() {
    const campus = this.value;
    const collegeDropdown = document.getElementById("college");
    collegeDropdown.innerHTML = '<option value="" disabled selected>Select College</option>';
    if (campus && colleges[campus]) {
        colleges[campus].forEach(function(college) {
            const option = document.createElement("option");
            option.value = college;
            option.textContent = college;
            collegeDropdown.appendChild(option);
        });
    }
    validateCreateCampus(); validateCreateCollege();
});

document.getElementById("edit_campus").addEventListener("change", function() {
    const campus = this.value;
    const collegeDropdown = document.getElementById("edit_college");
    collegeDropdown.innerHTML = '<option value="" disabled selected>Select College</option>';
    if (campus && colleges[campus]) {
        colleges[campus].forEach(function(college) {
            const option = document.createElement("option");
            option.value = college;
            option.textContent = college;
            collegeDropdown.appendChild(option);
        });
    }
    validateEditCampus(); validateEditCollege();
});

function populateEditCollegeDropdown(campus, selectedCollege) {
    const collegeDropdown = document.getElementById("edit_college");
    collegeDropdown.innerHTML = '<option value="" disabled>Select College</option>';
    if (campus && colleges[campus]) {
        colleges[campus].forEach(function(college) {
            const option = document.createElement("option");
            option.value = college;
            option.textContent = college;
            if (college === selectedCollege) option.selected = true;
            collegeDropdown.appendChild(option);
        });
    }
}

document.getElementById("syllabusFileUpload").addEventListener("change", function() {
    const file = this.files[0];
    const fileText = document.getElementById("syllabusFileText");
    const fileLabel = document.getElementById("syllabusFileLabel");
    if (file) {
        let name = file.name; if (name.length > 40) name = name.substring(0,37) + "...";
        fileText.innerHTML = `<strong>${escapeHtml(name)}</strong><br><small>File selected successfully</small>`;
        fileLabel.classList.add('has-file');
    } else {
        fileText.innerHTML = '<strong>Click to upload your syllabus file</strong><br><small>Supported formats: PDF, DOC, DOCX (Max: 30MB)</small>';
        fileLabel.classList.remove('has-file','error','success');
    }
    validateCreateFile(); updateCreateSubmitState();
});

document.getElementById("editFileUpload").addEventListener("change", function() {
    const file = this.files[0];
    const fileText = document.getElementById("editFileText");
    const fileLabel = document.getElementById("editFileLabel");
    if (file) {
        let name = file.name; if (name.length > 40) name = name.substring(0,37) + "...";
        fileText.innerHTML = `<strong>${escapeHtml(name)}</strong><br><small>New file selected</small>`;
        fileLabel.classList.add('has-file');
    } else {
        fileText.innerHTML = '<strong>Click to upload new file (optional)</strong><br><small>Leave empty to keep existing file. Supported: PDF, DOC, DOCX (Max: 30MB)</small>';
        fileLabel.classList.remove('has-file','error','success');
    }
    validateEditFile(); updateEditSubmitState();
});

const MAX_FILE_BYTES = 30 * 1024 * 1024;
const ALLOWED_EXTS = ['pdf','doc','docx'];
const CODE_REGEX = /^[A-Za-z]{2,10}(?:[ -]?\d{1,4})(?:[A-Za-z0-9-]{0,4})?$/;

function getExt(name){ const parts = (name || '').toLowerCase().split('.'); return parts.length > 1 ? parts.pop() : ''; }
function showError(el, errorId, message){
    if (el) { el.classList.remove('input-valid'); el.classList.add('input-invalid'); el.setAttribute('aria-invalid', 'true'); }
    const err = document.getElementById(errorId); if (err) { err.textContent = message; err.style.display = 'block'; }
}
function clearError(el, errorId){
    if (el) { el.classList.remove('input-invalid'); el.classList.add('input-valid'); el.setAttribute('aria-invalid', 'false'); }
    const err = document.getElementById(errorId); if (err) { err.textContent = ''; err.style.display = 'none'; }
}
function neutral(el, errorId){
    if (el) { el.classList.remove('input-invalid','input-valid'); el.removeAttribute('aria-invalid'); }
    const err = document.getElementById(errorId); if (err) { err.textContent = ''; err.style.display = 'none'; }
}
function hasVeryLongLettersToken(text){ return /[A-Za-z]{30,}/.test(text || ''); }

function validateCreateCourseCode(show=true){
    const el = document.getElementById('create_course_code');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_create_course_code', 'Please enter the course code.'); return false; }
    if (!/[A-Za-z]/.test(val) || !/\d/.test(val)) { if(show) showError(el, 'error_create_course_code', 'Course code must include letters and numbers.'); return false; }
    if (!CODE_REGEX.test(val)) { if(show) showError(el, 'error_create_course_code', 'Use a code like ABC 123 or ABC-123.'); return false; }
    if (show) clearError(el, 'error_create_course_code'); else neutral(el, 'error_create_course_code');
    return true;
}
function validateCreateCourseTitle(show=true){
    const el = document.getElementById('create_course_title');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_create_course_title', 'Please enter the course title.'); return false; }
    if (!/[A-Za-z]/.test(val)) { if(show) showError(el, 'error_create_course_title', 'Course title must contain letters.'); return false; }
    if (hasVeryLongLettersToken(val)) { if(show) showError(el, 'error_create_course_title', 'Avoid very long unbroken letter sequences.'); return false; }
    if (show) clearError(el, 'error_create_course_title'); else neutral(el, 'error_create_course_title');
    return true;
}
function validateCreateSemester(show=true){
    const el = document.getElementById('create_semester');
    const val = el.value;
    if (!val) { if(show) showError(el, 'error_create_semester', 'Please select a semester.'); return false; }
    if (show) clearError(el, 'error_create_semester'); else neutral(el, 'error_create_semester');
    return true;
}
function validateAYFormat(ay){ return /^\d{4}-\d{4}$/.test(ay); }
function validateAYConsecutive(ay){ if (!validateAYFormat(ay)) return false; const [y1,y2] = ay.split('-').map(Number); return y2 === y1 + 1; }
function validateCreateAcademicYear(show=true){
    const el = document.getElementById('create_academic_year');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_create_academic_year', 'Please enter the academic year.'); return false; }
    if (!validateAYFormat(val)) { if(show) showError(el, 'error_create_academic_year', 'Format must be YYYY-YYYY (numbers only).'); return false; }
    if (!validateAYConsecutive(val)) { if(show) showError(el, 'error_create_academic_year', 'Academic years must be consecutive (e.g., 2025-2026).'); return false; }
    const startYear = parseInt(val.split('-')[0], 10);
    if (isNaN(startYear) || startYear < 2025) { if(show) showError(el, 'error_create_academic_year', 'Academic year must start from 2025 or later.'); return false; }
    if (show) clearError(el, 'error_create_academic_year'); else neutral(el, 'error_create_academic_year');
    return true;
}
function validateCreateCampus(show=true){
    const el = document.getElementById('campus');
    const val = el.value;
    if (!val) { if(show) showError(el, 'error_create_campus', 'Please select a campus.'); return false; }
    if (!colleges[val]) { if(show) showError(el, 'error_create_campus', 'Please select a valid campus.'); return false; }
    if (show) clearError(el, 'error_create_campus'); else neutral(el, 'error_create_campus');
    return true;
}
function validateCreateCollege(show=true){
    const campusEl = document.getElementById('campus');
    const colEl = document.getElementById('college');
    const campus = campusEl.value;
    const val = colEl.value;
    if (!val) { if(show) showError(colEl, 'error_create_college', 'Please select a college.'); return false; }
    if (!colleges[campus] || !colleges[campus].includes(val)) { if(show) showError(colEl, 'error_create_college', 'Please select a valid college for the campus.'); return false; }
    if (show) clearError(colEl, 'error_create_college'); else neutral(colEl, 'error_create_college');
    return true;
}
function validateCreateFile(show=true){
    const input = document.getElementById('syllabusFileUpload');
    const label = document.getElementById('syllabusFileLabel');
    const errId = 'error_create_file';
    label.classList.remove('error','success');
    const file = input.files && input.files[0];
    if (!file) { if(show) { showError(null, errId, 'Please upload your syllabus file.'); label.classList.add('error'); } return false; }
    const ext = getExt(file.name);
    if (!ALLOWED_EXTS.includes(ext)) { if(show) { showError(null, errId, 'File must be a PDF, DOC, or DOCX.'); label.classList.add('error'); } return false; }
    if (file.size > MAX_FILE_BYTES) { if(show) { showError(null, errId, 'File size must not exceed 30MB.'); label.classList.add('error'); } return false; }
    if (show) { clearError(null, errId); label.classList.add('success'); } else { const e = document.getElementById(errId); if(e){ e.style.display='none'; e.textContent=''; } }
    return true;
}
function isCreateFormValid(){
    return validateCreateCourseCode(false) && validateCreateCourseTitle(false) && validateCreateSemester(false) &&
           validateCreateAcademicYear(false) && validateCreateCampus(false) && validateCreateCollege(false) &&
           validateCreateFile(false);
}
function updateCreateSubmitState(){ const btn = document.getElementById('createSubmitBtn'); if (btn) btn.disabled = !isCreateFormValid(); }
function clearCreateErrors(){
    ['error_create_course_code','error_create_course_title','error_create_semester','error_create_academic_year','error_create_campus','error_create_college','error_create_file'].forEach(id=>{
        const n = document.getElementById(id); if(n){ n.textContent=''; n.style.display='none'; }
    });
    ['create_course_code','create_course_title','create_semester','create_academic_year','campus','college'].forEach(id=>{
        const el = document.getElementById(id); if(el){ el.classList.remove('input-invalid','input-valid'); el.removeAttribute('aria-invalid'); }
    });
}

function validateEditCourseCode(show=true){
    const el = document.getElementById('edit_course_code');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_edit_course_code', 'Please enter the course code.'); return false; }
    if (!/[A-Za-z]/.test(val) || !/\d/.test(val)) { if(show) showError(el, 'error_edit_course_code', 'Course code must include letters and numbers.'); return false; }
    if (!CODE_REGEX.test(val)) { if(show) showError(el, 'error_edit_course_code', 'Use a code like ABC 123 or ABC-123.'); return false; }
    if (show) clearError(el, 'error_edit_course_code'); else neutral(el, 'error_edit_course_code');
    return true;
}
function validateEditCourseTitle(show=true){
    const el = document.getElementById('edit_course_title');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_edit_course_title', 'Please enter the course title.'); return false; }
    if (!/[A-Za-z]/.test(val)) { if(show) showError(el, 'error_edit_course_title', 'Course title must contain letters.'); return false; }
    if (hasVeryLongLettersToken(val)) { if(show) showError(el, 'error_edit_course_title', 'Avoid very long unbroken letter sequences.'); return false; }
    if (show) clearError(el, 'error_edit_course_title'); else neutral(el, 'error_edit_course_title');
    return true;
}
function validateEditSemester(show=true){
    const el = document.getElementById('edit_semester');
    const val = el.value;
    if (!val) { if(show) showError(el, 'error_edit_semester', 'Please select a semester.'); return false; }
    if (show) clearError(el, 'error_edit_semester'); else neutral(el, 'error_edit_semester');
    return true;
}
function validateEditAcademicYear(show=true){
    const el = document.getElementById('edit_academic_year');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_edit_academic_year', 'Please enter the academic year.'); return false; }
    if (!validateAYFormat(val)) { if(show) showError(el, 'error_edit_academic_year', 'Format must be YYYY-YYYY (numbers only).'); return false; }
    if (!validateAYConsecutive(val)) { if(show) showError(el, 'error_edit_academic_year', 'Academic years must be consecutive (e.g., 2025-2026).'); return false; }
    const startYear = parseInt(val.split('-')[0], 10);
    if (isNaN(startYear) || startYear < 2025) { if(show) showError(el, 'error_edit_academic_year', 'Academic year must start from 2025 or later.'); return false; }
    if (show) clearError(el, 'error_edit_academic_year'); else neutral(el, 'error_edit_academic_year');
    return true;
}
function validateEditCampus(show=true){
    const el = document.getElementById('edit_campus');
    const val = el.value;
    if (!val) { if(show) showError(el, 'error_edit_campus', 'Please select a campus.'); return false; }
    if (!colleges[val]) { if(show) showError(el, 'error_edit_campus', 'Please select a valid campus.'); return false; }
    if (show) clearError(el, 'error_edit_campus'); else neutral(el, 'error_edit_campus');
    return true;
}
function validateEditCollege(show=true){
    const campusEl = document.getElementById('edit_campus');
    const colEl = document.getElementById('edit_college');
    const campus = campusEl.value;
    const val = colEl.value;
    if (!val) { if(show) showError(colEl, 'error_edit_college', 'Please select a college.'); return false; }
    if (!colleges[campus] || !colleges[campus].includes(val)) { if(show) showError(colEl, 'error_edit_college', 'Please select a valid college for the campus.'); return false; }
    if (show) clearError(colEl, 'error_edit_college'); else neutral(colEl, 'error_edit_college');
    return true;
}
function validateEditFile(show=true){
    const input = document.getElementById('editFileUpload');
    const label = document.getElementById('editFileLabel');
    const errId = 'error_edit_file';
    label.classList.remove('error','success');
    const file = input.files && input.files[0];
    if (!file) { const e = document.getElementById(errId); if (e){ e.textContent=''; e.style.display='none'; } return true; }
    const ext = getExt(file.name);
    if (!ALLOWED_EXTS.includes(ext)) { if(show) { showError(null, errId, 'File must be a PDF, DOC, or DOCX.'); label.classList.add('error'); } return false; }
    if (file.size > MAX_FILE_BYTES) { if(show) { showError(null, errId, 'File size must not exceed 30MB.'); label.classList.add('error'); } return false; }
    if (show) { clearError(null, errId); label.classList.add('success'); } else { const e = document.getElementById(errId); if(e){ e.style.display='none'; e.textContent=''; } }
    return true;
}
function isEditFormValid(){
    return validateEditCourseCode(false) && validateEditCourseTitle(false) && validateEditSemester(false) &&
           validateEditAcademicYear(false) && validateEditCampus(false) && validateEditCollege(false) &&
           validateEditFile(false);
}
function updateEditSubmitState(){ const btn = document.getElementById('editSubmitBtn'); if (btn) btn.disabled = !isEditFormValid(); }
function clearEditErrors(){
    ['error_edit_course_code','error_edit_course_title','error_edit_semester','error_edit_academic_year','error_edit_campus','error_edit_college','error_edit_file'].forEach(id=>{
        const n = document.getElementById(id); if(n){ n.textContent=''; n.style.display='none'; }
    });
    ['edit_course_code','edit_course_title','edit_semester','edit_academic_year','edit_campus','edit_college'].forEach(id=>{
        const el = document.getElementById(id); if(el){ el.classList.remove('input-invalid','input-valid'); el.removeAttribute('aria-invalid'); }
    });
}

function validateEditForm(show=true){
    validateEditCourseCode(show);
    validateEditCourseTitle(show);
    validateEditSemester(show);
    validateEditAcademicYear(show);
    validateEditCampus(show);
    validateEditCollege(show);
    validateEditFile(show);
}

function showDynamicAlert(type, message) {
    const existing = document.querySelectorAll('.flash-alert');
    existing.forEach(el => {
        el.classList.remove('show');
        setTimeout(()=> el.remove(), 250);
    });
    const alertDiv = document.createElement('div');
    alertDiv.className = `flash-alert ${type}`;
    alertDiv.setAttribute('role', 'alert');
    alertDiv.setAttribute('aria-live', type === 'danger' ? 'assertive' : 'polite');
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
    alertDiv.innerHTML = `
        <i class="fas ${icon}"></i>
        <span class="message">${escapeHtml(message)}</span>
        <button type="button" class="close" data-close aria-label="Dismiss"><i class="fas fa-times"></i></button>
    `;
    document.body.appendChild(alertDiv);
    requestAnimationFrame(() => alertDiv.classList.add('show'));
    const closeBtn = alertDiv.querySelector('[data-close]');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 250);
        });
    }
    setTimeout(() => {
        alertDiv.classList.remove('show');
        setTimeout(() => alertDiv.remove(), 250);
    }, type === 'success' ? 2500 : 3500);
}

function displayAjaxErrors(errors) {
    clearCreateErrors();
    Object.keys(errors).forEach(field => {
        const errorMessages = errors[field];
        const errorId = `error_create_${field}`;
        const inputId = `create_${field}`;
        if (field === 'file') {
            const errorEl = document.getElementById('error_create_file');
            const label = document.getElementById('syllabusFileLabel');
            if (errorEl) { errorEl.textContent = errorMessages[0]; errorEl.style.display = 'block'; }
            if (label) { label.classList.add('error'); }
        } else {
            const inputEl = document.getElementById(inputId);
            const errorEl = document.getElementById(errorId);
            if (inputEl) {
                inputEl.classList.add('input-invalid');
                inputEl.classList.remove('input-valid');
                inputEl.setAttribute('aria-invalid', 'true');
            }
            if (errorEl) { errorEl.textContent = errorMessages[0]; errorEl.style.display = 'block'; }
        }
    });
    const firstError = document.querySelector('#submitModal .field-error[style*="block"]');
    if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function addSyllabusToTable(s) {
    const tbody = document.getElementById('syllabusTableBody');
    const emptyRow = document.getElementById('empty-state-row');
    if (emptyRow) emptyRow.remove();

    const tr = document.createElement('tr');
    tr.id = `syllabus-row-${s.id}`;
    tr.className = 'syllabus-row';
    tr.innerHTML = `
        <td><strong>${s.id}</strong></td>
        <td><span class="badge bg-primary"><strong>${escapeHtml(s.course_code)}</strong></span></td>
        <td>${escapeHtml(s.course_title)}</td>
        <td>${escapeHtml(s.semester)}</td>
        <td>${escapeHtml(s.academic_year)}</td>
        <td>${escapeHtml(s.campus)}</td>
        <td>${escapeHtml(s.college)}</td>
        <td><div class="instructor-info">${escapeHtml(s.instructor)}</div></td>
        <td>
            <div class="datetime-info">
                <div class="date">${s.created_at}</div>
                <div class="time">${s.created_time}</div>
            </div>
        </td>
        <td><button class="comment-btn no-comment" disabled><i class="fas fa-minus"></i>None</button></td>
        <td><span class="status-badge pending"><i class="fas fa-clock"></i>Pending</span></td>
        <td>
            <div class="action-links">
                <a href="${s.view_url}" target="_blank" class="action-btn view"><i class="fas fa-eye"></i>View</a>
                <button type="button" class="action-btn delete" onclick="openDeleteModal(${s.id}, '${escapeHtml(s.course_code)}', '${escapeHtml(s.course_title)}')"><i class="fas fa-trash"></i>Delete</button>
            </div>
        </td>
    `;
    tbody.prepend(tr);

    currentPage = 1;
    applyPagination();
}

function removeSyllabusRowById(id) {
    const row = document.getElementById(`syllabus-row-${id}`);
    if (row) row.remove();

    const tbody = document.getElementById('syllabusTableBody');
    const hasRows = !!tbody.querySelector('.syllabus-row');
    if (!hasRows) {
        const tr = document.createElement('tr');
        tr.id = 'empty-state-row';
        tr.innerHTML = `
            <td colspan="12">
                <div class="empty-state">
                    <i class="fas fa-book"></i>
                    <h4>No Syllabus Submitted</h4>
                    <p>You haven't submitted any syllabus documents yet. Click "Submit New Syllabus" to get started.</p>
                </div>
            </td>
        `;
        tbody.appendChild(tr);
    }
    applyPagination();
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text ?? '';
    return div.innerHTML;
}

/* Pagination only (no live search) */
function applyPagination(){
    const rows = Array.from(document.querySelectorAll('.syllabus-row'));
    const total = rows.length;
    const totalPages = Math.max(1, Math.ceil(total / PAGE_SIZE));
    if (currentPage > totalPages) currentPage = totalPages;

    if (total === 0) {
        updatePaginationControls(0, 1, 1);
        const container = document.getElementById('paginationContainer');
        if (container) container.style.display = 'none';
        return;
    }

    rows.forEach(r => { r.style.display = 'none'; });
    const startIdx = (currentPage - 1) * PAGE_SIZE;
    rows.slice(startIdx, startIdx + PAGE_SIZE).forEach(r => { r.style.display = ''; });
    updatePaginationControls(total, currentPage, totalPages);
}
function getPaginationItems(totalPages, currentPage){
    const items=[];
    if(totalPages <= 7){ for(let i=1;i<=totalPages;i++) items.push(i); return items; }
    if(currentPage <= 4){ items.push(1,2,3,4,5,'...', totalPages); return items; }
    if(currentPage >= totalPages - 3){ items.push(1,'...', totalPages-4,totalPages-3,totalPages-2,totalPages-1,totalPages); return items; }
    items.push(1,'...', currentPage-1,currentPage,currentPage+1,'...', totalPages);
    return items;
}
function updatePaginationControls(total, page, totalPages){
    const container = document.getElementById('paginationContainer');
    const prevBtn = document.getElementById('prevPageBtn');
    const nextBtn = document.getElementById('nextPageBtn');
    const pagesEl = document.getElementById('paginationPages');
    if(!container || !prevBtn || !nextBtn || !pagesEl) return;

    if(total===0 || total<=PAGE_SIZE){
        container.style.display='none';
        return;
    }
    container.style.display='flex';
    prevBtn.disabled = page<=1;
    nextBtn.disabled = page>=totalPages;

    pagesEl.innerHTML='';
    const items = getPaginationItems(totalPages, page);
    items.forEach(item=>{
        if(item==='...'){
            const ell=document.createElement('span');
            ell.className='page-ellipsis';
            ell.textContent='...';
            pagesEl.appendChild(ell);
        }else{
            const btn=document.createElement('button');
            btn.type='button';
            btn.className='page-number' + (item===page ? ' active' : '');
            btn.dataset.page=String(item);
            btn.textContent=String(item);
            pagesEl.appendChild(btn);
        }
    });
}

document.addEventListener('DOMContentLoaded', function(){
    initFlashAutoHide('flashSuccess', 2500);
    initFlashAutoHide('flashError', 3500);

    ['submitModal','editModal','commentModal','deleteModal','helpModal'].forEach(id=>{
        const el = document.getElementById(id);
        if (el) el.addEventListener('click', function(event){ if (event.target === this) { if (id==='submitModal') closeModal(); if (id==='editModal') closeEditModal(); if (id==='commentModal') closeCommentModal(); if (id==='deleteModal') closeDeleteModal(); if (id==='helpModal') closeHelpModal(); } });
    });

    document.addEventListener('keydown', function(event){
        if (event.key === 'Escape') {
            closeModal(); closeEditModal(); closeCommentModal(); closeDeleteModal(); closeSidebar(); closeLogoutModal(); closeHelpModal();
            ['flashSuccess','flashError'].forEach(id=>{ const el=document.getElementById(id); if(el){ el.classList.remove('show'); setTimeout(()=>{ if(el.parentNode){ el.parentNode.removeChild(el); } },200); } });
        }
    });

    let resizeTimeout;
    window.addEventListener('resize', function(){
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function(){ if (window.innerWidth >= 992) closeSidebar(); }, 250);
    });

    const deleteForm = document.getElementById('deleteSyllabusForm');
    if (deleteForm) {
      deleteForm.addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
          submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Deleting...';
          submitBtn.disabled = true;
        }
      });
    }

    const createForm = document.getElementById('createSyllabusForm');
    if (createForm) {
        const cCode = document.getElementById('create_course_code');
        const cTitle = document.getElementById('create_course_title');
        const cSem = document.getElementById('create_semester');
        const cAY = document.getElementById('create_academic_year');
        const cCampus = document.getElementById('campus');
        const cCollege = document.getElementById('college');
        const cFile = document.getElementById('syllabusFileUpload');

        ['input','blur'].forEach(evt => {
            cCode.addEventListener(evt, ()=> { validateCreateCourseCode(evt==='blur'); updateCreateSubmitState(); });
            cTitle.addEventListener(evt, ()=> { validateCreateCourseTitle(evt==='blur'); updateCreateSubmitState(); });
            cAY.addEventListener(evt, ()=> { validateCreateAcademicYear(evt==='blur'); updateCreateSubmitState(); });
        });
        cSem.addEventListener('change', ()=> { validateCreateSemester(true); updateCreateSubmitState(); });
        cCampus.addEventListener('change', ()=> { validateCreateCampus(true); validateCreateCollege(true); updateCreateSubmitState(); });
        cCollege.addEventListener('change', ()=> { validateCreateCollege(true); updateCreateSubmitState(); });
        cFile.addEventListener('change', ()=> { validateCreateFile(true); updateCreateSubmitState(); });

        const oldCampus = @json(old('campus'));
        const oldCollege = @json(old('college'));
        const oldSemester = @json(old('semester'));
        if (oldCampus) {
            cCampus.value = oldCampus;
            cCampus.dispatchEvent(new Event('change'));
            if (oldCollege) cCollege.value = oldCollege;
        }
        if (oldSemester) cSem.value = oldSemester;

        const activeForm = @json(session('active_form'));
        if (activeForm === 'create') {
            openModal();
            validateCreateCourseCode(true); validateCreateCourseTitle(true); validateCreateSemester(true);
            validateCreateAcademicYear(true); validateCreateCampus(true); validateCreateCollege(true); validateCreateFile(true);
            updateCreateSubmitState();
        }

        createForm.addEventListener('submit', function(e){
            e.preventDefault();
            const ok = validateCreateCourseCode(true) & validateCreateCourseTitle(true) & validateCreateSemester(true) &
                       validateCreateAcademicYear(true) & validateCreateCampus(true) & validateCreateCollege(true) & validateCreateFile(true);
            if (!ok) {
                const submitBtn = document.getElementById('createSubmitBtn'); if (submitBtn) submitBtn.disabled = true;
                const firstErr = document.querySelector('#submitModal .field-error[style*="block"]'); if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            const submitBtn = document.getElementById('createSubmitBtn');
            if (submitBtn) { submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Submitting...'; submitBtn.disabled = true; }

            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    closeModal();
                    addSyllabusToTable(data.syllabus);
                    showDynamicAlert('success', data.message || 'Syllabus submitted successfully.');
                } else if (data.errors) {
                    displayAjaxErrors(data.errors);
                } else {
                    showDynamicAlert('danger', data.message || 'Submission failed.');
                }
            })
            .catch(() => showDynamicAlert('danger', 'An error occurred while submitting the syllabus.'))
            .finally(() => {
                if (submitBtn) { submitBtn.innerHTML = '<i class="fas fa-paper-plane me-1"></i>Submit Syllabus'; submitBtn.disabled = false; }
            });
        });

        updateCreateSubmitState();
    }

    const editForm = document.getElementById('editSyllabusForm');
    if (editForm) {
        const eCode = document.getElementById('edit_course_code');
        const eTitle = document.getElementById('edit_course_title');
        const eSem = document.getElementById('edit_semester');
        const eAY = document.getElementById('edit_academic_year');
        const eCampus = document.getElementById('edit_campus');
        const eCollege = document.getElementById('edit_college');
        const eFile = document.getElementById('editFileUpload');

        ['input','blur'].forEach(evt => {
            eCode.addEventListener(evt, ()=> { validateEditCourseCode(evt==='blur'); updateEditSubmitState(); });
            eTitle.addEventListener(evt, ()=> { validateEditCourseTitle(evt==='blur'); updateEditSubmitState(); });
            eAY.addEventListener(evt, ()=> { validateEditAcademicYear(evt==='blur'); updateEditSubmitState(); });
        });
        eSem.addEventListener('change', ()=> { validateEditSemester(true); updateEditSubmitState(); });
        eCampus.addEventListener('change', ()=> { validateEditCampus(true); validateEditCollege(true); updateEditSubmitState(); });
        eCollege.addEventListener('change', ()=> { validateEditCollege(true); updateEditSubmitState(); });
        eFile.addEventListener('change', ()=> { validateEditFile(true); updateEditSubmitState(); });

        const activeForm = @json(session('active_form'));
        const openEditId = @json(session('open_edit_id'));
        const oldEditCampus = @json(old('campus'));
        const oldEditCollege = @json(old('college'));
        const oldEditSemester = @json(old('semester'));
        if (activeForm === 'edit') {
            if (openEditId) {
                editForm.action = updateUrlTemplate.replace('__ID__', openEditId);
                document.getElementById('edit_syllabus_id').value = openEditId;
            }
            if (oldEditCampus) {
                eCampus.value = oldEditCampus;
                populateEditCollegeDropdown(oldEditCampus, oldEditCollege || '');
            }
            if (oldEditSemester) eSem.value = oldEditSemester;

            validateEditForm(true);
            updateEditSubmitState();
            document.getElementById('editModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        editForm.addEventListener('submit', function(e){
            const ok = validateEditCourseCode(true) & validateEditCourseTitle(true) & validateEditSemester(true) &
                       validateEditAcademicYear(true) & validateEditCampus(true) & validateEditCollege(true) & validateEditFile(true);
            if (!ok) {
                e.preventDefault();
                const submitBtn = document.getElementById('editSubmitBtn'); if (submitBtn) submitBtn.disabled = true;
                const firstErr = document.querySelector('#editModal .field-error[style*="block"]'); if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            }
            const submitBtn = document.getElementById('editSubmitBtn');
            if (submitBtn) { submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Updating...'; submitBtn.disabled = true; }
            return true;
        });
        updateEditSubmitState();
    }

    const prevBtn = document.getElementById('prevPageBtn');
    const nextBtn = document.getElementById('nextPageBtn');
    if(prevBtn){ prevBtn.addEventListener('click', function(){ if(currentPage>1){ currentPage--; applyPagination(); } }); }
    if(nextBtn){ nextBtn.addEventListener('click', function(){ currentPage++; applyPagination(); }); }
    const pagesEl = document.getElementById('paginationPages');
    if(pagesEl){
        pagesEl.addEventListener('click', function(e){
            const btn = e.target.closest('.page-number');
            if(!btn || !btn.dataset.page) return;
            const newPage = parseInt(btn.dataset.page, 10);
            if(!isNaN(newPage) && newPage !== currentPage){
                currentPage = newPage;
                applyPagination();
            }
        });
    }

    applyPagination();
});
</script>

<script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
