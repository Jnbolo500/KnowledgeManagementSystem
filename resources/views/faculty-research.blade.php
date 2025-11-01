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
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; color: #333; }

        /* NAV */
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

        /* MOBILE SIDEBAR */
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

        /* LOGOUT MODAL */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(4px); z-index: 2000; align-items: center; justify-content: center; animation: fadeIn 0.3s ease; }
        .modal-overlay.active { display: flex; }
        .logout-modal { background: white; border-radius: var(--border-radius); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); max-width: 450px; width: 90%; overflow: hidden; animation: slideIn 0.3s ease; position: relative; }
        .logout-modal .modal-header { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; padding: 1.5rem 2rem; display: flex; align-items: center; gap: 1rem; }
        .logout-modal .modal-header i { font-size: 2rem; }
        .modal-header-content h3 { margin: 0; font-size: 1.3rem; font-weight: 600; }
        .modal-header-content p { margin: 0.25rem 0 0 0; font-size: 0.9rem; opacity: 0.9; }

        /* MAIN */
        .main-container { padding: 2rem 0; }
        .page-header { text-align: center; margin-bottom: 2rem; padding: 0 1rem; }
        .page-title { font-size: 2.5rem; font-weight: 700; color: var(--primary-blue); margin-bottom: 0.5rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .page-subtitle { font-size: 1.1rem; color: var(--dark-gray); font-weight: 400; }

        .action-bar { background: white; border-radius: var(--border-radius); box-shadow: var(--shadow); padding: 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .submit-btn { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color: white; border: none; padding: 12px 24px; border-radius: 25px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: var(--transition); display: flex; align-items: center; gap: 0.5rem; box-shadow: var(--shadow); }
        .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3); }
        .search-form { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
        .search-input { padding: 12px 20px; border: 2px solid var(--primary-blue); border-radius: 25px; width: 350px; font-size: 1rem; transition: var(--transition); outline: none; }
        .search-input:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(74,144,226,0.1); }
        .search-btn { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: var(--transition); }
        .search-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }
        .clear-btn { background: var(--dark-gray); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: var(--transition); display: inline-flex; align-items: center; justify-content: center; }
        .clear-btn:hover { background: #5a6268; transform: translateY(-2px); }
        .help-btn { background: #fff; color: var(--primary-blue); border: 2px solid var(--primary-blue); padding: 10px; border-radius: 50%; width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center; box-shadow: var(--shadow); transition: var(--transition); }
        .help-btn:hover { background: rgba(255,255,255,0.9); transform: translateY(-2px); }

        /* TABLE */
        .table-container { background: white; border-radius: var(--border-radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 2rem; }
        .table-header { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; padding: 1rem 1.5rem; text-align: center; }
        .table-header h3 { margin: 0; font-size: 1.3rem; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
        .data-table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        .data-table thead th { white-space: nowrap; vertical-align: middle; }
        .data-table thead th i { margin-right: .4rem; vertical-align: middle; }
        .data-table th, .data-table td { padding: 15px 12px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.1); }
        .data-table th { font-weight: 600; color: var(--primary-blue); letter-spacing: 0.3px; font-size: 0.85rem; }
        .data-table tbody tr { transition: var(--transition); }
        .data-table tbody tr:hover { background: rgba(0, 31, 91, 0.03); }

        /* ABSTRACT PREVIEW (fixed width for consistency across pages) */
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
        .abstract-preview:hover { background: rgba(74, 144, 226, 0.1); border-color: var(--accent-blue); color: var(--primary-blue); text-decoration: none; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(74, 144, 226, 0.2); }
        .read-more-text { font-size: 0.8rem; color: var(--accent-blue); font-weight: 500; margin-top: 4px; display: block; }

        /* BADGES / BUTTONS */
        .comment-btn { background: var(--accent-blue); color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 500; cursor: pointer; transition: var(--transition); display: inline-flex; align-items: center; gap: 0.3rem; min-width: 80px; justify-content: center; }
        .comment-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); background: var(--secondary-blue); }
        .comment-btn.no-comment { background: var(--dark-gray); cursor: not-allowed; }
        .comment-btn.no-comment:hover { transform: none; background: var(--dark-gray); }

        .status-badge { display: inline-flex; align-items: center; gap: 0.3rem; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-badge.approved { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color: white; }
        .status-badge.pending { background: linear-gradient(135deg, var(--warning-yellow) 0%, #ffb800 100%); color: #856404; }
        .status-badge.returned { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; }

        .action-links { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
        .action-btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 500; transition: var(--transition); border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.3rem; }
        .action-btn.view { background: var(--accent-blue); color: white; }
        .action-btn.download { background: var(--success-green); color: white; }
        .action-btn.delete { background: var(--danger-red); color: white; }
        .action-btn.edit { background: var(--warning-yellow); color: #856404; }
        .action-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }

        /* MODALS (shared) */
        .custom-modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px); z-index: 1060; justify-content: center; align-items: center; padding: 1rem; overflow-y: auto; }
        .modal-content { background: white; border-radius: var(--border-radius); box-shadow: 0 20px 60px rgba(0,0,0,0.3); width: 100%; max-width: 600px; max-height: 90vh; overflow: hidden; animation: modalSlideIn 0.3s ease-out; position: relative; }
        .modal-content.large { max-width: 800px; }
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
        .delete-confirmation-text .research-title { font-weight: 700; color: var(--danger-red); display: block; margin: 1rem 0; padding: 1rem; background: rgba(220, 53, 69, 0.1); border-radius: 8px; border-left: 4px solid var(--danger-red); }
        .delete-warning { background: #fff3cd; border: 2px solid #ffc107; border-radius: 8px; padding: 1rem; display: flex; align-items: center; gap: 0.75rem; }
        .delete-warning i { font-size: 1.5rem; color: #856404; }
        .delete-warning p { margin: 0; color: #856404; font-weight: 500; font-size: 0.95rem; }

        .abstract-modal-content { line-height: 1.6; font-size: 1rem; color: #333; text-align: justify; word-wrap: break-word; overflow-wrap: anywhere; }
        .abstract-info { background: var(--light-gray); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border-left: 4px solid var(--accent-blue); }
        .abstract-info h5 { color: var(--primary-blue); margin-bottom: 0.5rem; font-weight: 600; }
        .abstract-info p { margin: 0.25rem 0; color: var(--dark-gray); }

        .instructor-info { color: var(--primary-blue); font-weight: 600; }
        .comment-text { background: var(--light-gray); padding: 1.5rem; border-radius: 8px; border-left: 4px solid var(--accent-blue); font-size: 1rem; line-height: 1.6; color: #333; white-space: pre-wrap; word-wrap: break-word; margin: 0; }
        .no-comment-text { color: var(--dark-gray); font-style: italic; text-align: center; }

        /* FORM CONTROLS (submit/edit) */
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--primary-blue); }
        .form-control { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: var(--transition); outline: none; }
        .form-control:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(74,144,226,0.1); }
        .form-select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e"); background-position: right 12px center; background-repeat: no-repeat; background-size: 16px; appearance: none; }

        .file-upload-wrapper { position: relative; }
        .file-upload-label { display: block; border: 2px dashed #e0e0e0; padding: 20px; border-radius: 8px; text-align: center; cursor: pointer; transition: var(--transition); background: #f9f9f9; }
        .file-upload-label:hover { border-color: var(--accent-blue); background: rgba(74, 144, 226, 0.05); }
        .file-upload-label.has-file { border-color: var(--success-green); background: rgba(40, 167, 69, 0.05); color: var(--success-green); }
        .file-upload-input { display: none; }
        .file-upload-icon { font-size: 2rem; color: var(--accent-blue); margin-bottom: 0.5rem; display: block; }

        .other-category-field { display: none; margin-top: 1rem; padding: 1rem; background: var(--light-gray); border-radius: 8px; }

        .modal-footer { padding: 1.5rem 2rem; background: var(--light-gray); border-top: 1px solid rgba(0,0,0,0.1); display: flex; justify-content: flex-end; gap: 1rem; }
        .modal-btn.primary { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color: white; }
        .modal-btn.secondary { background: var(--dark-gray); color: white; }
        .modal-btn.danger { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; }
        .modal-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }
        .modal-btn { padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: var(--transition); border: none; display: inline-flex; align-items: center; gap: 0.5rem; }
        .modal-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow); }
        .modal-btn-cancel { background: var(--light-gray); color: var(--dark-gray); }
        .modal-btn-cancel:hover { background: #e2e6ea; }
        .modal-btn-confirm { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; }
        .modal-btn-confirm:hover { box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4); }
        /* EMPTY */
        .empty-state { text-align: center; padding: 3rem 2rem; color: var(--dark-gray); }
        .empty-state i { font-size: 4rem; color: var(--primary-blue); margin-bottom: 1rem; opacity: 0.6; }
        .empty-state h4 { margin-bottom: 0.5rem; color: var(--primary-blue); }

        /* DATETIME */
        .datetime-info { font-size: 0.85rem; color: var(--dark-gray); line-height: 1.3; }
        .datetime-info .date { font-weight: 600; color: var(--primary-blue); }
        .datetime-info .time { color: var(--dark-gray); }

        /* FLASH ALERTS */
        .flash-alert{ position:fixed; top:90px; right:20px; display:flex; align-items:center; gap:.6rem; padding:12px 16px; border-radius:10px; box-shadow:0 10px 30px rgba(0,0,0,.15); z-index:2001; opacity:0; transform:translateY(-10px); transition:opacity .25s ease, transform var(--transition), box-shadow var(--transition), background-color var(--transition); max-width:460px; }
        .flash-alert.show{ opacity:1; transform:translateY(0); }
        .flash-alert i{ font-size:1.1rem; }
        .flash-alert .message{ flex:1; }
        .flash-alert .close{ background:transparent; border:0; color:inherit; cursor:pointer; width:32px; height:32px; border-radius:50%; display:grid; place-items:center; font-size:18px; transition:var(--transition); }
        .flash-alert .close:hover{ background:rgba(255,255,255,.2); transform:rotate(90deg); }
        .flash-alert.success{ background:linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color:#fff; }
        .flash-alert.danger{ background:linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color:#fff; }

        /* Validation helpers */
        .field-error { color: var(--danger-red); font-size: 0.9rem; margin-top: 6px; display: none; }
        .field-hint { color: var(--dark-gray); font-size: 0.85rem; margin-top: 6px; }
        .input-invalid { border-color: var(--danger-red) !important; box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.08) !important; }
        .input-valid { border-color: var(--success-green) !important; box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.08) !important; }
        .file-upload-label.error { border-color: var(--danger-red); color: var(--danger-red); background: rgba(220, 53, 69, 0.05); }
        .file-upload-label.success { border-color: var(--success-green); color: var(--success-green); background: rgba(40, 167, 69, 0.05); }
        .modal-btn.primary:disabled { opacity: 0.6; cursor: not-allowed; filter: grayscale(20%); }

        /* PAGINATION (numeric + ellipsis, consistent) */
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

        /* Responsive */
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
            .abstract-preview { width: 150px; }
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
            .abstract-preview { width: 120px; }
        }
        @media (max-width: 1200px) { .table-container { overflow-x: auto; } .data-table { min-width: 1000px; } }
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
            <a href="{{ route('faculty.research') }}" class="active"><i class="fas fa-microscope me-2"></i>Research</a>
            <a href="{{ route('faculty.syllabus') }}"><i class="fas fa-book me-2"></i>Syllabus</a>
            <a href="{{ route('faculty.exam') }}"><i class="fas fa-clipboard-list me-2"></i>Exam Bank</a>
            <a href="{{ route('settings.faculty') }}" class="profile-section-nav">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profile-img">
                @else
                    <i class="fas fa-user-circle" style="font-size: 30px; color:white;"></i>
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
    <a href="{{ route('faculty.research') }}" class="active" onclick="closeSidebar()"><i class="fas fa-microscope me-2"></i>Research</a>
    <a href="{{ route('faculty.syllabus') }}" onclick="closeSidebar()"><i class="fas fa-book me-2"></i>Syllabus</a>
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
            <h1 class="page-title">Research Repository</h1>
            <p class="page-subtitle">Manage and submit your academic research papers</p>
        </div>

        <div class="action-bar">
            <div class="d-flex align-items-center" style="gap:.5rem;">
                <button class="submit-btn" onclick="openModal()"><i class="fas fa-plus"></i>Submit New Research</button>
                <button type="button" class="help-btn" onclick="openHelpModal()" aria-label="How to submit" title="How to submit">
                    <i class="fas fa-info-circle"></i>
                </button>
            </div>
            @php
                $years = $researches->pluck('publication_year')->filter()->unique()->sortDesc()->values();
            @endphp
            <form class="search-form" action="{{ route('faculty.research') }}" method="GET">
                <input type="text" name="search" class="search-input" placeholder="Search research papers..." value="{{ request('search') }}">
                <select name="year" id="yearFilter" class="form-select" style="padding: 12px 16px; border: 2px solid var(--primary-blue); border-radius: 25px; width: 220px;">
                    <option value="">Publication Year</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                <button type="submit" class="search-btn"><i class="fas fa-search me-1"></i>Search</button>
                <a href="{{ route('faculty.research') }}" class="clear-btn" style="text-decoration:none;">
                    <i class="fas fa-times me-1"></i>Clear
                </a>
            </form>
        </div>

        <div class="table-container">
            <div class="table-header"><h3><i class="fas fa-microscope me-2"></i>Your Research Submissions</h3></div>
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
                            <th><i class="fas fa-comment me-1"></i>COMMENT</th>
                            <th><i class="fas fa-info-circle me-1"></i>STATUS</th>
                            <th><i class="fas fa-cog me-1"></i>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="researchTableBody">
                        @forelse ($researches as $research)
                            <tr class="research-row"
                                data-search-text="{{ strtolower(($research->title ?? '') . ' ' . ($research->author ?? '') . ' ' . ($research->research_area ?? '') . ' ' . ($research->abstract ?? '') . ' ' . ($research->keyword ?? '') . ' ' . (($research->user->name ?? '') ) . ' ' . ($research->publication_year ?? '')) }}">
                                <td><strong>{{ $research->id }}</strong></td>
                                <td><strong>{{ $research->title }}</strong></td>
                                <td>{{ $research->author }}</td>
                                <td><span class="badge bg-primary">{{ $research->research_area }}</span></td>
                                <td>
                                    <a href="javascript:void(0)"
                                       class="abstract-preview"
                                       onclick='showAbstract(@json($research->title), @json($research->author), @json($research->research_area), @json($research->abstract), @json($research->keyword), @json($research->publication_year))'>
                                        {{ \Illuminate\Support\Str::limit($research->abstract, 80) }}
                                        <small class="read-more-text"><i class="fas fa-eye me-1"></i>Click to read full abstract</small>
                                    </a>
                                </td>
                                <td>{{ $research->keyword }}</td>
                                <td><span class="badge bg-info">{{ $research->publication_year }}</span></td>                                
                                <td><strong><div class="instructor-info">{{ $research->user->name ?? 'N/A' }}</div></strong></td>
                                <td>
                                    <div class="datetime-info">
                                        <div class="date">{{ $research->created_at->setTimezone('Asia/Manila')->format('M d, Y') }}</div>
                                        <div class="time">{{ $research->created_at->setTimezone('Asia/Manila')->format('h:i A') }}</div>
                                    </div>
                                </td>
                                <td>
                                    @if($research->evaluator_comment && trim($research->evaluator_comment) !== '')
                                        <button class="comment-btn" onclick='openCommentModal(@json($research->evaluator_comment))'>
                                            <i class="fas fa-eye"></i>View Comment
                                        </button>
                                    @else
                                        <button class="comment-btn no-comment" disabled>
                                            <i class="fas fa-minus"></i>None
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($research->status === 'Approved')
                                        <span class="status-badge approved"><i class="fas fa-check-circle"></i>Approved</span>
                                    @elseif ($research->status === 'Returned')
                                        <span class="status-badge returned"><i class="fas fa-exclamation-triangle"></i>Returned</span>
                                    @else
                                        <span class="status-badge pending"><i class="fas fa-clock"></i>Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-links">
        @if ($research->status === 'Approved')
            <a href="{{ asset('storage/' . $research->file_path) }}" target="_blank" class="action-btn view"><i class="fas fa-eye"></i>View</a>
            <a href="{{ route('faculty.research.download', $research->id) }}" class="action-btn download"><i class="fas fa-download"></i>Download</a>
        @elseif ($research->status === 'Returned')
            <button class="action-btn edit" onclick='openEditModal({{ $research->id }}, @json($research->title), @json($research->author), @json($research->research_area), @json($research->abstract), @json($research->keyword), @json($research->publication_year))'><i class="fas fa-edit"></i>Edit</button>
            <a href="{{ route('faculty.research.view', $research->id) }}" target="_blank" class="action-btn view"><i class="fas fa-eye"></i>View</a>
        @else
            <a href="{{ route('faculty.research.view', $research->id) }}" target="_blank" class="action-btn view"><i class="fas fa-eye"></i>View</a>
        @endif

        @if ($research->status !== 'Approved')
            <button type="button" class="action-btn delete" onclick='openDeleteModal({{ $research->id }}, @json($research->title))'><i class="fas fa-trash"></i>Delete</button>
        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="12">
                                    <div class="empty-state">
                                        <i class="fas fa-microscope"></i>
                                        @if(request()->filled('search') || request()->filled('year'))
                                            <h4>No Research Found</h4>
                                            <p>No research submissions match your filters. Try adjusting your keywords or year.</p>
                                        @else
                                            <h4>No Research Submitted</h4>
                                            <p>You haven't submitted any research papers yet. Click "Submit New Research" to get started.</p>
                                        @endif
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

<!-- Submit Modal -->
<div id="submitModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-plus-circle"></i>Submit New Research</h3>
            <button class="close-modal" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
        
        <form id="createResearchForm" method="POST" action="{{ route('faculty.research.store') }}" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="create_title"><i class="fas fa-heading me-1"></i>Research Title *</label>
                    <input type="text" id="create_title" name="title" class="form-control" required placeholder="Enter your research title" maxlength="255" value="{{ old('title') }}">
                    <div id="error_create_title" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="create_author"><i class="fas fa-user me-1"></i>Author *</label>
                    <input type="text" id="create_author" name="author" class="form-control" required placeholder="Enter author name(s)" maxlength="255" value="{{ old('author') }}">
                    <div id="error_create_author" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="research_area"><i class="fas fa-tag me-1"></i>Research Category *</label>
                    <select name="research_area" id="research_area" class="form-control form-select" onchange="toggleOtherField()" required>
                        <option value="" disabled {{ old('research_area') ? '' : 'selected' }}>Select Research Category</option>
                        <option value="Humanities">Humanities</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Education">Education</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Business">Business</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Fisheries">Fisheries</option>
                        <option value="Others">Others</option>
                    </select>
                    <div id="error_create_research_area" class="field-error"></div>
                    
                    <div id="otherCategoryField" class="other-category-field">
                        <label class="form-label" for="create_other_research_area"><i class="fas fa-edit me-1"></i>Specify Other Category *</label>
                        <input type="text" id="create_other_research_area" name="other_research_area" class="form-control" placeholder="Please specify your research category" value="{{ old('other_research_area') }}">
                        <div id="error_create_other_research_area" class="field-error"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="create_publication_year"><i class="fas fa-calendar-day me-1"></i>Publication Year *</label>
                    <input type="number" id="create_publication_year" name="publication_year"
                            class="form-control" required min="2021" step="1"
                            placeholder="Enter publication year (e.g., {{ now()->year }})"
                            value="{{ old('publication_year') }}">
                        <small class="field-hint">Allowed: 2021 onwards</small>
                    <div id="error_create_publication_year" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="create_abstract"><i class="fas fa-file-alt me-1"></i>Abstract *</label>
                    <textarea id="create_abstract" name="abstract" class="form-control" rows="4" required placeholder="Enter your research abstract (maximum 500 words)" maxlength="5000">{{ old('abstract') }}</textarea>
                    <div class="d-flex justify-content-between">
                        <small class="field-hint"><span id="createAbstractWordCount">0</span>/500 words</small>
                        <small class="field-hint"><span id="createAbstractCharCount">0</span>/5000 chars</small>
                    </div>
                    <div id="error_create_abstract" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="create_keyword"><i class="fas fa-key me-1"></i>Keywords *</label>
                    <input type="text" id="create_keyword" name="keyword" class="form-control" required placeholder="Example: Artificial Intelligence - Machine Learning, Natural Language Processing" maxlength="255" value="{{ old('keyword') }}">
                    <small class="text-muted">Separate multiple keywords with hyphens or commas.</small>
                    <div id="error_create_keyword" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-paperclip me-1"></i>Research File *</label>
                    <input type="file" name="file" id="researchFileUpload" class="file-upload-input" required accept=".pdf,.doc,.docx">
                    <label for="researchFileUpload" id="researchFileLabel" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                        <div id="researchFileText">
                            <strong>Click to upload your research file</strong><br>
                            <small>Supported formats: PDF, DOC, DOCX (Max: 30MB)</small>
                        </div>
                    </label>
                    <div id="error_create_file" class="field-error"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="modal-btn secondary" onclick="closeModal()"><i class="fas fa-times me-1"></i>Cancel</button>
                <button type="submit" class="modal-btn primary" id="createSubmitBtn" disabled><i class="fas fa-paper-plane me-1"></i>Submit Research</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-edit"></i>Edit Research Submission</h3>
            <button class="close-modal" onclick="closeEditModal()"><i class="fas fa-times"></i></button>
        </div>
        
        <form id="editResearchForm" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <div class="modal-body">
                <input type="hidden" id="edit_research_id" name="research_id" value="{{ old('research_id', session('open_edit_id')) }}">
                
                <div class="form-group">
                    <label class="form-label" for="edit_title"><i class="fas fa-heading me-1"></i>Research Title *</label>
                    <input type="text" id="edit_title" name="title" class="form-control" required placeholder="Enter your research title" maxlength="255" value="{{ old('title') }}">
                    <div id="error_edit_title" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="edit_author"><i class="fas fa-user me-1"></i>Author *</label>
                    <input type="text" id="edit_author" name="author" class="form-control" required placeholder="Enter author name(s)" maxlength="255" value="{{ old('author') }}">
                    <div id="error_edit_author" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="edit_research_area"><i class="fas fa-tag me-1"></i>Research Category *</label>
                    <select name="research_area" id="edit_research_area" class="form-control form-select" onchange="toggleEditOtherField()" required>
                        <option value="" disabled>Select Research Category</option>
                        <option value="Humanities">Humanities</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Education">Education</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Business">Business</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Fisheries">Fisheries</option>
                        <option value="Others">Others</option>
                    </select>
                    <div id="error_edit_research_area" class="field-error"></div>
                    
                    <div id="editOtherCategoryField" class="other-category-field">
                        <label class="form-label" for="edit_other_research_area"><i class="fas fa-edit me-1"></i>Specify Other Category *</label>
                        <input type="text" name="other_research_area" id="edit_other_research_area" class="form-control" placeholder="Please specify your research category" value="{{ old('other_research_area') }}">
                        <div id="error_edit_other_research_area" class="field-error"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="edit_publication_year"><i class="fas fa-calendar-day me-1"></i>Publication Year *</label>
                    <input type="number" id="edit_publication_year" name="publication_year"
                        class="form-control" required min="2021" step="1"
                        placeholder="Enter publication year (e.g., {{ now()->year }})"
                        value="{{ old('publication_year') }}">
                    <small class="field-hint">Allowed: 2021 onwards</small>
                    <div id="error_edit_publication_year" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="edit_abstract"><i class="fas a-file-alt me-1"></i>Abstract *</label>
                    <textarea name="abstract" id="edit_abstract" class="form-control" rows="4" required placeholder="Enter your research abstract (maximum 500 words)" maxlength="5000">{{ old('abstract') }}</textarea>
                    <div class="d-flex justify-content-between">
                        <small class="field-hint"><span id="editAbstractWordCount">0</span>/500 words</small>
                        <small class="field-hint"><span id="editAbstractCharCount">0</span>/5000 chars</small>
                    </div>
                    <div id="error_edit_abstract" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="edit_keyword"><i class="fas fa-key me-1"></i>Keywords *</label>
                    <input type="text" name="keyword" id="edit_keyword" class="form-control" required placeholder="Example: Artificial Intelligence - Machine Learning, Natural Language Processing" maxlength="255" value="{{ old('keyword') }}">
                    <small class="text-muted">Separate multiple keywords with hyphens or commas.</small>
                    <div id="error_edit_keyword" class="field-error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-paperclip me-1"></i>Research File (Optional - Leave empty to keep current file)</label>
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
                <button type="submit" class="modal-btn primary" id="editSubmitBtn" disabled><i class="fas fa-save me-1"></i>Update Research</button>
            </div>
        </form>
    </div>
</div>

<!-- Abstract Modal -->
<div id="abstractModal" class="custom-modal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-file-alt"></i>Research Abstract</h3>
            <button class="close-modal" onclick="closeAbstractModal()"><i class="fas fa-times"></i></button>
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
                <div id="abstractContent">Abstract content will appear here...</div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="modal-btn secondary" onclick="closeAbstractModal()"><i class="fas fa-times me-1"></i>Close</button>
        </div>
    </div>
</div>

<!-- Comment Modal -->
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

<!-- Delete Modal -->
<div id="deleteModal" class="custom-modal">
    <div class="modal-content small">
        <div class="modal-header danger">
            <h3 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion</h3>
            <button class="close-modal" onclick="closeDeleteModal()"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <div class="delete-confirmation-text">
                <p>Are you sure you want to delete this research?</p>
                <span class="research-title" id="deleteResearchTitle">Research Title</span>
            </div>
            
            <div class="delete-warning">
                <i class="fas fa-exclamation-circle"></i>
                <p>This action cannot be undone. All data associated with this research will be permanently deleted.</p>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="modal-btn secondary" onclick="closeDeleteModal()"><i class="fas fa-times me-1"></i>Cancel</button>
            <form id="deleteResearchForm" method="POST" style="display:inline; margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-btn danger"><i class="fas fa-trash me-1"></i>Delete Research</button>
            </form>
        </div>
    </div>
</div>

<!-- Help / Tutorial Modal -->
<div id="helpModal" class="custom-modal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-info-circle"></i>How to Submit</h3>
            <button class="close-modal" onclick="closeHelpModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <div class="ratio ratio-16x9">
                    <video id="helpVideo"
                           class="w-100 h-100"
                           controls
                           preload="metadata"
                           playsinline
                           controlsList="nodownload">
                        <source src="{{ asset('videos/SubmitResearchTutorial.mp4') }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                        <a href="{{ asset('videos/SubmitResearchTutorial.mp4') }}">Download the video</a>.
                    </video>
                </div>
            </div>

            <div class="abstract-info">
                <h5>Quick summary</h5>
                <ul class="mb-0">
                    <li><small>Click <strong>Submit New Research</strong>.</small></li>
                    <li><small>Fill in Title, Author, Category, Publication Year, Abstract, and Keywords.</small></li>
                    <li><small>Select <strong>Others</strong> and specify when the category isn?t listed.</small></li>
                    <li><small>Upload PDF/DOC/DOCX up to 30MB.</small></li>
                    <li><small>Abstract ? 500 words (? 5000 characters).</small></li>
                    <li><small>Click <strong>Submit Research</strong> and wait for confirmation.</small></li>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-btn secondary" onclick="closeHelpModal()"><i class="fas fa-times me-1"></i>Close</button>
        </div>
    </div>
</div>

<script>
let deleteResearchId = null;
const updateUrlTemplate = "{{ route('faculty.research.update', ['id' => '__ID__']) }}";
const deleteUrlTemplate = "{{ route('faculty.research.delete', ['id' => '__ID__']) }}";

/* Pagination state */
const PAGE_SIZE = 5;
let currentPage = 1;

/* Sidebar */
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

/* Flash */
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

/* Logout */
function showLogoutModal(){ document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
function closeLogoutModal(){ document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = 'auto'; }
function closeModalOnOverlay(event){ if (event.target.id === 'logoutModal') closeLogoutModal(); }
function confirmLogout(){ document.getElementById('logoutForm').submit(); }

/* Submit modal */
function openModal(){ document.getElementById("submitModal").style.display = "flex"; document.body.style.overflow = 'hidden'; }
function closeModal(){
    document.getElementById("submitModal").style.display = "none";
    document.body.style.overflow = 'auto';
    const form = document.querySelector('#createResearchForm'); if (form) form.reset();
    document.getElementById("researchFileText").innerHTML = '<strong>Click to upload your research file</strong><br><small>Supported formats: PDF, DOC, DOCX (Max: 30MB)</small>';
    document.getElementById("researchFileLabel").classList.remove('has-file','error','success');
    document.getElementById("otherCategoryField").style.display = 'none';
    clearCreateErrors(); updateCreateSubmitState();
}

/* Edit modal */
function openEditModal(id, title, author, area, abstract, keywords, year) {
    document.getElementById('edit_research_id').value = id;
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_author').value = author;
    document.getElementById('edit_research_area').value = area;
    document.getElementById('edit_abstract').value = abstract;
    document.getElementById('edit_keyword').value = normalizeKeywordsString(keywords);
    document.getElementById('edit_publication_year').value = year || '';
    document.getElementById('editResearchForm').action = updateUrlTemplate.replace('__ID__', id);
    
    const predefined = ['Humanities','Engineering','Education','Information Technology','Business','Agriculture','Fisheries'];
    if (!predefined.includes(area)) {
        document.getElementById('edit_research_area').value = 'Others';
        document.getElementById('editOtherCategoryField').style.display = 'block';
        document.getElementById('edit_other_research_area').value = area;
        document.getElementById('edit_other_research_area').required = true;
    } else {
        document.getElementById('editOtherCategoryField').style.display = 'none';
        document.getElementById('edit_other_research_area').required = false;
        document.getElementById('edit_other_research_area').value = '';
    }
    
    updateEditAbstractCounters();
    validateEditForm(false);
    document.getElementById('editModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeEditModal(){
    document.getElementById('editModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    document.getElementById('editResearchForm').reset();
    document.getElementById('editFileText').innerHTML = '<strong>Click to upload new file (optional)</strong><br><small>Leave empty to keep existing file. Supported: PDF, DOC, DOCX (Max: 30MB)</small>';
    document.getElementById('editFileLabel').classList.remove('has-file','error','success');
    document.getElementById('editOtherCategoryField').style.display = 'none';
    clearEditErrors(); updateEditSubmitState();
}
function toggleEditOtherField(){
    const select = document.getElementById('edit_research_area');
    const otherField = document.getElementById('editOtherCategoryField');
    if (select.value === 'Others') {
        otherField.style.display = 'block';
        const input = otherField.querySelector('input'); input.required = true;
    } else {
        otherField.style.display = 'none';
        const input = otherField.querySelector('input'); input.required = false; input.value = '';
    }
    validateField(select, 'error_edit_research_area', (v)=> !!v, 'Please select a research category.');
}

/* Abstract + comment modals */
function showAbstract(title, author, area, abstract, keywords, year){
    document.getElementById("abstractTitle").textContent = title;
    document.getElementById("abstractAuthor").textContent = author;
    document.getElementById("abstractArea").textContent = area;
    document.getElementById("abstractYear").textContent = year || '';
    document.getElementById("abstractKeywords").textContent = normalizeKeywordsString(keywords || '');
    document.getElementById("abstractContent").textContent = abstract;
    document.getElementById("abstractModal").style.display = "flex";
    document.body.style.overflow = 'hidden';
}
function closeAbstractModal(){ document.getElementById("abstractModal").style.display = "none"; document.body.style.overflow = 'auto'; }

function openCommentModal(comment){
    const commentText = document.getElementById("commentText");
    if (comment && comment.trim() !== '') { commentText.textContent = comment; commentText.classList.remove('no-comment-text'); }
    else { commentText.textContent = 'No comment available.'; commentText.classList.add('no-comment-text'); }
    document.getElementById("commentModal").style.display = "flex"; document.body.style.overflow = 'hidden';
}
function closeCommentModal(){ document.getElementById("commentModal").style.display = "none"; document.body.style.overflow = 'auto'; }

/* Delete modal */
function openDeleteModal(researchId, researchTitle){
    deleteResearchId = researchId;
    document.getElementById("deleteResearchTitle").textContent = researchTitle;
    document.getElementById("deleteResearchForm").action = deleteUrlTemplate.replace('__ID__', researchId);
    document.getElementById("deleteModal").style.display = "flex";
    document.body.style.overflow = 'hidden';
}
function closeDeleteModal(){ document.getElementById("deleteModal").style.display = "none"; document.body.style.overflow = 'auto'; deleteResearchId = null; }

/* Help modal */
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

    if (tag === 'video') {
        media.pause();
        media.currentTime = 0;
    } else if (tag === 'iframe') {
        media.src = media.src;
    }
}

/* File label handlers */
document.addEventListener('change', function(e){
    if(e.target && e.target.id === 'researchFileUpload'){
        const file = e.target.files[0];
        const fileText = document.getElementById("researchFileText");
        const fileLabel = document.getElementById("researchFileLabel");
        if (file) {
            let name = file.name; if (name.length > 40) name = name.substring(0,37) + "...";
            fileText.innerHTML = `<strong>${name}</strong><br><small>File selected successfully</small>`;
            fileLabel.classList.add('has-file');
        } else {
            fileText.innerHTML = '<strong>Click to upload your research file</strong><br><small>Supported formats: PDF, DOC, DOCX (Max: 30MB)</small>';
            fileLabel.classList.remove('has-file','error','success');
        }
        validateCreateFile();
    }
    if(e.target && e.target.id === 'editFileUpload'){
        const file = e.target.files[0];
        const fileText = document.getElementById("editFileText");
        const fileLabel = document.getElementById("editFileLabel");
        if (file) {
            let name = file.name; if (name.length > 40) name = name.substring(0,37) + "...";
            fileText.innerHTML = `<strong>${name}</strong><br><small>New file selected</small>`;
            fileLabel.classList.add('has-file');
        } else {
            fileText.innerHTML = '<strong>Click to upload new file (optional)</strong><br><small>Leave empty to keep existing file. Supported: PDF, DOC, DOCX (Max: 30MB)</small>';
            fileLabel.classList.remove('has-file','error','success');
        }
        validateEditFile();
    }
});

/* Validation helpers and logic */
const MAX_FILE_BYTES = 30 * 1024 * 1024;
const ALLOWED_EXTS = ['pdf','doc','docx'];
const LONG_WORD_REGEX = /[A-Za-z0-9]{50,}/;
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
function tooRepetitive(str){
    const t = (str || '').trim();
    
    // Check for excessive repeated characters (6+ same character in a row)
    if (/(.)\1{5,}/.test(t)) return true;
    
    // Split into words
    const words = t.split(/\s+/).filter(Boolean);
    
    // If there are multiple words (3+), check each word individually
    if (words.length >= 3) {
        for (const word of words) {
            const alnum = word.replace(/[^A-Za-z0-9]/g, '');
            const len = alnum.length;
            
            // Only check words that are reasonably long (10+ chars)
            if (len >= 10) {
                const unique = new Set(alnum.toLowerCase().split('')).size;
                const ratio = len > 0 ? unique / len : 1;
                
                // Very strict threshold - only fail if ratio is extremely low (less than 0.2)
                if (ratio < 0.2) {
                    return true;
                }
            }
        }
        return false;
    } else {
        // For single or two-word titles, be a bit more strict
        const alnum = t.replace(/[^A-Za-z0-9]/g, '');
        const len = alnum.length;
        
        if (len >= 15) {
            const unique = new Set(alnum.toLowerCase().split('')).size;
            const ratio = len > 0 ? unique / len : 1;
            
            // Still more lenient - only fail if ratio is very low (0.25)
            if (ratio < 0.25) {
                return true;
            }
        }
    }
    
    return false;
}
function wordCount(str){ return (str || '').trim().split(/\s+/).filter(Boolean).length; }
function setCounters(text, wordElId, charElId, maxChars){
    const wEl = document.getElementById(wordElId), cEl = document.getElementById(charElId);
    const words = wordCount(text), chars = (text || '').length;
    if (wEl) { wEl.textContent = words; wEl.style.color = words > 500 ? 'var(--danger-red)' : ''; }  // Changed from 300 to 500
    if (cEl) { cEl.textContent = chars; cEl.style.color = chars > (maxChars || 5000) ? 'var(--danger-red)' : ''; }
}
function hasLongUnbrokenWord(text){ return LONG_WORD_REGEX.test(text || ''); }

const KEYWORD_ITEM_REGEX = /^[\p{L}\p{N}\s.&()'\/+\-]+$/u;
const KEYWORD_SEPARATOR = /\s*,\s*|\s+-\s+/;
function normalizeKeywordsString(s){
    let out = (s || '').trim();
    out = out.replace(/\s*,\s*/g, ', ');
    out = out.replace(/\s+-\s+/g, ' - ');
    out = out.replace(/(,\s*){2,}/g, ', ');
    out = out.replace(/(\s-\s){2,}/g, ' - ');
    out = out.replace(/\s{2,}/g, ' ').trim();
    out = out.replace(/^,|,$/g, '').replace(/^\s-\s| \s-\s$/g, '');
    return out;
}
function parseKeywordsToArray(raw){
    const s = (raw || '').trim();
    if (!s) return [];
    return s.split(KEYWORD_SEPARATOR).map(x => x.trim()).filter(Boolean);
}

/* Create validations */
function validateCreateTitle(show=true){
    const el = document.getElementById('create_title');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_create_title', 'Please enter the research title.'); return false; }
    if (val.length < 2) { if(show) showError(el, 'error_create_title', 'Title must be at least 2 characters.'); return false; }
    if (!/[A-Za-z]/.test(val)) { if(show) showError(el, 'error_create_title', 'Title must contain letters.'); return false; }
    if (tooRepetitive(val)) { if(show) showError(el, 'error_create_title', 'Title contains words that appear too repetitive. Enter a meaningful title.'); return false; }
    if (val.length > 255) { if(show) showError(el, 'error_create_title', 'Title must not exceed 255 characters.'); return false; }
    if (show) clearError(el, 'error_create_title'); else neutral(el, 'error_create_title');
    return true;
}
function validateCreateAuthor(show=true){
    const el = document.getElementById('create_author');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_create_author', 'Please enter the author name(s).'); return false; }
    if (val.length > 255) { if(show) showError(el, 'error_create_author', 'Author must not exceed 255 characters.'); return false; }
    if (show) clearError(el, 'error_create_author'); else neutral(el, 'error_create_author');
    return true;
}
function validateCreateArea(show=true){
    const el = document.getElementById('research_area');
    const val = el.value;
    if (!val) { if(show) showError(el, 'error_create_research_area', 'Please select a research category.'); return false; }
    if (val === 'Others') {
        const other = document.getElementById('create_other_research_area');
        const ov = (other.value || '').trim();
        if (!ov) { if(show) showError(other, 'error_create_other_research_area', 'Please specify your research category.'); return false; }
        if (ov.length > 255) { if(show) showError(other, 'error_create_other_research_area', 'Other category must not exceed 255 characters.'); return false; }
        if (show) clearError(other, 'error_create_other_research_area'); else neutral(other, 'error_create_other_research_area');
    } else {
        neutral(document.getElementById('create_other_research_area'), 'error_create_other_research_area');
    }
    if (show) clearError(el, 'error_create_research_area'); else neutral(el, 'error_create_research_area');
    return true;
}
function updateCreateAbstractCounters(){ const el = document.getElementById('create_abstract'); setCounters(el.value, 'createAbstractWordCount', 'createAbstractCharCount', 5000); }
function validateCreateAbstract(show=true){
    const el = document.getElementById('create_abstract');
    const val = (el.value || '').trim();
    updateCreateAbstractCounters();
    if (!val) { if(show) showError(el, 'error_create_abstract', 'Please provide the abstract.'); return false; }
    if (hasLongUnbrokenWord(val)) { if(show) showError(el, 'error_create_abstract', 'Abstract contains very long unbroken words (50+ chars). Please insert spaces or hyphens.'); return false; }
    if (wordCount(val) > 500) { if(show) showError(el, 'error_create_abstract', 'Abstract must not exceed 500 words.'); return false; }  // Changed from 300 to 500
    if (val.length > 5000) { if(show) showError(el, 'error_create_abstract', 'Abstract must not exceed 5000 characters.'); return false; }
    if (show) clearError(el, 'error_create_abstract'); else neutral(el, 'error_create_abstract');
    return true;
}
function validateCreateKeyword(show=true){
    const el = document.getElementById('create_keyword');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_create_keyword', 'Please provide at least one keyword.'); return false; }
    const items = parseKeywordsToArray(val);
    if (items.length === 0) { if(show) showError(el, 'error_create_keyword', 'Please provide at least one keyword.'); return false; }
    if (items.length > 20) { if(show) showError(el, 'error_create_keyword', 'Too many keywords. Maximum is 20.'); return false; }
    for (const item of items) {
        if (item.length > 60) { if(show) showError(el, 'error_create_keyword', 'Each keyword must be at most 60 characters.'); return false; }
        if (!KEYWORD_ITEM_REGEX.test(item)) { if(show) showError(el, 'error_create_keyword', 'Keywords may include letters, numbers, spaces, and . & ( ) \'/ + -'); return false; }
    }
    if (show) clearError(el, 'error_create_keyword'); else neutral(el, 'error_create_keyword');
    return true;
}
function validateCreateFile(show=true){
    const input = document.getElementById('researchFileUpload');
    const label = document.getElementById('researchFileLabel');
    const errId = 'error_create_file';
    label.classList.remove('error','success');
    const file = input.files && input.files[0];
    if (!file) { if(show) { showError(null, errId, 'Please upload your research file.'); label.classList.add('error'); } return false; }
    const ext = getExt(file.name);
    if (!ALLOWED_EXTS.includes(ext)) { if(show) { showError(null, errId, 'File must be a PDF, DOC, or DOCX.'); label.classList.add('error'); } return false; }
    if (file.size > MAX_FILE_BYTES) { if(show) { showError(null, errId, 'File size must not exceed 30MB.'); label.classList.add('error'); } return false; }
    if (show) { clearError(null, errId); label.classList.add('success'); } else { const e = document.getElementById(errId); if(e){ e.style.display='none'; e.textContent=''; } }
    return true;
}
function validateCreatePublicationYear(show=true){
  const el = document.getElementById('create_publication_year');
  const valRaw = (el.value || '').trim();
  const year = parseInt(valRaw, 10);
  if (!valRaw) { if (show) showError(el, 'error_create_publication_year', 'Please enter the publication year.'); return false; }
  if (isNaN(year)) { if (show) showError(el, 'error_create_publication_year', 'Publication year must be a number.'); return false; }
  if (year < 2021) { if (show) showError(el, 'error_create_publication_year', 'Publication year must be 2021 or later.'); return false; }
  if (show) clearError(el, 'error_create_publication_year'); else neutral(el, 'error_create_publication_year');
  return true;
}
function isCreateFormValid(){
    return validateCreateTitle(false) && validateCreateAuthor(false) && validateCreateArea(false) &&
           validateCreatePublicationYear(false) && validateCreateAbstract(false) &&
           validateCreateKeyword(false) && validateCreateFile(false);
}
function updateCreateSubmitState(){ const btn = document.getElementById('createSubmitBtn'); if (btn) btn.disabled = !isCreateFormValid(); }
function clearCreateErrors(){
    ['error_create_title','error_create_author','error_create_research_area','error_create_other_research_area','error_create_publication_year','error_create_abstract','error_create_keyword','error_create_file'].forEach(id=>{
        const n = document.getElementById(id); if(n){ n.textContent=''; n.style.display='none'; }
    });
    ['create_title','create_author','research_area','create_other_research_area','create_publication_year','create_abstract','create_keyword'].forEach(id=>{
        const el = document.getElementById(id); if(el){ el.classList.remove('input-invalid','input-valid'); el.removeAttribute('aria-invalid'); }
    });
}

/* Edit validations */
function validateEditTitle(show=true){
    const el = document.getElementById('edit_title');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_edit_title', 'Please enter the research title.'); return false; }
    if (val.length < 2) { if(show) showError(el, 'error_edit_title', 'Title must be at least 2 characters.'); return false; }
    if (!/[A-Za-z]/.test(val)) { if(show) showError(el, 'error_edit_title', 'Title must contain letters.'); return false; }
    if (tooRepetitive(val)) { if(show) showError(el, 'error_edit_title', 'Title contains words that appear too repetitive. Enter a meaningful title.'); return false; }
    if (val.length > 255) { if(show) showError(el, 'error_edit_title', 'Title must not exceed 255 characters.'); return false; }
    if (show) clearError(el, 'error_edit_title'); else neutral(el, 'error_edit_title');
    return true;
}
function validateEditAuthor(show=true){
    const el = document.getElementById('edit_author');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_edit_author', 'Please enter the author name(s).'); return false; }
    if (val.length > 255) { if(show) showError(el, 'error_edit_author', 'Author must not exceed 255 characters.'); return false; }
    if (show) clearError(el, 'error_edit_author'); else neutral(el, 'error_edit_author');
    return true;
}
function validateEditArea(show=true){
    const el = document.getElementById('edit_research_area');
    const val = el.value;
    if (!val) { if(show) showError(el, 'error_edit_research_area', 'Please select a research category.'); return false; }
    if (val === 'Others') {
        const other = document.getElementById('edit_other_research_area');
        const ov = (other.value || '').trim();
        if (!ov) { if(show) showError(other, 'error_edit_other_research_area', 'Please specify your research category.'); return false; }
        if (ov.length > 255) { if(show) showError(other, 'error_edit_other_research_area', 'Other category must not exceed 255 characters.'); return false; }
        if (show) clearError(other, 'error_edit_other_research_area'); else neutral(other, 'error_edit_other_research_area');
    } else {
        neutral(document.getElementById('edit_other_research_area'), 'error_edit_other_research_area');
    }
    if (show) clearError(el, 'error_edit_research_area'); else neutral(el, 'error_edit_research_area');
    return true;
}
function updateEditAbstractCounters(){ const el = document.getElementById('edit_abstract'); setCounters(el.value, 'editAbstractWordCount', 'editAbstractCharCount', 5000); }
function validateEditAbstract(show=true){
    const el = document.getElementById('edit_abstract');
    const val = (el.value || '').trim();
    updateEditAbstractCounters();
    if (!val) { if(show) showError(el, 'error_edit_abstract', 'Please provide the abstract.'); return false; }
    if (hasLongUnbrokenWord(val)) { if(show) showError(el, 'error_edit_abstract', 'Abstract contains very long unbroken words (50+ chars). Please insert spaces or hyphens.'); return false; }
    if (wordCount(val) > 500) { if(show) showError(el, 'error_edit_abstract', 'Abstract must not exceed 500 words.'); return false; }  // Changed from 300 to 500
    if (val.length > 5000) { if(show) showError(el, 'error_edit_abstract', 'Abstract must not exceed 5000 characters.'); return false; }
    if (show) clearError(el, 'error_edit_abstract'); else neutral(el, 'error_edit_abstract');
    return true;
}
function validateEditKeyword(show=true){
    const el = document.getElementById('edit_keyword');
    const val = (el.value || '').trim();
    if (!val) { if(show) showError(el, 'error_edit_keyword', 'Please provide at least one keyword.'); return false; }
    const items = parseKeywordsToArray(val);
    if (items.length === 0) { if(show) showError(el, 'error_edit_keyword', 'Please provide at least one keyword.'); return false; }
    if (items.length > 20) { if(show) showError(el, 'error_edit_keyword', 'Too many keywords. Maximum is 20.'); return false; }
    for (const item of items) {
        if (item.length > 60) { if(show) showError(el, 'error_edit_keyword', 'Each keyword must be at most 60 characters.'); return false; }
        if (!KEYWORD_ITEM_REGEX.test(item)) { if(show) showError(el, 'error_edit_keyword', 'Keywords may include letters, numbers, spaces, and . & ( ) \'/ + -'); return false; }
    }
    if (show) clearError(el, 'error_edit_keyword'); else neutral(el, 'error_edit_keyword');
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
function validateEditPublicationYear(show=true){
  const el = document.getElementById('edit_publication_year');
  const valRaw = (el.value || '').trim();
  const year = parseInt(valRaw, 10);
  if (!valRaw) { if (show) showError(el, 'error_edit_publication_year', 'Please enter the publication year.'); return false; }
  if (isNaN(year)) { if (show) showError(el, 'error_edit_publication_year', 'Publication year must be a number.'); return false; }
  if (year < 2021) { if (show) showError(el, 'error_edit_publication_year', 'Publication year must be 2021 or later.'); return false; }
  if (show) clearError(el, 'error_edit_publication_year'); else neutral(el, 'error_edit_publication_year');
  return true;
}
function validateEditForm(show=true){
    validateEditTitle(show);
    validateEditAuthor(show);
    validateEditArea(show);
    validateEditPublicationYear(show);
    validateEditAbstract(show);
    validateEditKeyword(show);
    validateEditFile(show);
}
function isEditFormValid(){
    return validateEditTitle(false) && validateEditAuthor(false) && validateEditArea(false) &&
           validateEditPublicationYear(false) && validateEditAbstract(false) && validateEditKeyword(false) && validateEditFile(false);
}
function updateEditSubmitState(){ const btn = document.getElementById('editSubmitBtn'); if (btn) btn.disabled = !isEditFormValid(); }
function clearEditErrors(){
    ['error_edit_title','error_edit_author','error_edit_research_area','error_edit_other_research_area','error_edit_publication_year','error_edit_abstract','error_edit_keyword','error_edit_file'].forEach(id=>{
        const n = document.getElementById(id); if(n){ n.textContent=''; n.style.display='none'; }
    });
    ['edit_title','edit_author','edit_research_area','edit_other_research_area','edit_publication_year','edit_abstract','edit_keyword'].forEach(id=>{
        const el = document.getElementById(id); if(el){ el.classList.remove('input-invalid','input-valid'); el.removeAttribute('aria-invalid'); }
    });
}
function validateField(inputEl, errorId, predicate, message){
    const ok = predicate(inputEl.value);
    if (!ok) showError(inputEl, errorId, message); else clearError(inputEl, errorId);
    return ok;
}

/* Pagination controls */
function applyFiltersAndPagination(){
    const rows = Array.from(document.querySelectorAll('.research-row'));
    const total = rows.length;
    const totalPages = Math.max(1, Math.ceil(total / PAGE_SIZE));
    if(currentPage > totalPages) currentPage = totalPages;

    rows.forEach(r=>{ r.style.display='none'; });

    if(total > 0){
        const startIdx = (currentPage-1)*PAGE_SIZE;
        const endIdx = startIdx + PAGE_SIZE;
        rows.slice(startIdx, endIdx).forEach(r=>{ r.style.display=''; });
        updateEmptyRow(false);
    } else {
        updateEmptyRow(true);
    }

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
function updateEmptyRow(showEmpty){
    const emptyRow = document.getElementById('emptyRow');
    if(emptyRow){
        emptyRow.style.display = showEmpty ? '' : 'none';
    }
}

document.addEventListener('DOMContentLoaded', function(){
    initFlashAutoHide('flashSuccess', 2500);
    initFlashAutoHide('flashError', 3500);

    // Click outside to close modals
    ['submitModal','editModal','abstractModal','commentModal','deleteModal','helpModal'].forEach(id=>{
        const el = document.getElementById(id);
        if (el) el.addEventListener('click', function(event){ if (event.target === this) { if (id==='submitModal') closeModal(); if (id==='editModal') closeEditModal(); if (id==='abstractModal') closeAbstractModal(); if (id==='commentModal') closeCommentModal(); if (id==='deleteModal') closeDeleteModal(); if (id==='helpModal') closeHelpModal(); } });
    });

    // Esc to close modals/alerts/sidebar
    document.addEventListener('keydown', function(event){
        if (event.key === 'Escape') {
            closeModal(); closeEditModal(); closeAbstractModal(); closeCommentModal(); closeDeleteModal(); closeSidebar(); closeLogoutModal(); closeHelpModal();
            ['flashSuccess','flashError'].forEach(id=>{ const el=document.getElementById(id); if(el){ el.classList.remove('show'); setTimeout(()=>{ if(el.parentNode){ el.parentNode.removeChild(el); } },200); } });
        }
    });

    // Sidebar auto-close on resize to desktop
    let resizeTimeout;
    window.addEventListener('resize', function(){
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function(){ if (window.innerWidth >= 992) closeSidebar(); }, 250);
    });

    // Delete form spinner
    const deleteForm = document.getElementById('deleteResearchForm');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(){
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) { submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Deleting...'; submitBtn.disabled = true; }
        });
    }

    // Create form wiring
    const createForm = document.getElementById('createResearchForm');
    if (createForm) {
        const cTitle = document.getElementById('create_title');
        const cAuthor = document.getElementById('create_author');
        const cArea = document.getElementById('research_area');
        const cOther = document.getElementById('create_other_research_area');
        const cYear = document.getElementById('create_publication_year');
        const cAbstract = document.getElementById('create_abstract');
        const cKeyword = document.getElementById('create_keyword');
        const cFile = document.getElementById('researchFileUpload');

        ['input','blur'].forEach(evt => {
            cTitle.addEventListener(evt, ()=> { validateCreateTitle(evt === 'blur'); updateCreateSubmitState(); });
            cAuthor.addEventListener(evt, ()=> { validateCreateAuthor(evt === 'blur'); updateCreateSubmitState(); });
            cOther.addEventListener(evt, ()=> { validateCreateArea(evt === 'blur'); updateCreateSubmitState(); });
            cYear.addEventListener(evt, ()=> { validateCreatePublicationYear(evt === 'blur'); updateCreateSubmitState(); });
            cAbstract.addEventListener(evt, ()=> { validateCreateAbstract(evt === 'blur'); updateCreateSubmitState(); });
        });

        cKeyword.addEventListener('input', ()=> {
            validateCreateKeyword(false);
            updateCreateSubmitState();
        });
        cKeyword.addEventListener('blur', ()=> {
            cKeyword.value = normalizeKeywordsString(cKeyword.value);
            validateCreateKeyword(true);
            updateCreateSubmitState();
        });

        cArea.addEventListener('change', ()=> { toggleOtherField(); validateCreateArea(true); updateCreateSubmitState(); });
        cFile.addEventListener('change', ()=> { validateCreateFile(true); updateCreateSubmitState(); });

        const oldArea = @json(old('research_area'));
        if (oldArea) { cArea.value = oldArea; toggleOtherField(); }
        updateCreateAbstractCounters();

        const activeForm = @json(session('active_form'));
        if (activeForm === 'create') {
            openModal();
            validateCreateTitle(true); validateCreateAuthor(true); validateCreateArea(true); validateCreatePublicationYear(true); validateCreateAbstract(true); validateCreateKeyword(true);
            updateCreateSubmitState();
        }

        createForm.addEventListener('submit', function(e){
            cKeyword.value = normalizeKeywordsString(cKeyword.value);

            const ok = validateCreateTitle(true) & validateCreateAuthor(true) & validateCreateArea(true) & validateCreatePublicationYear(true) & validateCreateAbstract(true) & validateCreateKeyword(true) & validateCreateFile(true);
            if (!ok) {
                e.preventDefault();
                const submitBtn = document.getElementById('createSubmitBtn'); if (submitBtn) submitBtn.disabled = true;
                const firstErr = document.querySelector('.field-error[style*="block"]'); if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            }
            const submitBtn = document.getElementById('createSubmitBtn');
            if (submitBtn) { submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Submitting...'; submitBtn.disabled = true; }
            return true;
        });
        updateCreateSubmitState();
    }

    // Edit form wiring
    const editForm = document.getElementById('editResearchForm');
    if (editForm) {
        const eTitle = document.getElementById('edit_title');
        const eAuthor = document.getElementById('edit_author');
        const eArea = document.getElementById('edit_research_area');
        const eOther = document.getElementById('edit_other_research_area');
        const eYear = document.getElementById('edit_publication_year');
        const eAbstract = document.getElementById('edit_abstract');
        const eKeyword = document.getElementById('edit_keyword');
        const eFile = document.getElementById('editFileUpload');

        ['input','blur'].forEach(evt => {
            eTitle.addEventListener(evt, ()=> { validateEditTitle(evt === 'blur'); updateEditSubmitState(); });
            eAuthor.addEventListener(evt, ()=> { validateEditAuthor(evt === 'blur'); updateEditSubmitState(); });
            eOther.addEventListener(evt, ()=> { validateEditArea(evt === 'blur'); updateEditSubmitState(); });
            eYear.addEventListener(evt, ()=> { validateEditPublicationYear(evt === 'blur'); updateEditSubmitState(); });
            eAbstract.addEventListener(evt, ()=> { validateEditAbstract(evt === 'blur'); updateEditSubmitState(); });
        });

        eKeyword.addEventListener('input', ()=> {
            validateEditKeyword(false);
            updateEditSubmitState();
        });
        eKeyword.addEventListener('blur', ()=> {
            eKeyword.value = normalizeKeywordsString(eKeyword.value);
            validateEditKeyword(true);
            updateEditSubmitState();
        });

        eArea.addEventListener('change', ()=> { toggleEditOtherField(); validateEditArea(true); updateEditSubmitState(); });
        eFile.addEventListener('change', ()=> { validateEditFile(true); updateEditSubmitState(); });

        const activeForm = @json(session('active_form'));
        const openEditId = @json(session('open_edit_id'));
        const oldEditArea = @json(old('research_area'));
        if (activeForm === 'edit') {
            if (openEditId) {
                editForm.action = updateUrlTemplate.replace('__ID__', openEditId);
                document.getElementById('edit_research_id').value = openEditId;
            }
            if (oldEditArea) { eArea.value = oldEditArea; toggleEditOtherField(); }
            updateEditAbstractCounters();
            validateEditForm(true);
            updateEditSubmitState();
            document.getElementById('editModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        editForm.addEventListener('submit', function(e){
            eKeyword.value = normalizeKeywordsString(eKeyword.value);

            const ok = validateEditTitle(true) & validateEditAuthor(true) & validateEditArea(true) & validateEditPublicationYear(true) & validateEditAbstract(true) & validateEditKeyword(true) & validateEditFile(true);
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

    // Pagination controls
    const prevBtn = document.getElementById('prevPageBtn');
    const nextBtn = document.getElementById('nextPageBtn');
    if(prevBtn){ prevBtn.addEventListener('click', function(){ if(currentPage>1){ currentPage--; applyFiltersAndPagination(); } }); }
    if(nextBtn){ nextBtn.addEventListener('click', function(){ currentPage++; applyFiltersAndPagination(); }); }
    const pagesEl = document.getElementById('paginationPages');
    if(pagesEl){
        pagesEl.addEventListener('click', function(e){
            const btn = e.target.closest('.page-number');
            if(!btn || !btn.dataset.page) return;
            const newPage = parseInt(btn.dataset.page, 10);
            if(!isNaN(newPage) && newPage !== currentPage){
                currentPage = newPage;
                applyFiltersAndPagination();
            }
        });
    }

    // Initial render
    applyFiltersAndPagination();
});
</script>

<script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
