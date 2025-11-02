<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Evaluation - CED's Academic Resources Management</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        :root{
            --primary-blue:#001f5b;--secondary-blue:#0056b3;--accent-blue:#4a90e2;--success-green:#28a745;--warning-yellow:#ffc107;--danger-red:#dc3545;--light-gray:#f8f9fa;--dark-gray:#6c757d;--shadow:0 4px 6px rgba(0,0,0,.1);--border-radius:12px;--transition:all .3s cubic-bezier(.4,0,.2,1)
        }
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:linear-gradient(135deg,#f5f7fa 0%,#c3cfe2 100%);min-height:100vh;color:#333}

        /* NAV */
        .navbar{background:linear-gradient(135deg,var(--primary-blue) 0%,var(--secondary-blue) 100%);box-shadow:var(--shadow);padding:1rem 0;position:sticky;top:0;z-index:1000}
        .logo{display:flex;align-items:center;font-weight:700;font-size:1.2rem}
        .logo img{height:50px;width:50px;border-radius:8px;margin-right:12px}
        .nav-links{display:flex;gap:1.5rem;align-items:center}
        .nav-links a{color:#fff;text-decoration:none;font-weight:500;padding:8px 16px;border-radius:8px;transition:var(--transition);position:relative}
        .nav-links a:hover{background:rgba(255,255,255,.2);transform:translateY(-2px)}
        .nav-links a.active{background:rgba(255,255,255,.3)}
        .navbar-toggler{border:none;color:#fff;font-size:1.5rem;padding:8px;border-radius:8px;transition:var(--transition)}
        .navbar-toggler:hover{background:rgba(255,255,255,.2)}
        .profile-img{width:35px;height:35px;border-radius:50%;object-fit:cover;border:2px solid rgba(255,255,255,.3);transition:var(--transition)}
        .profile-img:hover{border-color:rgba(255,255,255,.7);transform:scale(1.1)}

        .profile-section-nav {
            display:flex;flex-direction:column;align-items:center;gap:4px;
            padding:4px 12px;border-radius:8px;transition:var(--transition);text-decoration:none;
        }
        .profile-section-nav:hover { background: rgba(255,255,255,0.2); }
        .profile-name-nav {
            color: white; font-size: 0.75rem; font-weight: 500; white-space: nowrap; max-width: 120px;
            overflow: hidden; text-overflow: ellipsis; text-align: center;
        }

        /* Notification badge */
        .nav-links a .nav-badge,
        .mobile-sidebar a .nav-badge {
            background: var(--danger-red);
            color: #fff;
            border-radius: 999px;
            padding: 2px 8px;
            font-size: 0.75rem;
            margin-left: 0.5rem;
            line-height: 1;
            display: inline-block;
            vertical-align: middle;
        }

        /* MOBILE SIDEBAR */
        .mobile-sidebar{
            height:100vh;height:100dvh;width:0;
            position:fixed;top:0;left:0;
            background:linear-gradient(180deg,var(--primary-blue) 0%,var(--secondary-blue) 100%);
            overflow-x:hidden;overflow-y:auto;-webkit-overflow-scrolling:touch;
            overscroll-behavior:contain;touch-action:pan-y;
            transition:var(--transition);z-index:1050;
            padding-top:60px;padding-bottom:calc(24px + env(safe-area-inset-bottom));
        }
        .mobile-sidebar a{display:block;color:#fff;padding:15px 20px;text-decoration:none;font-weight:500;margin:5px 15px;border-radius:8px;transition:var(--transition)}
        .mobile-sidebar a:hover,.mobile-sidebar a.active{background:rgba(255,255,255,.2);transform:translateX(5px)}
        .mobile-sidebar .closebtn{position:absolute;top:15px;right:25px;font-size:30px;cursor:pointer;color:#fff;transition:var(--transition)}
        .mobile-sidebar .closebtn:hover{color:var(--warning-yellow)}
        .mobile-sidebar .profile-section{text-align:center;margin:20px 0;padding:0 20px;border-bottom:1px solid rgba(255,255,255,.2);padding-bottom:20px}
        .mobile-sidebar .profile-section img{width:80px;height:80px;border-radius:50%;object-fit:cover;margin-bottom:10px;border:3px solid rgba(255,255,255,.3)}
        .mobile-sidebar .profile-name-nav {
            color: white; font-size: 0.85rem; font-weight: 600; white-space: nowrap; max-width: 160px;
            overflow: hidden; text-overflow: ellipsis; display: block; margin: 4px auto 0;
        }
        .mobile-sidebar .role-badge{background:rgba(255,255,255,.2);color:#fff;padding:6px 16px;border-radius:20px;font-size:.85rem;font-weight:600;display:inline-block;margin-top:5px}
        .mobile-sidebar .logout-section{width:100%;padding:15px;margin-top:2rem;margin-bottom:env(safe-area-inset-bottom)}
        .mobile-sidebar .logout-btn{width:100%;background:var(--danger-red);color:#fff;border:none;padding:12px;border-radius:8px;font-weight:500;transition:var(--transition);display:flex;align-items:center;justify-content:center;gap:.5rem}
        .mobile-sidebar .logout-btn:hover{background:#c82333;transform:translateY(-2px)}

        @media (max-width: 480px) { .mobile-sidebar.open { width: min(280px, 85vw); } }
        @media (min-width: 481px) and (max-width: 991.98px) { .mobile-sidebar.open { width: min(260px, 90vw); } }

        /* MODALS */
        .modal-overlay {
            display: none; position: fixed; inset: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(4px); z-index: 2000;
            align-items: center; justify-content: center; animation: fadeIn 0.3s ease;
        }
        .modal-overlay.active { display: flex; }
        .logout-modal, .comment-required-modal {
            background: white; border-radius: var(--border-radius); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            max-width: 450px; width: 90%; overflow: hidden; animation: slideIn 0.3s ease; position: relative;
        }
        .logout-modal .modal-header { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; padding: 1.5rem 2rem; display: flex; align-items: center; gap: 1rem; }
        .comment-required-modal .modal-header { background: linear-gradient(135deg, var(--warning-yellow) 0%, #ffb800 100%); color: white; padding: 1.5rem 2rem; display: flex; align-items: center; gap: 1rem; }
        .logout-modal .modal-header i, .comment-required-modal .modal-header i { font-size: 2rem; }
        .modal-header-content h3 { margin: 0; font-size: 1.3rem; font-weight: 600; }
        .modal-header-content p { margin: 0.25rem 0 0 0; font-size: 0.9rem; opacity: 0.9; }
        .logout-modal .modal-body, .comment-required-modal .modal-body { padding: 2rem; text-align: center; }
        .logout-modal .modal-body p, .comment-required-modal .modal-body p { font-size: 1.1rem; color: var(--dark-gray); margin: 0 0 1.5rem 0; line-height: 1.6; }
        .modal-actions { display: flex; gap: 1rem; justify-content: center; }
        .modal-btn { padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: var(--transition); border: none; display: inline-flex; align-items: center; gap: 0.5rem; }
        .modal-btn:hover { transform: translateY(-2px); box-shadow:var(--shadow); }
        .modal-btn-cancel { background: var(--light-gray); color: var(--dark-gray); }
        .modal-btn-cancel:hover { background: #e2e6ea; }
        .modal-btn-confirm { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color: white; }
        .modal-btn-confirm:hover { box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4); }
        .modal-btn-ok { background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%); color: white; }
        .modal-btn-ok:hover { box-shadow: 0 4px 12px rgba(74, 144, 226, 0.4); }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideIn { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* MAIN */
        .main-container{padding:2rem 0}
        .page-header{text-align:center;margin-bottom:2rem;padding:0 1rem}
        .page-title{font-size:2.5rem;font-weight:700;color:var(--primary-blue);margin-bottom:.5rem;text-shadow:0 2px 4px rgba(0,0,0,.1)}
        .page-subtitle{font-size:1.1rem;color:var(--dark-gray);font-weight:400}

        /* ACTION BAR */
        .action-bar{background:#fff;border-radius:var(--border-radius);box-shadow:var(--shadow);padding:1.5rem;margin-bottom:2rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem}
        .toggle-buttons{display:flex;gap:.5rem;align-items:center;flex-wrap:wrap}
        .toggle-btn{background:linear-gradient(135deg,var(--primary-blue) 0%,var(--secondary-blue) 100%);color:#fff;border:none;padding:12px 24px;border-radius:25px;font-size:1rem;font-weight:600;cursor:pointer;transition:var(--transition);display:flex;align-items:center;gap:.5rem;box-shadow:var(--shadow)}
        .toggle-btn.active{background:linear-gradient(135deg,var(--success-green) 0%,#20c997 100%)}
        .toggle-btn:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,31,91,.3)}
        .search-form{display:flex;align-items:center;gap:.5rem;flex-wrap:wrap}
        .search-input{padding:12px 20px;border:2px solid var(--primary-blue);border-radius:25px;width:350px;font-size:1rem;transition:var(--transition);outline:none}
        .search-input:focus{border-color:var(--accent-blue);box-shadow:0 0 0 3px rgba(74,144,226,.1)}
        .search-btn{background:linear-gradient(135deg,var(--primary-blue) 0%,var(--secondary-blue) 100%);color:#fff;border:none;padding:12px 20px;border-radius:8px;font-weight:500;cursor:pointer;transition:var(--transition)}
        .search-btn:hover{transform:translateY(-2px);box-shadow:var(--shadow)}
        .clear-btn{background:var(--dark-gray);color:#fff;border:none;padding:12px 20px;border-radius:8px;font-weight:500;cursor:pointer;transition:var(--transition)}
        .clear-btn:hover{background:#5a6268;transform:translateY(-2px)}

        /* Help button */
        .help-btn { background:#fff; color:var(--primary-blue); border:2px solid var(--primary-blue); padding:10px; border-radius:50%; width:42px; height:42px; display:inline-flex; align-items:center; justify-content:center; box-shadow:var(--shadow); transition:var(--transition); }
        .help-btn:hover { background:rgba(255,255,255,0.9); transform:translateY(-2px); }

        /* TABLE */
        .table-container{background:#fff;border-radius:var(--border-radius);box-shadow:var(--shadow);overflow:hidden;margin-bottom:2rem}
        .table-header{background:linear-gradient(135deg,var(--primary-blue) 0%,var(--secondary-blue) 100%);color:#fff;padding:1rem 1.5rem;text-align:center}
        .table-header h3{margin:0;font-size:1.3rem;font-weight:600;display:flex;align-items:center;justify-content:center;gap:.5rem}
        .data-table{width:100%;border-collapse:collapse;font-size:.9rem}
        .data-table thead th { white-space: nowrap; vertical-align: middle; }
        .data-table thead th i { margin-right:.4rem; vertical-align: middle; }
        .data-table th,.data-table td{padding:15px 12px;text-align:left;border-bottom:1px solid rgba(0,0,0,.1)}
        .data-table th{font-weight:600;color:var(--primary-blue);letter-spacing:.3px;font-size:.85rem}
        .data-table tbody tr{transition:var(--transition)}
        .data-table tbody tr:hover{background:rgba(0,31,91,.03)}

        /* BADGES / BUTTONS */
        .status-badge{display:inline-flex;align-items:center;gap:.3rem;padding:6px 12px;border-radius:20px;font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px}
        .status-badge.approved{background:linear-gradient(135deg,var(--success-green) 0%,#20c997 100%);color:#fff}
        .status-badge.pending{background:linear-gradient(135deg,var(--warning-yellow) 0%,#ffb800 100%);color:#856404}
        .status-badge.returned{background:linear-gradient(135deg,var(--danger-red) 0%,#c82333 100%);color:#fff}
        .action-links{display:flex;gap:.5rem;align-items:center;flex-wrap:wrap}
        .action-btn{padding:6px 12px;border-radius:6px;text-decoration:none;font-size:.8rem;font-weight:500;transition:var(--transition);border:none;cursor:pointer;display:inline-flex;align-items:center;gap:.3rem}
        .action-btn.view{background:var(--accent-blue);color:#fff}
        .action-btn.download{background:var(--success-green);color:#fff}
        .action-btn.delete{background:var(--danger-red);color:#fff}
        .action-btn:hover{transform:translateY(-2px);box-shadow:var(--shadow)}

        /* EVALUATOR REVIEW SECTION */
        .evaluator-review-container { background: var(--light-gray); padding: 20px; border-radius: 12px; border-left: 4px solid var(--accent-blue); box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); }
        .evaluator-review-two-column { display: flex; gap: 20px; min-height: 200px; }
        .evaluator-column-left { flex: 0 0 200px; display: flex; flex-direction: column; }
        .evaluator-column-right { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .column-header { font-size: 0.9rem; font-weight: 600; color: var(--primary-blue); margin-bottom: 12px; padding: 6px 0; border-bottom: 2px solid var(--accent-blue); display: flex; align-items: center; gap: 6px; }
        .status-dropdown { padding: 12px 15px; border: 2px solid var(--primary-blue); border-radius: 8px; font-size: 0.95rem; transition: var(--transition); outline: none; width: 100%; background-color: white; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e"); background-position: right 15px center; background-repeat: no-repeat; background-size: 16px; appearance: none; }
        .status-dropdown:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1); }
        .comment-textarea { flex: 1; min-height: 140px; max-height: 200px; resize: vertical; padding: 15px; border: 2px solid var(--primary-blue); border-radius: 8px; font-size: 0.95rem; transition: var(--transition); outline: none; font-family: inherit; line-height: 1.5; background-color: white; margin-bottom: 12px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); }
        .comment-textarea:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.15), inset 0 1px 3px rgba(0, 0, 0, 0.1); }
        .comment-textarea::placeholder { color: #999; font-style: italic; }
        .form-buttons { display: flex; gap: 0.8rem; flex-shrink: 0; }
        .save-btn { background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: var(--transition); display: flex; align-items: center; gap: 0.4rem; }
        .save-btn:hover { transform: translateY(-1px); box-shadow: var(--shadow); }
        .cancel-btn { background: var(--dark-gray); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: var(--transition); display: flex; align-items: center; gap: 0.4rem; }
        .cancel-btn:hover { background: #5a6268; transform: translateY(-1px); }

        /* APPROVED DETAILS */
        .approved-action-cell { text-align: left; color: var(--dark-gray); padding: 1rem; }
        .comment-display-box { background: white; padding: 15px; border-radius: 8px; border-left: 4px solid var(--accent-blue); box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08); min-width: 300px; max-width: 500px; margin-top: 10px; }
        .comment-header { display: flex; align-items: center; gap: 8px; color: var(--primary-blue); font-weight: 600; font-size: 0.9rem; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 2px solid var(--light-gray); }
        .comment-header i { color: var(--accent-blue); font-size: 1rem; }
        .comment-text { font-size: 0.9rem; line-height: 1.6; color: var(--dark-gray); word-wrap: break-word; white-space: pre-wrap; }
        .no-comment-text { font-style: italic; color: var(--dark-gray); opacity: 0.6; font-size: 0.85rem; text-align: center; padding: 10px 0; }
        th#actionHeader, td.action-cell { min-width: 380px; }
        td.action-cell { vertical-align: top; }

        /* MISC */
        .datetime-info{font-size:.85rem;color:var(--dark-gray);line-height:1.3}
        .datetime-info .date{font-weight:600;color:var(--primary-blue)}
        .instructor-info{color:var(--primary-blue);font-weight:600}

        /* EMPTY */
        .empty-state{text-align:center;padding:3rem 2rem;color:var(--dark-gray)}
        .empty-state i{font-size:4rem;color:var(--primary-blue);margin-bottom:1rem;opacity:.6}
        .empty-state h4{margin-bottom:.5rem;color:var(--primary-blue)}

        /* FLASH ALERTS */
        .flash-alert{ position:fixed; top:90px; right:20px; display:flex; align-items:center; gap:.6rem; padding:12px 16px; border-radius:10px; box-shadow:0 10px 30px rgba(0,0,0,.15); z-index:2001; opacity:0; transform:translateY(-10px); transition:opacity .25s ease, transform var(--transition); max-width:460px; }
        .flash-alert.show{ opacity:1; transform:translateY(0); }
        .flash-alert i{ font-size:1.1rem; }
        .flash-alert .message{ flex:1; }
        .flash-alert .close{ background:transparent; border:0; color:inherit; cursor:pointer; width:32px; height:32px; border-radius:50%; display:grid; place-items:center; font-size:18px; transition:var(--transition); }
        .flash-alert .close:hover{ background:rgba(255,255,255,.2); transform:rotate(90deg); }
        .flash-alert.success{ background:linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color:#fff; }
        .flash-alert.danger{ background:linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color:#fff; }

        .saving-indicator { display: none; color: var(--primary-blue); font-weight: 600; margin-top: 8px; }

        /* HELP MODAL base */
        .custom-modal { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,.6); backdrop-filter:blur(5px); z-index:2000; justify-content:center; align-items:center; padding:1rem; overflow-y:auto; }
        .modal-content { background:white; border-radius:var(--border-radius); box-shadow:0 20px 60px rgba(0,0,0,.3); width:100%; max-width:800px; max-height:90vh; overflow:hidden; animation:modalSlideIn .3s ease-out; position:relative;}
        .modal-content.small { max-width: 400px; }
        @keyframes modalSlideIn { from{ transform:translateY(-50px); opacity:0;} to{ transform:translateY(0); opacity:1;} }
        .modal-header { background:linear-gradient(135deg,var(--primary-blue) 0%,var(--secondary-blue) 100%); color:white; padding:1.5rem 2rem; border-bottom:none; position:relative;}
        .modal-header.danger { background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); }
        .modal-title { font-size:1.4rem; font-weight:600; margin:0; display:flex; align-items:center; gap:.5rem;}
        .close-modal { position:absolute; top:15px; right:20px; background:none; border:none; color:white; font-size:24px; cursor:pointer; transition:var(--transition); width:35px; height:35px; display:flex; align-items:center; justify-content:center; border-radius:50%;}
        .close-modal:hover { background:rgba(255,255,255,.2); transform:rotate(90deg); }
        .modal-body { padding:2rem; max-height:60vh; overflow-y:auto;}
        .modal-body.text-center { text-align: center; }
        .abstract-info { background:var(--light-gray); padding:1rem; border-radius:8px; margin-bottom:1.5rem; border-left:4px solid var(--accent-blue);}
        .abstract-info h5 { color:var(--primary-blue); margin-bottom:.5rem; font-weight:600;}
        .abstract-info p { margin:.25rem 0; color:var(--dark-gray); }
        .abstract-modal-content { line-height:1.6; font-size:1rem; color:#333; text-align:justify;}
        .modal-footer { padding:1.5rem 2rem; background:var(--light-gray); border-top:1px solid rgba(0,0,0,.1); display:flex; justify-content:flex-end; gap:1rem;}
        .modal-btn { padding:12px 24px; border-radius:8px; font-weight:500; cursor:pointer; transition:var(--transition); border:none; font-size:1rem;}
        .modal-btn.secondary { background:var(--dark-gray); color:white;}
        .modal-btn.danger { background:var(--danger-red); color:white;}
        .modal-btn:hover { transform:translateY(-2px); box-shadow:var(--shadow);}

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

        /* RESPONSIVE */
        @media (max-width:1200px){.table-container{overflow-x:auto}.data-table{min-width:1600px}}
        @media (max-width:768px){
            .page-title{font-size:2rem}
            .action-bar{flex-direction:column;align-items:stretch}
            .search-input{width:100%}
            .data-table{font-size:.8rem}
            .data-table th,.data-table td{padding:10px 8px}
            .toggle-buttons{width:100%;justify-content:center;flex-wrap:wrap}
            .evaluator-review-container{padding:15px}
            .evaluator-review-two-column{flex-direction:column;gap:15px;min-height:auto}
            .evaluator-column-left{flex:none}
            .evaluator-column-right{flex:none}
            .comment-textarea{min-height:100px}
            .form-buttons{flex-direction:column}
            .save-btn,.cancel-btn{width:100%;justify-content:center}
            .flash-alert{ top:76px; left:12px; right:12px; max-width:none; }
            .pagination-container{ flex-direction:column; gap:.75rem; }
            .pagination-pages{ justify-content:center; }
        }
        @media (max-width:480px){
            .page-title{font-size:1.7rem}
            .action-bar{padding:1rem}
            .evaluator-review-container{padding:12px}
            .comment-textarea{min-height:80px}
            .modal-body{padding:1rem}
            .modal-footer{padding:1rem;flex-direction:column}
            .modal-btn{width:100%}
        }
        /* Responsive widths for comment box */
        @media (max-width: 768px) { .comment-display-box { min-width: 250px; max-width: 400px; } }
        @media (max-width: 480px) { .comment-display-box { min-width: 200px; max-width: 300px; } }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="CED Logo">
            <span style="color:white;">CED's Academic Resources Management</span>
        </div>

        <button class="navbar-toggler d-lg-none" type="button" onclick="openSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-links d-none d-lg-flex">
            <a href="{{ route('evaluator.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('evaluator.research') }}">
                <i class="fas fa-microscope me-2"></i>Research
                @if(isset($pendingResearchCount) && $pendingResearchCount > 0)
                    <span class="nav-badge">{{ $pendingResearchCount }}</span>
                @endif
            </a>
            <a href="{{ route('evaluator.syllabus') }}">
                <i class="fas fa-book me-2"></i>Syllabus
                @if(isset($pendingSyllabusCount) && $pendingSyllabusCount > 0)
                    <span class="nav-badge">{{ $pendingSyllabusCount }}</span>
                @endif
            </a>
            <a href="{{ route('evaluator.exam') }}" class="active">
                <i class="fas fa-clipboard-list me-2"></i>Exam Bank
                @if(isset($pendingExamCount) && $pendingExamCount > 0)
                    <span class="nav-badge">{{ $pendingExamCount }}</span>
                @endif
            </a>
            <a href="{{ route('settings.evaluator') }}" class="profile-section-nav">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" 
                         alt="Profile Picture" class="profile-img">
                @else
                    <i class="fas fa-user-circle" style="font-size: 30px; color:white;"></i>
                @endif
                <span class="profile-name-nav">{{ Auth::user()->name }}</span>
            </a>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar -->
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

    <a href="{{ route('evaluator.dashboard') }}" onclick="closeSidebar()"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ route('evaluator.research') }}" onclick="closeSidebar()">
        <i class="fas fa-microscope me-2"></i>Research
        @if(isset($pendingResearchCount) && $pendingResearchCount > 0)
            <span class="nav-badge">{{ $pendingResearchCount }}</span>
        @endif
    </a>
    <a href="{{ route('evaluator.syllabus') }}" onclick="closeSidebar()">
        <i class="fas fa-book me-2"></i>Syllabus
        @if(isset($pendingSyllabusCount) && $pendingSyllabusCount > 0)
            <span class="nav-badge">{{ $pendingSyllabusCount }}</span>
        @endif
    </a>
    <a href="{{ route('evaluator.exam') }}" class="active" onclick="closeSidebar()">
        <i class="fas fa-clipboard-list me-2"></i>Exam Bank
        @if(isset($pendingExamCount) && $pendingExamCount > 0)
            <span class="nav-badge">{{ $pendingExamCount }}</span>
        @endif
    </a>
    <a href="{{ route('settings.evaluator') }}" onclick="closeSidebar()"><i class="fas fa-user me-2"></i>Profile</a>
    <a href="{{ route('evaluator.settings.edit') }}" onclick="closeSidebar()"><i class="fas fa-user-edit me-2"></i>Edit Profile</a>

    <div class="logout-section">
        <button type="button" class="logout-btn" onclick="showLogoutModal()">
            <i class="fas fa-sign-out-alt me-2"></i>Logout
        </button>
    </div>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="modal-overlay" onclick="closeModalOnOverlay(event, 'logout')">
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
                <button type="button" class="modal-btn modal-btn-cancel" onclick="closeLogoutModal()">
                    <i class="fas fa-times"></i>Cancel
                </button>
                <button type="button" class="modal-btn modal-btn-confirm" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i>Yes, Logout
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Comment Required Modal -->
<div id="commentRequiredModal" class="modal-overlay" onclick="closeModalOnOverlay(event, 'comment')">
    <div class="comment-required-modal">
        <div class="modal-header">
            <i class="fas fa-exclamation-circle"></i>
            <div class="modal-header-content">
                <h3>Comment Required</h3>
                <p>Please provide feedback</p>
            </div>
        </div>
        <div class="modal-body">
            <p>Please add a comment explaining why this exam is being returned to the faculty member.</p>
            <div class="modal-actions">
                <button type="button" class="modal-btn modal-btn-ok" onclick="closeCommentRequiredModal()">
                    <i class="fas fa-check"></i>OK, I'll add a comment
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
                <i class="fas fa-exclamation-triangle"></i>
                <span class="message">{{ session('error') }}</span>
                <button type="button" class="close" data-close>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <div class="page-header">
            <h1 class="page-title">Exam Evaluation</h1>
            <p class="page-subtitle">Evaluate and manage faculty exam submissions</p>
        </div>

        <div class="action-bar">
            <div class="toggle-buttons">
                <button class="toggle-btn" id="pendingBtn" onclick="showPendingExams()">
                    <i class="fas fa-clock"></i>Pending Exams
                </button>
                <button class="toggle-btn" id="approvedBtn" onclick="showApprovedExams()">
                    <i class="fas fa-check-circle"></i>Approved Exams
                </button>
                <button type="button" class="help-btn" onclick="openHelpModal()" aria-label="How to evaluate" title="How to evaluate">
                    <i class="fas fa-info-circle"></i>
                </button>
            </div>

            <form class="search-form" action="{{ route('evaluator.exam') }}" method="GET">
                @php
                    $examTypes = $exams->pluck('exam_type')->filter()->unique()->sort();
                    $academicYears = $exams->pluck('academic_year')->filter()->unique()->sortDesc();
                @endphp
                <input type="hidden" name="view" id="searchView" value="{{ request('view', 'pending') }}">

                <select name="exam_type" id="examTypeFilter" class="form-select" style="padding: 12px 16px; border: 2px solid var(--primary-blue); border-radius: 25px; width: 80px;">
                    <option value="">Type</option>
                    @foreach($examTypes as $type)
                        <option value="{{ $type }}" {{ request('exam_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>

                <input type="text" name="search" class="search-input" placeholder="Search course code or title..." value="{{ request('search') }}" style="width: 230px;">

                <select name="year" id="yearFilter" class="form-select" style="padding: 12px 16px; border: 2px solid var(--primary-blue); border-radius: 25px; width: 75px;">
                    <option value="">Year</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>

                <button type="submit" class="search-btn"><i class="fas fa-search me-1"></i>Search</button>
                <a href="{{ route('evaluator.exam', ['view' => request('view', 'pending')]) }}" class="clear-btn" style="text-decoration:none;"><i class="fas fa-times me-1"></i>Clear</a>
            </form>
        </div>

        <div class="table-container">
            <div class="table-header">
                <h3 id="tableTitle"><i class="fas fa-clock me-2"></i>Pending Exam Evaluations</h3>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-file-alt me-1"></i>EXAM TYPE</th>
                            <th><i class="fas fa-journal-whills me-1"></i>COURSE CODE</th>
                            <th><i class="fas fa-book me-1"></i>COURSE TITLE</th>
                            <th><i class="fas fa-calendar-week me-1"></i>SEMESTER</th>
                            <th><i class="fas fa-calendar me-1"></i>ACADEMIC YEAR</th>
                            <th><i class="fas fa-university me-1"></i>CAMPUS</th>
                            <th><i class="fas fa-building me-1"></i>COLLEGE</th>
                            <th><i class="fas fa-user me-1"></i>INSTRUCTOR</th>
                            <th><i class="fas fa-calendar me-1"></i>SUBMITTED</th>
                            <th><i class="fas fa-file me-1"></i>FILE</th>
                            <th><i class="fas fa-info-circle me-1"></i>STATUS</th>
                            <th id="actionHeader"><i class="fas fa-cog me-1"></i>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="examTableBody">
                        @forelse ($exams as $exam)
                            <tr class="exam-row"
                                data-status="{{ $exam->status }}"
                                data-exam-type="{{ $exam->exam_type }}"
                                data-year="{{ $exam->academic_year }}"
                                data-search-text="{{ strtolower($exam->exam_id . ' ' . $exam->exam_type . ' ' . $exam->course_code . ' ' . $exam->course_title . ' ' . $exam->instructor . ' ' . $exam->campus . ' ' . $exam->college . ' ' . $exam->semester . ' ' . $exam->academic_year) }}">
                                <td><strong>{{ $exam->exam_id }}</strong></td>
                                <td><span class="badge bg-info text-dark">{{ $exam->exam_type }}</span></td>
                                <td><span class="badge bg-primary">{{ $exam->course_code }}</span></td>
                                <td><strong>{{ $exam->course_title }}</strong></td>
                                <td>{{ $exam->semester }}</td>
                                <td>{{ $exam->academic_year }}</td>
                                <td>{{ $exam->campus }}</td>
                                <td>{{ $exam->college }}</td>
                                <td><strong><div class="instructor-info">{{ $exam->instructor }}</div></strong></td>
                                <td>
                                    <div class="datetime-info">
                                        <div class="date">{{ $exam->created_at->setTimezone('Asia/Manila')->format('M d, Y') }}</div>
                                        <div class="time">{{ $exam->created_at->setTimezone('Asia/Manila')->format('h:i A') }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-links">
                                        @if ($exam->status === 'Approved')
                                            <a href="{{ route('evaluator.exam.view', $exam->exam_id) }}" target="_blank" class="action-btn view"><i class="fas fa-eye"></i>View</a>
                                            <a href="{{ route('evaluator.exam.download', $exam->exam_id) }}" class="action-btn download"><i class="fas fa-download"></i>Download</a>
                                            <button type="button" class="action-btn delete" onclick="confirmDelete({{ $exam->exam_id }}, '{{ addslashes($exam->course_code) }} - {{ addslashes($exam->exam_type) }}')">
                                                <i class="fas fa-trash"></i>Delete
                                            </button>
                                        @else
                                            <a href="{{ route('evaluator.exam.view', $exam->exam_id) }}" target="_blank" class="action-btn view"><i class="fas fa-eye"></i>View</a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if ($exam->status === 'Approved')
                                        <span class="status-badge approved"><i class="fas fa-check-circle"></i>Approved</span>
                                    @elseif ($exam->status === 'Returned')
                                        <span class="status-badge returned"><i class="fas fa-exclamation-triangle"></i>Returned</span>
                                    @else
                                        <span class="status-badge pending"><i class="fas fa-clock"></i>Pending</span>
                                    @endif
                                </td>
                                <td class="action-cell">
                                    @if ($exam->status !== 'Approved')
                                        <div class="evaluator-review-container">
                                            <form action="{{ route('evaluator.exam.update', $exam->exam_id) }}" method="POST" class="js-evaluator-review-form">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="evaluator-review-two-column">
                                                    <div class="evaluator-column-left">
                                                        <div class="column-header"><i class="fas fa-tasks"></i>Update Status</div>
                                                        <select name="status" class="status-dropdown" required>
                                                            <option value="Pending" {{ $exam->status == 'Pending' ? 'selected' : '' }}>Pending Review</option>
                                                            <option value="Approved" {{ $exam->status == 'Approved' ? 'selected' : '' }}>Approve Exam</option>
                                                            <option value="Returned" {{ $exam->status == 'Returned' ? 'selected' : '' }}>Return for Revision</option>
                                                        </select>
                                                    </div>
                                                    <div class="evaluator-column-right">
                                                        <div class="column-header"><i class="fas fa-comment"></i>Evaluator Comment (Will be sent to Faculty)</div>
                                                        <textarea name="evaluator_comment" class="comment-textarea" placeholder="Add your detailed evaluation comments here... (optional but recommended for returned exams)">{{ $exam->evaluator_comment }}</textarea>
                                                        <div class="form-buttons">
                                                            <button type="submit" class="save-btn"><i class="fas fa-save"></i>Save Changes</button>
                                                            <button type="reset" class="cancel-btn"><i class="fas fa-undo"></i>Reset Form</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="approved-action-cell">
                                            <i class="fas fa-check-circle me-1"></i>Exam Approved
                                            <div class="comment-display-box">
                                                <div class="comment-header">
                                                    <i class="fas fa-user-graduate"></i>
                                                    <span>Evaluator's Comment</span>
                                                </div>
                                                @if($exam->evaluator_comment)
                                                    <div class="comment-text">{{ $exam->evaluator_comment }}</div>
                                                @else
                                                    <div class="no-comment-text"><i class="fas fa-comment-slash me-1"></i>No evaluator comment yet</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="13">
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <h4 id="emptyTitle">No Exam Submissions Found</h4>
                                        <p id="emptyMessage">There are no exam submissions to evaluate at this time.</p>
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay">
    <div class="logout-modal">
        <div class="modal-header">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="modal-header-content">
                <h3>Confirm Delete</h3>
                <p>This action cannot be undone</p>
            </div>
        </div>
        <div class="modal-body">
            <div style="margin-bottom: 1.5rem;">
                <i class="fas fa-trash-alt" style="font-size: 3rem; color: var(--danger-red); margin-bottom: 1rem;"></i>
                <h4 style="color: var(--primary-blue); margin-bottom: 1rem;">Delete Exam Submission</h4>
                <p style="color: var(--dark-gray); line-height: 1.5;">
                    Are you sure you want to delete this exam? This action cannot be undone.
                </p>
                <div style="background: var(--light-gray); padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid var(--danger-red);">
                    <strong id="deleteExamTitle" style="color: var(--primary-blue);">Exam Title</strong>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>Cancel
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-btn modal-btn-confirm">
                        <i class="fas fa-trash"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Help / Tutorial Modal -->
<div id="helpModal" class="custom-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fas fa-info-circle"></i>Evaluator Guide</h3>
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
                        <source src="{{ asset('videos/ExamEvaluationTutorial.mp4') }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                        <a href="{{ asset('videos/ExamEvaluationTutorial.mp4') }}">Download the video</a>.
                    </video>
                </div>
            </div>

            <div class="abstract-info">
                <h5>Quick summary</h5>
                <ul class="mb-0">
                    <li><small>Switch between <strong>Pending Exams</strong> and <strong>Approved Exams</strong>.</small></li>
                    <li><small>Use <strong>Search</strong> to filter by exam type, course, semester, year, campus, college, or instructor.</small></li>
                    <li><small>Open the submitted <strong>file</strong> to verify content.</small></li>
                    <li><small>Select a <strong>Status</strong>: Pending, Approved, or Returned.</small></li>
                    <li><small>When choosing <strong>Returned</strong>, a <strong>comment is required</strong> and shown to the faculty.</small></li>
                    <li><small>Click <strong>Save Changes</strong> to submit your evaluation.</small></li>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-btn secondary" onclick="closeHelpModal()"><i class="fas fa-times me-1"></i>Close</button>
        </div>
    </div>
</div>

<script>
let currentView='{{ request("view","pending") }}';
let currentFormSubmitting = null;

/* Pagination state */
const PAGE_SIZE = 5;
let currentPage = 1;

const initialSearchTermRaw = @json(request('search', ''));
const initialYearFilterRaw = @json(request('year', ''));
const initialExamTypeRaw = @json(request('exam_type', ''));
const filterSearchTerm = (initialSearchTermRaw || '').toString().toLowerCase().trim();
const filterYear = (initialYearFilterRaw || '').toString().trim();
const filterExamType = (initialExamTypeRaw || '').toString().trim();
const filtersActive = filterSearchTerm !== '' || filterYear !== '' || filterExamType !== '';

function openSidebar(){
    const sidebar = document.getElementById("mobileSidebar");
    const vw = window.innerWidth || document.documentElement.clientWidth;
    const targetWidth = vw <= 480 ? Math.min(280, Math.floor(vw * 0.85)) : Math.min(260, Math.floor(vw * 0.90));
    sidebar.style.width = targetWidth + "px";
    sidebar.classList.add('open');
    document.body.style.overflow='hidden';
}
function closeSidebar(){
    const sidebar = document.getElementById("mobileSidebar");
    sidebar.classList.remove('open');
    sidebar.style.width="0";
    document.body.style.overflow='auto';
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

function showLogoutModal(){ document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow='hidden'; }
function closeLogoutModal(){ document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow='auto'; }
function closeModalOnOverlay(event, modalType){
    if(modalType === 'logout' && event.target.id === 'logoutModal') closeLogoutModal();
    if(modalType === 'comment' && event.target.id === 'commentRequiredModal') closeCommentRequiredModal();
}
function confirmLogout(){ document.getElementById('logoutForm').submit(); }

function showCommentRequiredModal(form) {
    currentFormSubmitting = form;
    document.getElementById('commentRequiredModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeCommentRequiredModal() {
    document.getElementById('commentRequiredModal').classList.remove('active');
    document.body.style.overflow = 'auto';
    if (currentFormSubmitting) {
        const textarea = currentFormSubmitting.querySelector('textarea[name="evaluator_comment"]');
        if (textarea) { textarea.focus(); }
        currentFormSubmitting = null;
    }
}

function confirmDelete(examId, examTitle) {
    document.getElementById("deleteExamTitle").textContent = examTitle;
    document.getElementById("deleteForm").action = `/evaluator/exam/${examId}`;
    document.getElementById("deleteModal").classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeDeleteModal() {
    document.getElementById("deleteModal").classList.remove('active');
    document.body.style.overflow = 'auto';
}

/* Unified filtering + pagination */
function applyFiltersAndPagination(){
    const allowed = currentView==='approved' ? ['Approved'] : ['Pending','Returned'];
    const rows = Array.from(document.querySelectorAll('.exam-row'));
    const matching = [];

    rows.forEach(row=>{
        const status=row.getAttribute('data-status');
        const text=row.getAttribute('data-search-text')||'';
        const rowYear=(row.getAttribute('data-year')||'').toString().trim();
        const rowType=(row.getAttribute('data-exam-type')||'').toString().trim();
        const matchesStatus = allowed.includes(status);
        const matchesSearch = filterSearchTerm === '' || text.includes(filterSearchTerm);
        const matchesYear = filterYear === '' || rowYear === filterYear;
        const matchesType = filterExamType === '' || rowType === filterExamType;
        if(matchesStatus && matchesSearch && matchesYear && matchesType){
            matching.push(row);
        }
    });

    const total = matching.length;
    const totalPages = Math.max(1, Math.ceil(total / PAGE_SIZE));
    if(currentPage > totalPages) currentPage = totalPages;

    rows.forEach(r=>{ r.style.display='none'; });

    if(total > 0){
        const startIdx = (currentPage-1)*PAGE_SIZE;
        const endIdx = startIdx + PAGE_SIZE;
        matching.slice(startIdx, endIdx).forEach(r=>{ r.style.display=''; });
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

function getEmptyStateCopy(view){
    const usingFilters = filtersActive;
    if(view==='approved'){
        return {
            title: 'No Approved Exams Found',
            message: usingFilters
                ? 'No approved exam submissions match your filters.'
                : 'There are no approved exam submissions to display at this time.'
        };
    }
    return {
        title: 'No Pending Exams Found',
        message: usingFilters
            ? 'No pending exam submissions match your filters.'
            : 'There are no pending exam submissions to evaluate at this time.'
    };
}

function updateEmptyState(view){
    const { title, message } = getEmptyStateCopy(view);
    const t=document.getElementById('emptyTitle');
    const m=document.getElementById('emptyMessage');
    if(t) t.textContent=title;
    if(m) m.textContent=message;
}

function updateEmptyRow(showEmpty){
    const tbody = document.getElementById('examTableBody');
    let emptyRow = document.getElementById('emptyRow');
    let clientEmptyRow = document.getElementById('clientEmptyRow');

    if(showEmpty){
        const { title, message } = getEmptyStateCopy(currentView);
        if(emptyRow){
            emptyRow.style.display='';
            const t = document.getElementById('emptyTitle');
            const m = document.getElementById('emptyMessage');
            if(t) t.textContent = title;
            if(m) m.textContent = message;
        } else if(tbody){
            if(!clientEmptyRow){
                clientEmptyRow = document.createElement('tr');
                clientEmptyRow.id = 'clientEmptyRow';
                const td = document.createElement('td');
                td.colSpan = 13;
                td.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-clipboard-list"></i>
                        <h4 id="clientEmptyTitle"></h4>
                        <p id="clientEmptyMessage"></p>
                    </div>
                `;
                clientEmptyRow.appendChild(td);
                tbody.appendChild(clientEmptyRow);
            }
            const t = document.getElementById('clientEmptyTitle');
            const m = document.getElementById('clientEmptyMessage');
            if(t) t.textContent = title;
            if(m) m.textContent = message;
            clientEmptyRow.style.display='';
        }
    } else {
        if(emptyRow){ emptyRow.style.display='none'; }
        if(clientEmptyRow){ clientEmptyRow.style.display='none'; }
    }
}

function showPendingExams(){
    currentView='pending';
    currentPage=1;
    document.getElementById('searchView').value='pending';
    document.getElementById('pendingBtn').classList.add('active');
    document.getElementById('approvedBtn').classList.remove('active');
    document.getElementById('tableTitle').innerHTML='<i class="fas fa-clock me-2"></i>Pending Exam Evaluations';
    document.getElementById('actionHeader').innerHTML='<i class="fas fa-cog me-1"></i>ACTIONS';
    applyFiltersAndPagination();
}
function showApprovedExams(){
    currentView='approved';
    currentPage=1;
    document.getElementById('searchView').value='approved';
    document.getElementById('approvedBtn').classList.add('active');
    document.getElementById('pendingBtn').classList.remove('active');
    document.getElementById('tableTitle').innerHTML='<i class="fas fa-check-circle me-2"></i>Approved Exams';
    document.getElementById('actionHeader').innerHTML='<i class="fas fa-info-circle me-1"></i>DETAILS';
    applyFiltersAndPagination();
}
function filterExamsByStatus(){ currentPage=1; applyFiltersAndPagination(); }

function autoResizeTextarea(textarea){
    textarea.style.height='auto';
    textarea.style.height=Math.min(textarea.scrollHeight,200)+'px';
}

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

document.addEventListener('DOMContentLoaded',function(){
    const urlParams=new URLSearchParams(window.location.search);
    const view=urlParams.get('view')||'pending';
    if(view==='approved'){showApprovedExams()} else {showPendingExams()}

    const deleteForm = document.getElementById('deleteForm');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Deleting...';
                submitBtn.disabled = true;
            }
        });
    }

    const deleteModal = document.getElementById('deleteModal');
    if(deleteModal){
        deleteModal.addEventListener('click',function(e){
            if(e.target===this){closeDeleteModal();}
        });
    }

    const helpModal=document.getElementById('helpModal');
    if(helpModal){
        helpModal.addEventListener('click',function(e){
            if(e.target===this){closeHelpModal();}
        });
    }

    document.querySelectorAll('.comment-textarea').forEach(ta=>{
        autoResizeTextarea(ta);
        ta.addEventListener('input',function(){autoResizeTextarea(this)});
        ta.addEventListener('paste',function(){setTimeout(()=>autoResizeTextarea(this),0)});
    });

    document.querySelectorAll('.js-evaluator-review-form').forEach(form=>{
        form.addEventListener('submit',function(e){
            const status=this.querySelector('select[name="status"]').value;
            const comment=(this.querySelector('textarea[name="evaluator_comment"]')?.value||'').trim();
            if(status==='Returned'&&!comment){
                e.preventDefault();
                showCommentRequiredModal(this);
                return false;
            }
            const saveBtn=this.querySelector('.save-btn');
            const cancelBtn=this.querySelector('.cancel-btn');
            if(saveBtn){ saveBtn.innerHTML='<i class="fas fa-spinner fa-spin me-1"></i>Saving...'; saveBtn.disabled=true; }
            if(cancelBtn){ cancelBtn.disabled=true; }
            const savingIndicator=this.querySelector('.saving-indicator');
            if(savingIndicator){ savingIndicator.style.display='inline-flex'; }
        });
    });

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

    document.addEventListener('keydown',function(e){
        if(e.key==='Escape'){
            closeSidebar();
            closeLogoutModal();
            closeDeleteModal();
            closeCommentRequiredModal();
            closeHelpModal();
            ['flashSuccess','flashError'].forEach(id=>{
                const el=document.getElementById(id);
                if(el){
                    el.classList.remove('show');
                    setTimeout(()=>{if(el.parentNode){el.parentNode.removeChild(el);}},200);
                }
            });
        }
    });

    let resizeTimeout;
    window.addEventListener('resize',function(){
        clearTimeout(resizeTimeout);
        resizeTimeout=setTimeout(function(){
            if(window.innerWidth>=992){closeSidebar();}
        },250);
    });

    initFlashAutoHide('flashSuccess', 2500);
    initFlashAutoHide('flashError', 3500);
});
</script>

<script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
