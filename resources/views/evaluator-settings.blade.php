<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluator Profile - CED's Academic Resources Management</title>
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

        .navbar { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); box-shadow: var(--shadow); padding: 1rem 0; position: sticky; top: 0; z-index: 1000; }
        .logo { display: flex; align-items: center; font-weight: 700; font-size: 1.2rem; }
        .logo img { height: 50px; width: 50px; border-radius: 8px; margin-right: 12px; }
        .nav-links { display: flex; gap: 1.5rem; align-items: center; }
        .nav-links a { color: white; text-decoration: none; font-weight: 500; padding: 8px 16px; border-radius: 8px; transition: var(--transition); position: relative; }
        .nav-links a:hover { background: rgba(255,255,255,0.2); transform: translateY(-2px); }
        .nav-links a.active { background: rgba(255,255,255,0.3); }
        .nav-links a .nav-badge {
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
        .navbar-toggler { border: none; color: white; font-size: 1.5rem; padding: 8px; border-radius: 8px; transition: var(--transition); }
        .navbar-toggler:hover { background: rgba(255,255,255,0.2); }

        .profile-section-nav{ display:flex; flex-direction:column; align-items:center; gap:4px; padding:4px 12px; border-radius:8px; transition:var(--transition); text-decoration:none; }
        .profile-section-nav:hover{ background:rgba(255,255,255,0.2); }
        .profile-img { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(255, 255, 255, 0.3); transition: var(--transition); }
        .profile-section-nav:hover .profile-img { border-color: rgba(255, 255, 255, 0.7); transform: scale(1.1); }
        .profile-name-nav{ color:white; font-size:.75rem; font-weight:500; white-space:nowrap; max-width:120px; overflow:hidden; text-overflow:ellipsis; text-align:center; line-height:1.1; }

        .mobile-sidebar{ height:100vh; height:100dvh; width:0; position:fixed; top:0; left:0; background:linear-gradient(180deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); overflow-x:hidden; overflow-y:auto; -webkit-overflow-scrolling:touch; overscroll-behavior:contain; touch-action:pan-y; transition:var(--transition); z-index:1050; padding-top:60px; padding-bottom:calc(24px + env(safe-area-inset-bottom)); }
        .mobile-sidebar a{ display:block; color:white; padding:15px 20px; text-decoration:none; font-weight:500; margin:5px 15px; border-radius:8px; transition: var(--transition); }
        .mobile-sidebar a:hover, .mobile-sidebar a.active{ background:rgba(255,255,255,0.2); transform:translateX(5px); }
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
        .mobile-sidebar .closebtn{ position:absolute; top:15px; right:25px; font-size:30px; cursor:pointer; color:white; transition:var(--transition); }
        .mobile-sidebar .closebtn:hover{ color:var(--warning-yellow); }
        .mobile-sidebar .profile-section{ text-align:center; margin:20px 0; padding:0 20px; border-bottom:1px solid rgba(255,255,255,0.2); padding-bottom:20px; }
        .mobile-sidebar .profile-section img{ width:80px; height:80px; border-radius:50%; object-fit:cover; margin-bottom:10px; border:3px solid rgba(255,255,255,0.3); }
        .mobile-sidebar .profile-name-nav{ color:white; font-size:.85rem; font-weight:600; white-space:nowrap; max-width:160px; overflow:hidden; text-overflow:ellipsis; display:block; margin:4px auto 0; }
        .mobile-sidebar .role-badge{ background:rgba(255,255,255,0.2); color:white; padding:6px 16px; border-radius:20px; font-size:.85rem; font-weight:600; display:inline-block; margin-top:5px; }
        .mobile-sidebar .logout-section{ width:100%; padding:15px; margin-top:2rem; margin-bottom:env(safe-area-inset-bottom); }
        .mobile-sidebar .logout-btn{ width:100%; background:var(--danger-red); color:white; border:none; padding:12px; border-radius:8px; font-weight:500; transition:var(--transition); display:flex; align-items:center; justify-content:center; gap:.5rem; }
        .mobile-sidebar .logout-btn:hover{ background:#c82333; transform:translateY(-2px); }
        @media (max-width: 480px){ .mobile-sidebar.open { width: min(280px, 85vw); } }
        @media (min-width: 481px) and (max-width: 991.98px){ .mobile-sidebar.open { width: min(260px, 90vw); } }

        /* Modals shared */
        .modal-overlay{ display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index:2000; align-items:center; justify-content:center; animation: fadeIn .3s ease; }
        .modal-overlay.active{ display:flex; }
        .logout-modal{ background:white; border-radius:var(--border-radius); box-shadow:0 10px 40px rgba(0,0,0,.3); max-width:450px; width:90%; overflow:hidden; animation: slideIn .3s ease; position:relative; }
        .modal-header{ background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color:white; padding:1.5rem 2rem; display:flex; align-items:center; gap:1rem; position:relative; }
        .modal-header i{ font-size:2rem; }
        .modal-header-content h3{ margin:0; font-size:1.3rem; font-weight:600; }
        .modal-header-content p{ margin:.25rem 0 0 0; font-size:.9rem; opacity:.9; }
        /* Rotating close button (match faculty submit modal) */
        .close-modal{
            position:absolute; top:10px; right:12px; background:none; border:none; color:#fff; font-size:1.25rem; cursor:pointer; line-height:1;
            width:35px; height:35px; display:flex; align-items:center; justify-content:center; border-radius:50%; transition: var(--transition);
        }
        .close-modal:hover{ background: rgba(255, 255, 255, 0.2); transform: rotate(90deg); }

        .modal-body{ padding:2rem; text-align:center; }
        .modal-body p{ font-size:1.1rem; color:var(--dark-gray); margin:0 0 1.5rem 0; line-height:1.6; }
        .modal-actions{ display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }
        .modal-btn{ padding:12px 30px; border:none; border-radius:8px; font-weight:600; font-size:1rem; cursor:pointer; transition:var(--transition); display:flex; align-items:center; gap:.5rem; }
        .modal-btn-cancel{ background:var(--light-gray); color:var(--dark-gray); }
        .modal-btn-cancel:hover{ background:#e2e6ea; transform:translateY(-2px); }
        .modal-btn-confirm{ background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color:white; }
        .modal-btn-confirm:hover{ transform:translateY(-2px); box-shadow:0 4px 12px rgba(220,53,69,.4); }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideIn { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        .main-container{ padding:2rem 0; }
        .page-header{ text-align:center; margin-bottom:3rem; padding:0 1rem; }
        .page-title{ font-size:2.5rem; font-weight:700; color:var(--primary-blue); margin-bottom:.5rem; text-shadow:0 2px 4px rgba(0,0,0,0.1); }
        .page-subtitle{ font-size:1.1rem; color:var(--dark-gray); font-weight:400; }

        .profile-container{ display:grid; grid-template-columns:350px 1fr; gap:2rem; margin-bottom:2rem; }
        .profile-card{ background:white; border-radius:var(--border-radius); box-shadow:var(--shadow); padding:2rem; text-align:center; height:fit-content; position:sticky; top:2rem; }
        .profile-image-container{ position:relative; display:inline-block; margin-bottom:1.5rem; }
        .profile-image{ width:150px; height:150px; border-radius:50%; object-fit:cover; border:5px solid var(--accent-blue); box-shadow:var(--shadow); }
        .profile-name{ font-size:1.5rem; font-weight:700; color:var(--primary-blue); margin-bottom:.5rem; }
        .profile-role{ background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color:white; padding:8px 20px; border-radius:25px; font-size:.9rem; font-weight:600; text-transform:uppercase; letter-spacing:.5px; display:inline-block; margin-bottom:1rem; }

        .profile-actions{ display:flex; flex-direction:column; gap:1rem; }
        .profile-btn{ padding:12px 20px; border-radius:8px; text-decoration:none; font-weight:500; transition:var(--transition); display:flex; align-items:center; justify-content:center; gap:.5rem; border:none; cursor:pointer; font-size:1rem; }
        .profile-btn.primary{ background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%); color:white; }
        .profile-btn.secondary{ background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%); color:white; }
        .profile-btn.danger{ background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%); color:white; }
        .profile-btn:hover{ transform:translateY(-2px); box-shadow:var(--shadow); text-decoration:none; }

        .info-sections{ display:flex; flex-direction:column; gap:2rem; }
        .info-card{ background:white; border-radius:var(--border-radius); box-shadow:var(--shadow); overflow:hidden; transition:var(--transition); }
        .info-card:hover{ transform:translateY(-2px); box-shadow:0 8px 25px rgba(0,0,0,0.15); }
        .info-card-header{ background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color:white; padding:1.5rem 2rem; border-bottom:none; }
        .info-card-title{ font-size:1.3rem; font-weight:600; margin:0; display:flex; align-items:center; gap:.5rem; }
        .info-card-body{ padding:2rem; }
        .info-grid{ display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:1.5rem; }
        .info-item{ display:flex; flex-direction:column; gap:.5rem; }
        .info-label{ font-weight:600; color:var(--primary-blue); font-size:.9rem; text-transform:uppercase; letter-spacing:.5px; display:flex; align-items:center; gap:.5rem; }
        .info-value{ background:var(--light-gray); padding:12px 15px; border-radius:8px; font-size:1rem; color:#333; border:2px solid transparent; transition:var(--transition); }
        .info-value:focus{ border-color:var(--accent-blue); box-shadow:0 0 0 3px rgba(74,144,226,0.1); outline:none; }

        @media (max-width:1200px){ .profile-container{ grid-template-columns:300px 1fr; gap:1.5rem; } .profile-image{ width:120px; height:120px; } }
        @media (max-width:992px){ .profile-container{ grid-template-columns:1fr; gap:2rem; } .profile-card{ position:static; text-align:center; } .profile-actions{ flex-direction:row; justify-content:center; flex-wrap:wrap; gap:.8rem; } .profile-btn{ flex:1; min-width:140px; } }
        @media (max-width:768px){ .page-title{ font-size:2rem; } .info-grid{ grid-template-columns:1fr; gap:1rem; } .info-card-body{ padding:1.5rem; } .profile-card{ padding:1.5rem; } .profile-image{ width:100px; height:100px; } .profile-actions{ flex-direction:column; } .profile-btn{ min-width:auto; } }
        @media (max-width:480px){ .page-title{ font-size:1.7rem; } .main-container{ padding:1rem 0; } .info-card-header{ padding:1rem 1.5rem; } .info-card-body{ padding:1rem; } .profile-card{ padding:1rem; } .profile-name{ font-size:1.3rem; } }
        /* FLASH ALERTS */
.flash-alert {
    position: fixed;
    top: 90px;
    right: 20px;
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 12px 16px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    z-index: 2001;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity 0.25s ease, transform var(--transition), box-shadow var(--transition), background-color var(--transition);
    max-width: 460px;
}

.flash-alert.show {
    opacity: 1;
    transform: translateY(0);
}

.flash-alert i {
    font-size: 1.1rem;
}

.flash-alert .message {
    flex: 1;
}

.flash-alert .close {
    background: transparent;
    border: 0;
    color: inherit;
    cursor: pointer;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    font-size: 18px;
    transition: var(--transition);
}

.flash-alert .close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(90deg);
}

.flash-alert.success {
    background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%);
    color: #fff;
}

.flash-alert.danger {
    background: linear-gradient(135deg, var(--danger-red) 0%, #c82333 100%);
    color: #fff;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .flash-alert {
        top: 76px;
        left: 12px;
        right: 12px;
        max-width: none;
    }
}

@media (max-width: 480px) {
    .flash-alert {
        top: 70px;
        left: 8px;
        right: 8px;
        padding: 10px 12px;
        font-size: 0.9rem;
    }
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
        <button class="navbar-toggler d-lg-none" type="button" onclick="openSidebar()"><i class="fas fa-bars"></i></button>
        <div class="nav-links d-none d-lg-flex">
            <a href="{{ route('evaluator.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('evaluator.research') }}">
                <i class="fas fa-microscope me-2"></i>Research
                <span class="nav-badge">{{ $pendingResearchCount ?? 0 }}</span>
            </a>
            <a href="{{ route('evaluator.syllabus') }}">
                <i class="fas fa-book me-2"></i>Syllabus
                <span class="nav-badge">{{ $pendingSyllabusCount ?? 0 }}</span>
            </a>
            <a href="{{ route('evaluator.exam') }}">
                <i class="fas fa-clipboard-list me-2"></i>Exam Bank
                <span class="nav-badge">{{ $pendingExamCount ?? 0 }}</span>
            </a>
            <a href="{{ route('settings.evaluator') }}" class="profile-section-nav active" title="Profile">
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
    <a href="{{ route('evaluator.dashboard') }}" onclick="closeSidebar()"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ route('evaluator.research') }}" onclick="closeSidebar()">
        <i class="fas fa-microscope me-2"></i>Research
        <span class="nav-badge">{{ $pendingResearchCount ?? 0 }}</span>
    </a>
    <a href="{{ route('evaluator.syllabus') }}" onclick="closeSidebar()">
        <i class="fas fa-book me-2"></i>Syllabus
        <span class="nav-badge">{{ $pendingSyllabusCount ?? 0 }}</span>
    </a>
    <a href="{{ route('evaluator.exam') }}" onclick="closeSidebar()">
        <i class="fas fa-clipboard-list me-2"></i>Exam Bank
        <span class="nav-badge">{{ $pendingExamCount ?? 0 }}</span>
    </a>
    <a href="{{ route('settings.evaluator') }}" class="active" onclick="closeSidebar()"><i class="fas fa-user me-2"></i>Profile</a>
    <a href="{{ route('evaluator.settings.edit') }}" onclick="closeSidebar()"><i class="fas fa-user-edit me-2"></i>Edit Profile</a>
    <div class="logout-section">
        <button type="button" class="logout-btn" onclick="showLogoutModal()"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
    </div>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="modal-overlay" onclick="closeModalOnOverlay(event)">
    <div class="logout-modal">
        <div class="modal-header">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="modal-header-content">
                <h3>Confirm Logout</h3>
                <p>Are you sure you want to leave?</p>
            </div>
            <button type="button" class="close-modal" aria-label="Close" onclick="closeLogoutModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p>You will be signed out of your account and redirected to the login page.</p>
            <div class="modal-actions">
                <button type="button" class="modal-btn modal-btn-cancel" onclick="closeLogoutModal()"><i class="fas fa-times"></i>Close</button>
                <button type="button" class="modal-btn modal-btn-confirm" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i>Yes, Logout</button>
            </div>
        </div>
    </div>
</div>

<!-- Switch Role Modal -->
<div id="switchRoleModal" class="modal-overlay" onclick="closeSwitchOnOverlay(event)">
    <div class="logout-modal">
        <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);">
            <i class="fas fa-exchange-alt"></i>
            <div class="modal-header-content">
                <h3>Switch Role</h3>
                <p>Select the role you want to use</p>
            </div>
            <button type="button" class="close-modal" aria-label="Close" onclick="closeSwitchRoleModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
                @php
                    $email = Auth::user()->email;
                    $hasDean = \App\Models\User::where('email', $email)->where('role','Dean')->exists();
                    $hasFaculty = \App\Models\User::where('email', $email)->where('role','Faculty')->exists();
                @endphp

                <button type="button" class="modal-btn modal-btn-cancel" disabled>
                    <i class="fas fa-user-check"></i> Evaluator (Current)
                </button>

                @if($hasDean)
                    <form method="POST" action="{{ route('role.switch') }}">
                        @csrf
                        <input type="hidden" name="target_role" value="Dean">
                        <button type="submit" class="modal-btn modal-btn-confirm" style="background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%); color:white;">
                            <i class="fas fa-user-tie"></i> Dean
                        </button>
                    </form>
                @else
                    <button type="button" class="modal-btn modal-btn-cancel" onclick="openMissingRoleModal('Dean')">
                        <i class="fas fa-user-tie"></i> Dean
                    </button>
                @endif

                @if($hasFaculty)
                    <form method="POST" action="{{ route('role.switch') }}">
                        @csrf
                        <input type="hidden" name="target_role" value="Faculty">
                        <button type="submit" class="modal-btn modal-btn-confirm" style="background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%); color:white;">
                            <i class="fas fa-chalkboard-teacher"></i> Faculty
                        </button>
                    </form>
                @else
                    <button type="button" class="modal-btn modal-btn-cancel" onclick="openMissingRoleModal('Faculty')">
                        <i class="fas fa-chalkboard-teacher"></i> Faculty
                    </button>
                @endif
            </div>
            <div style="margin-top:1rem; color: var(--dark-gray);">
                <small>You?ll be redirected to the selected role?s dashboard.</small>
            </div>
        </div>
    </div>
</div>

<!-- Missing Role Modal -->
<div id="missingRoleModal" class="modal-overlay" onclick="closeMissingOnOverlay(event)">
    <div class="logout-modal">
        <div class="modal-header" style="background: linear-gradient(135deg, var(--warning-yellow) 0%, #f0ad4e 100%);">
            <i class="fas fa-info-circle"></i>
            <div class="modal-header-content">
                <h3>Role Not Available</h3>
                <p>We couldn?t find this role for your email</p>
            </div>
            <button type="button" class="close-modal" aria-label="Close" onclick="closeMissingRoleModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p>No <strong><span id="missingRoleName">Role</span></strong> account found for this email.<br>You can sign up for this role using the same email.</p>
            <div class="modal-actions">
                <button type="button" class="modal-btn modal-btn-cancel" onclick="closeMissingRoleModal()"><i class="fas fa-times"></i>Close</button>
                <a href="{{ route('signup') }}" class="modal-btn" style="background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%); color:white;">
                    <i class="fas fa-user-plus"></i>Go to Sign Up
                </a>
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
            <h1 class="page-title">Evaluator Profile</h1>
            <p class="page-subtitle">Manage your account information and settings</p>
        </div>

        <div class="profile-container">
            <div class="profile-card">
                <div class="profile-image-container">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profile-image">
                    @else
                        <img src="{{ asset('images/default-user.png') }}" alt="Default User Icon" class="profile-image">
                    @endif
                </div>

                <div class="profile-name">{{ Auth::user()->name }}</div>
                <div class="profile-role">{{ Auth::user()->role }}</div>

                <button type="button" class="profile-btn secondary" style="width:100%; margin-top:.5rem; margin-bottom:1rem;" onclick="openSwitchRoleModal()">
                    <i class="fas fa-exchange-alt"></i> Switch Role
                </button>

                <div class="profile-actions">
                    <a href="{{ route('evaluator.settings.edit') }}" class="profile-btn primary"><i class="fas fa-user-edit"></i>Edit Profile</a>
                    <button type="button" class="profile-btn danger" onclick="showLogoutModal()"><i class="fas fa-sign-out-alt"></i>Logout</button>
                </div>
            </div>

            <div class="info-sections">
                <div class="info-card">
                    <div class="info-card-header">
                        <h3 class="info-card-title"><i class="fas fa-user"></i>Basic Information</h3>
                    </div>
                    <div class="info-card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <label class="info-label"><i class="fas fa-signature"></i>Full Name</label>
                                <input type="text" class="info-value" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="info-item">
                                <label class="info-label"><i class="fas fa-envelope"></i>Email Address</label>
                                <input type="email" class="info-value" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="info-item">
                                <label class="info-label"><i class="fas fa-user-tag"></i>Role</label>
                                <input type="text" class="info-value" value="{{ Auth::user()->role }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-header">
                        <h3 class="info-card-title"><i class="fas fa-university"></i>Institutional Information</h3>
                    </div>
                    <div class="info-card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <label class="info-label"><i class="fas fa-university me-1"></i>Campus</label>
                                <input type="text" class="info-value" value="{{ Auth::user()->campus }}" readonly>
                            </div>
                            <div class="info-item">
                                <label class="info-label"><i class="fas fa-building me-1"></i>College</label>
                                <input type="text" class="info-value" value="{{ Auth::user()->college }}" readonly>
                            </div>
                            <div class="info-item">
                                <label class="info-label"><i class="fas fa-building-user"></i>Department</label>
                                <input type="text" class="info-value" value="{{ Auth::user()->department }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-header">
                        <h3 class="info-card-title"><i class="fas fa-info-circle"></i>Account Information</h3>
                    </div>
                    <div class="info-card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <label class="info-label"><i class="fas fa-calendar-plus"></i>Account Created</label>
                                <input type="text" class="info-value" value="{{ optional(Auth::user()->created_at)->timezone('Asia/Manila')->format('M d, Y \a\t h:i A') }}" readonly>
                            </div>
                            <div class="info-item">
                                <label class="info-label"><i class="fas fa-calendar-check"></i>Last Updated</label>
                                <input type="text" class="info-value" value="{{ optional(Auth::user()->updated_at)->timezone('Asia/Manila')->format('M d, Y \a\t h:i A') }}" readonly>
                            </div>
                            <div class="info-item">
                                <label class="info-label"><i class="fas fa-shield-alt"></i>Account Status</label>
                                <input type="text" class="info-value" value="Active" readonly style="color: var(--success-green); font-weight: 600;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function openSidebar(){
    const sidebar = document.getElementById("mobileSidebar");
    const vw = window.innerWidth || document.documentElement.clientWidth;
    const targetWidth = vw <= 480 ? Math.min(280, Math.floor(vw * 0.85)) : Math.min(260, Math.floor(vw * 0.90));
    sidebar.style.width = targetWidth + "px";
    sidebar.classList.add('open');
    document.body.style.overflow='hidden';
}
function closeSidebar(){ const sidebar = document.getElementById("mobileSidebar"); sidebar.classList.remove('open'); sidebar.style.width="0"; document.body.style.overflow='auto'; }

function showLogoutModal(){ document.getElementById('logoutModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
function closeLogoutModal(){ document.getElementById('logoutModal').classList.remove('active'); document.body.style.overflow = 'auto'; }
function closeModalOnOverlay(e){ if (e.target && e.target.id === 'logoutModal') closeLogoutModal(); }
function confirmLogout(){ document.getElementById('logoutForm').submit(); }

function openSwitchRoleModal(){ const m=document.getElementById('switchRoleModal'); m.classList.add('active'); document.body.style.overflow='hidden'; }
function closeSwitchRoleModal(){ const m=document.getElementById('switchRoleModal'); m.classList.remove('active'); document.body.style.overflow='auto'; }
function closeSwitchOnOverlay(e){ if (e.target && e.target.id === 'switchRoleModal') closeSwitchRoleModal(); }

function openMissingRoleModal(role){ const m=document.getElementById('missingRoleModal'); const span=document.getElementById('missingRoleName'); if (span) span.textContent = role; m.classList.add('active'); document.body.style.overflow='hidden'; }
function closeMissingRoleModal(){ const m=document.getElementById('missingRoleModal'); m.classList.remove('active'); document.body.style.overflow='auto'; }
function closeMissingOnOverlay(e){ if (e.target && e.target.id === 'missingRoleModal') closeMissingRoleModal(); }

document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeSidebar();
            closeLogoutModal();
            closeSwitchRoleModal();
            closeMissingRoleModal();
        }
    });

    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() { if (window.innerWidth >= 992) closeSidebar(); }, 250);
    });
});

/* Flash Alert Handler */
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

document.addEventListener('DOMContentLoaded', function(){
    initFlashAutoHide('flashSuccess', 2500);
    initFlashAutoHide('flashError', 3500);
});
// Server flash -> open missing role modal
@if(session('switch_role_missing'))
  openMissingRoleModal(@json(session('switch_role_missing')));
@endif
</script>

<script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
