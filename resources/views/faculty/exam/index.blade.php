<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Bank - KnowledgeManagementSystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --light-bg: #ecf0f1;
            --dark-text: #2c3e50;
            --light-text: #7f8c8d;
            --border-radius: 12px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--dark-text);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: var(--box-shadow);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
        }

        .navbar-brand i {
            color: var(--secondary-color);
        }

        .nav-link {
            color: var(--dark-text) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: var(--transition);
            position: relative;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--secondary-color);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: var(--light-bg);
            border-radius: 50px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .main-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .page-header {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
            animation: slideInDown 0.5s ease;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--light-text);
            font-size: 1rem;
        }

        .controls-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
            animation: fadeIn 0.5s ease 0.2s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-left: 2.5rem;
            border: 2px solid var(--light-bg);
            border-radius: 50px;
            transition: var(--transition);
        }

        .search-box input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-text);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color), #2980b9);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--accent-color), #c0392b);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(231, 76, 60, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color), #e67e22);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            color: white;
            transition: var(--transition);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(243, 156, 18, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color), #229954);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(39, 174, 96, 0.3);
        }

        .table-container {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            animation: fadeIn 0.5s ease 0.4s both;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: var(--light-bg);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .badge-success {
            background: var(--success-color);
        }

        .badge-warning {
            background: var(--warning-color);
        }

        .badge-danger {
            background: var(--accent-color);
        }

        .badge-info {
            background: var(--secondary-color);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .action-buttons .btn {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--secondary-color), #2980b9);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            border: none;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-footer {
            border: none;
            padding: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 2px solid var(--light-bg);
            border-radius: 8px;
            padding: 0.75rem;
            transition: var(--transition);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .flash-alert {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .pagination {
            margin-top: 2rem;
            justify-content: center;
        }

        .pagination .page-link {
            color: var(--secondary-color);
            border: 2px solid var(--light-bg);
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .pagination .page-link:hover {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .pagination .page-item.active .page-link {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--light-text);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--light-text);
        }

        .mobile-sidebar {
            position: fixed;
            top: 0;
            left: -100%;
            width: 280px;
            height: 100vh;
            background: white;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            z-index: 9999;
            padding: 2rem;
        }

        .mobile-sidebar.active {
            left: 0;
        }

        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 9998;
        }

        .mobile-overlay.active {
            display: block;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 0.5rem;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 3px;
            transition: var(--transition);
        }

        .file-upload-area {
            border: 2px dashed var(--light-bg);
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: var(--secondary-color);
            background: rgba(52, 152, 219, 0.05);
        }

        .file-upload-area i {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-overlay.active {
            display: flex;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .navbar-collapse {
                display: none !important;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .controls-section {
                padding: 1rem;
            }

            .table-container {
                overflow-x: auto;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
            }
        }

        .submission-type-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .submission-type-tab {
            flex: 1;
            padding: 1rem;
            border: 2px solid var(--light-bg);
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .submission-type-tab:hover {
            border-color: var(--secondary-color);
            background: rgba(52, 152, 219, 0.05);
        }

        .submission-type-tab.active {
            border-color: var(--secondary-color);
            background: var(--secondary-color);
            color: white;
        }

        .submission-type-tab i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .form-section {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .form-section.active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('faculty.dashboard') }}">
                <i class="fas fa-graduation-cap"></i> KnowledgeManagementSystem
            </a>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faculty.dashboard') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('faculty.exam') }}">
                            <i class="fas fa-file-alt"></i> Exam Bank
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faculty.syllabus') }}">
                            <i class="fas fa-book"></i> Syllabus
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faculty.profile') }}">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <button class="btn btn-sm btn-danger" onclick="showLogoutModal()">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Sidebar -->
    <div class="mobile-overlay" id="mobileOverlay"></div>
    <div class="mobile-sidebar" id="mobileSidebar">
        <h5 class="mb-4">Menu</h5>
        <ul class="list-unstyled">
            <li class="mb-3">
                <a href="{{ route('faculty.dashboard') }}" class="text-decoration-none">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('faculty.exam') }}" class="text-decoration-none">
                    <i class="fas fa-file-alt"></i> Exam Bank
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('faculty.syllabus') }}" class="text-decoration-none">
                    <i class="fas fa-book"></i> Syllabus
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('faculty.profile') }}" class="text-decoration-none">
                    <i class="fas fa-user"></i> Profile
                </a>
            </li>
        </ul>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show flash-alert" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show flash-alert" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Main Container -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-file-alt"></i> Exam Bank
            </h1>
            <p class="page-subtitle">Manage and submit test questions and table of specifications</p>
        </div>

        <!-- Controls Section -->
        <div class="controls-section">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search exams...">
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <button class="btn btn-primary" onclick="showSubmitModal()">
                        <i class="fas fa-plus"></i> Submit New
                    </button>
                    <button class="btn btn-warning" onclick="showHelpModal()">
                        <i class="fas fa-question-circle"></i> Help
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <select class="form-select" id="filterStatus">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="filterType">
                        <option value="">All Types</option>
                        <option value="test_questions">Test Questions</option>
                        <option value="tos">Table of Specifications</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="filterSemester">
                        <option value="">All Semesters</option>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="Summer">Summer</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-secondary w-100" onclick="resetFilters()">
                        <i class="fas fa-redo"></i> Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table" id="examTable">
                    <thead>
                        <tr>
                            <th>Submission Type</th>
                            <th>Subject</th>
                            <th>Semester</th>
                            <th>School Year</th>
                            <th>Campus</th>
                            <th>College</th>
                            <th>Status</th>
                            <th>Submitted Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="examTableBody">
                        @forelse($exams as $exam)
                        <tr data-status="{{ $exam->status }}" data-type="{{ $exam->submission_type }}" data-semester="{{ $exam->semester }}">
                            <td>
                                @if($exam->submission_type === 'test_questions')
                                <span class="badge badge-info">
                                    <i class="fas fa-question-circle"></i> Test Questions
                                </span>
                                @else
                                <span class="badge badge-warning">
                                    <i class="fas fa-table"></i> TOS
                                </span>
                                @endif
                            </td>
                            <td>{{ $exam->subject }}</td>
                            <td>{{ $exam->semester }}</td>
                            <td>{{ $exam->school_year }}</td>
                            <td>{{ $exam->campus }}</td>
                            <td>{{ $exam->college }}</td>
                            <td>
                                @if($exam->status === 'pending')
                                <span class="badge badge-warning">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                                @elseif($exam->status === 'approved')
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle"></i> Approved
                                </span>
                                @else
                                <span class="badge badge-danger">
                                    <i class="fas fa-times-circle"></i> Rejected
                                </span>
                                @endif
                            </td>
                            <td>{{ $exam->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" onclick="viewExam({{ $exam->id }})">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    @if($exam->status === 'pending')
                                    <button class="btn btn-sm btn-warning" onclick="editExam({{ $exam->id }})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    @endif
                                    <button class="btn btn-sm btn-danger" onclick="deleteExam({{ $exam->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                    @if($exam->admin_comments)
                                    <button class="btn btn-sm btn-secondary" onclick="viewComments({{ $exam->id }})">
                                        <i class="fas fa-comment"></i> Comments
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <i class="fas fa-folder-open"></i>
                                    <h3>No exams submitted yet</h3>
                                    <p>Click "Submit New" to add your first exam submission</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <nav>
                    <ul class="pagination" id="pagination">
                        <!-- Pagination will be generated by JavaScript -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Submit Modal -->
    <div class="modal fade" id="submitModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus"></i> Submit New Exam
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Submission Type Selection -->
                    <div class="submission-type-tabs">
                        <div class="submission-type-tab active" data-type="test_questions">
                            <i class="fas fa-question-circle"></i>
                            <h6>Test Questions</h6>
                        </div>
                        <div class="submission-type-tab" data-type="tos">
                            <i class="fas fa-table"></i>
                            <h6>Table of Specifications</h6>
                        </div>
                    </div>

                    <!-- Test Questions Form -->
                    <form id="testQuestionsForm" class="form-section active" action="{{ route('faculty.exam.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="submission_type" value="test_questions">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="subject" required value="{{ old('submission_type')==='test_questions' ? old('subject') : '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Semester <span class="text-danger">*</span></label>
                                <select class="form-select" name="semester" required>
                                    <option value="" disabled selected>Select Semester</option>
                                    <option value="1st Semester" {{ old('submission_type')==='test_questions' && old('semester')==='1st Semester' ? 'selected' : '' }}>1st Semester</option>
                                    <option value="2nd Semester" {{ old('submission_type')==='test_questions' && old('semester')==='2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                                    <option value="Summer" {{ old('submission_type')==='test_questions' && old('semester')==='Summer' ? 'selected' : '' }}>Summer</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">School Year <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="school_year" placeholder="e.g., 2023-2024" required value="{{ old('submission_type')==='test_questions' ? old('school_year') : '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Campus <span class="text-danger">*</span></label>
                                <select class="form-select" name="campus" id="testCampus" required>
                                    <option value="" disabled selected>Select Campus</option>
                                    <option value="Main Campus" {{ old('submission_type')==='test_questions' && old('campus')==='Main Campus' ? 'selected' : '' }}>Main Campus</option>
                                    <option value="Lucena Campus" {{ old('submission_type')==='test_questions' && old('campus')==='Lucena Campus' ? 'selected' : '' }}>Lucena Campus</option>
                                    <option value="Candelaria Campus" {{ old('submission_type')==='test_questions' && old('campus')==='Candelaria Campus' ? 'selected' : '' }}>Candelaria Campus</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">College <span class="text-danger">*</span></label>
                                <select class="form-select" name="college" id="testCollege" required>
                                    <option value="" disabled selected>Select College</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Program <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="program" required value="{{ old('submission_type')==='test_questions' ? old('program') : '' }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Document <span class="text-danger">*</span></label>
                            <div class="file-upload-area" onclick="document.getElementById('testFile').click()">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <h6>Click to upload or drag and drop</h6>
                                <p class="text-muted">PDF, DOC, DOCX (Max 10MB)</p>
                                <input type="file" class="d-none" id="testFile" name="document" accept=".pdf,.doc,.docx" required>
                                <div id="testFileName" class="mt-2"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Add any additional notes...">{{ old('submission_type')==='test_questions' ? old('notes') : '' }}</textarea>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Submit
                            </button>
                        </div>
                    </form>

                    <!-- Table of Specifications Form -->
                    <form id="tosForm" class="form-section" action="{{ route('faculty.exam.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="submission_type" value="tos">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="subject" required value="{{ old('submission_type')==='tos' ? old('subject') : '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Semester <span class="text-danger">*</span></label>
                                <select class="form-select" name="semester" required>
                                    <option value="" disabled selected>Select Semester</option>
                                    <option value="1st Semester" {{ old('submission_type')==='tos' && old('semester')==='1st Semester' ? 'selected' : '' }}>1st Semester</option>
                                    <option value="2nd Semester" {{ old('submission_type')==='tos' && old('semester')==='2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                                    <option value="Summer" {{ old('submission_type')==='tos' && old('semester')==='Summer' ? 'selected' : '' }}>Summer</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">School Year <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="school_year" placeholder="e.g., 2023-2024" required value="{{ old('submission_type')==='tos' ? old('school_year') : '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Campus <span class="text-danger">*</span></label>
                                <select class="form-select" name="campus" id="tosCampus" required>
                                    <option value="" disabled selected>Select Campus</option>
                                    <option value="Main Campus" {{ old('submission_type')==='tos' && old('campus')==='Main Campus' ? 'selected' : '' }}>Main Campus</option>
                                    <option value="Lucena Campus" {{ old('submission_type')==='tos' && old('campus')==='Lucena Campus' ? 'selected' : '' }}>Lucena Campus</option>
                                    <option value="Candelaria Campus" {{ old('submission_type')==='tos' && old('campus')==='Candelaria Campus' ? 'selected' : '' }}>Candelaria Campus</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">College <span class="text-danger">*</span></label>
                                <select class="form-select" name="college" id="tosCollege" required>
                                    <option value="" disabled selected>Select College</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Program <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="program" required value="{{ old('submission_type')==='tos' ? old('program') : '' }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Document <span class="text-danger">*</span></label>
                            <div class="file-upload-area" onclick="document.getElementById('tosFile').click()">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <h6>Click to upload or drag and drop</h6>
                                <p class="text-muted">PDF, DOC, DOCX (Max 10MB)</p>
                                <input type="file" class="d-none" id="tosFile" name="document" accept=".pdf,.doc,.docx" required>
                                <div id="tosFileName" class="mt-2"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Add any additional notes...">{{ old('submission_type')==='tos' ? old('notes') : '' }}</textarea>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit"></i> Edit Exam Submission
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-eye"></i> View Exam Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewModalBody">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Modal -->
    <div class="modal fade" id="commentsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-comment"></i> Admin Comments
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="commentsModalBody">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Modal -->
    <div class="modal fade" id="helpModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle"></i> Help & Tutorial
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-3"><i class="fas fa-info-circle"></i> How to Submit Exams</h6>
                    <ol>
                        <li>Click the "Submit New" button</li>
                        <li>Choose between "Test Questions" or "Table of Specifications"</li>
                        <li>Fill in all required fields marked with *</li>
                        <li>Upload your document (PDF, DOC, or DOCX format, max 10MB)</li>
                        <li>Add any optional notes</li>
                        <li>Click "Submit" to send for review</li>
                    </ol>

                    <h6 class="mb-3 mt-4"><i class="fas fa-filter"></i> Using Filters</h6>
                    <p>Use the filter dropdowns to narrow down your exam submissions:</p>
                    <ul>
                        <li><strong>Status:</strong> Filter by pending, approved, or rejected</li>
                        <li><strong>Type:</strong> Filter by test questions or TOS</li>
                        <li><strong>Semester:</strong> Filter by academic semester</li>
                    </ul>

                    <h6 class="mb-3 mt-4"><i class="fas fa-search"></i> Search Functionality</h6>
                    <p>Use the search box to quickly find exams by subject, campus, college, or any other field.</p>

                    <h6 class="mb-3 mt-4"><i class="fas fa-exclamation-triangle"></i> Important Notes</h6>
                    <ul>
                        <li>Only pending submissions can be edited</li>
                        <li>Approved submissions cannot be modified</li>
                        <li>Check admin comments for rejected submissions</li>
                        <li>Ensure document files meet the size and format requirements</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it!</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-sign-out-alt"></i> Confirm Logout
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-trash"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this exam submission? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // College data for each campus
        const colleges = {
            "Main Campus": [
                "College of Engineering",
                "College of Business Administration",
                "College of Computer Studies",
                "College of Education",
                "College of Arts and Sciences"
            ],
            "Lucena Campus": [
                "College of Engineering",
                "College of Business Administration",
                "College of Education"
            ],
            "Candelaria Campus": [
                "College of Agriculture",
                "College of Business Administration",
                "College of Education"
            ]
        };

        // Mobile sidebar toggle
        document.getElementById('hamburger').addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.toggle('active');
            document.getElementById('mobileOverlay').classList.toggle('active');
        });

        document.getElementById('mobileOverlay').addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.remove('active');
            this.classList.remove('active');
        });

        // Auto-hide flash messages
        setTimeout(function() {
            const alerts = document.querySelectorAll('.flash-alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            });
        }, 5000);

        // Submission type tabs
        document.querySelectorAll('.submission-type-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.submission-type-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                const type = this.getAttribute('data-type');
                document.querySelectorAll('.form-section').forEach(section => section.classList.remove('active'));
                
                if (type === 'test_questions') {
                    document.getElementById('testQuestionsForm').classList.add('active');
                } else {
                    document.getElementById('tosForm').classList.add('active');
                }
            });
        });

        // Campus-College dependency for Test Questions
        document.getElementById('testCampus').addEventListener('change', function() {
            const campus = this.value;
            const collegeDropdown = document.getElementById('testCollege');
            collegeDropdown.innerHTML = '<option value="" disabled selected>Select College</option>';
            
            if (campus && colleges[campus]) {
                colleges[campus].forEach(function(college) {
                    let option = document.createElement('option');
                    option.value = college;
                    option.textContent = college;
                    if (college === @json(old('submission_type')==='test_questions' ? old('college') : null)) {
                        option.selected = true;
                    }
                    collegeDropdown.appendChild(option);
                });
            }
        });

        // Campus-College dependency for TOS
        document.getElementById('tosCampus').addEventListener('change', function() {
            const campus = this.value;
            const collegeDropdown = document.getElementById('tosCollege');
            collegeDropdown.innerHTML = '<option value="" disabled selected>Select College</option>';
            
            if (campus && colleges[campus]) {
                colleges[campus].forEach(function(college) {
                    let option = document.createElement('option');
                    option.value = college;
                    option.textContent = college;
                    if (college === @json(old('submission_type')==='tos' ? old('college') : null)) {
                        option.selected = true;
                    }
                    collegeDropdown.appendChild(option);
                });
            }
        });

        // Trigger campus change on page load to populate colleges if old values exist
        if (document.getElementById('testCampus').value) {
            document.getElementById('testCampus').dispatchEvent(new Event('change'));
        }
        if (document.getElementById('tosCampus').value) {
            document.getElementById('tosCampus').dispatchEvent(new Event('change'));
        }

        // File upload handling
        document.getElementById('testFile').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                document.getElementById('testFileName').innerHTML = '<i class="fas fa-file"></i> ' + fileName;
            }
        });

        document.getElementById('tosFile').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                document.getElementById('tosFileName').innerHTML = '<i class="fas fa-file"></i> ' + fileName;
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            filterTable();
        });

        // Filter functionality
        document.getElementById('filterStatus').addEventListener('change', filterTable);
        document.getElementById('filterType').addEventListener('change', filterTable);
        document.getElementById('filterSemester').addEventListener('change', filterTable);

        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('filterStatus').value;
            const typeFilter = document.getElementById('filterType').value;
            const semesterFilter = document.getElementById('filterSemester').value;
            
            const rows = document.querySelectorAll('#examTableBody tr');
            
            rows.forEach(function(row) {
                const text = row.textContent.toLowerCase();
                const status = row.getAttribute('data-status');
                const type = row.getAttribute('data-type');
                const semester = row.getAttribute('data-semester');
                
                let showRow = true;
                
                if (searchTerm && !text.includes(searchTerm)) {
                    showRow = false;
                }
                
                if (statusFilter && status !== statusFilter) {
                    showRow = false;
                }
                
                if (typeFilter && type !== typeFilter) {
                    showRow = false;
                }
                
                if (semesterFilter && semester !== semesterFilter) {
                    showRow = false;
                }
                
                row.style.display = showRow ? '' : 'none';
            });
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterType').value = '';
            document.getElementById('filterSemester').value = '';
            filterTable();
        }

        function showSubmitModal() {
            const modal = new bootstrap.Modal(document.getElementById('submitModal'));
            modal.show();
        }

        function showLogoutModal() {
            const modal = new bootstrap.Modal(document.getElementById('logoutModal'));
            modal.show();
        }

        function showHelpModal() {
            const modal = new bootstrap.Modal(document.getElementById('helpModal'));
            modal.show();
        }

        function viewExam(id) {
            fetch(`/faculty/exam/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('viewModalBody').innerHTML = `
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Submission Type:</strong>
                                <p>${data.submission_type === 'test_questions' ? 'Test Questions' : 'Table of Specifications'}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Subject:</strong>
                                <p>${data.subject}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Semester:</strong>
                                <p>${data.semester}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>School Year:</strong>
                                <p>${data.school_year}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Campus:</strong>
                                <p>${data.campus}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>College:</strong>
                                <p>${data.college}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Program:</strong>
                                <p>${data.program}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Status:</strong>
                                <p><span class="badge badge-${data.status === 'approved' ? 'success' : data.status === 'pending' ? 'warning' : 'danger'}">${data.status}</span></p>
                            </div>
                            ${data.notes ? `
                            <div class="col-12 mb-3">
                                <strong>Notes:</strong>
                                <p>${data.notes}</p>
                            </div>
                            ` : ''}
                            ${data.admin_comments ? `
                            <div class="col-12 mb-3">
                                <strong>Admin Comments:</strong>
                                <p>${data.admin_comments}</p>
                            </div>
                            ` : ''}
                            <div class="col-12">
                                <strong>Document:</strong>
                                <p><a href="${data.document_url}" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Download</a></p>
                            </div>
                        </div>
                    `;
                    const modal = new bootstrap.Modal(document.getElementById('viewModal'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading exam details');
                });
        }

        function editExam(id) {
            fetch(`/faculty/exam/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editModalBody').innerHTML = `
                        <form action="/faculty/exam/${id}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="submission_type" value="${data.submission_type}">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subject <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="subject" required value="${data.subject}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                                    <select class="form-select" name="semester" required>
                                        <option value="1st Semester" ${data.semester === '1st Semester' ? 'selected' : ''}>1st Semester</option>
                                        <option value="2nd Semester" ${data.semester === '2nd Semester' ? 'selected' : ''}>2nd Semester</option>
                                        <option value="Summer" ${data.semester === 'Summer' ? 'selected' : ''}>Summer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">School Year <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="school_year" required value="${data.school_year}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Campus <span class="text-danger">*</span></label>
                                    <select class="form-select" name="campus" id="editCampus" required>
                                        <option value="Main Campus" ${data.campus === 'Main Campus' ? 'selected' : ''}>Main Campus</option>
                                        <option value="Lucena Campus" ${data.campus === 'Lucena Campus' ? 'selected' : ''}>Lucena Campus</option>
                                        <option value="Candelaria Campus" ${data.campus === 'Candelaria Campus' ? 'selected' : ''}>Candelaria Campus</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">College <span class="text-danger">*</span></label>
                                    <select class="form-select" name="college" id="editCollege" required>
                                        <option value="">${data.college}</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Program <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="program" required value="${data.program}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Replace Document (Optional)</label>
                                <input type="file" class="form-control" name="document" accept=".pdf,.doc,.docx">
                                <small class="text-muted">Leave empty to keep current document</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Notes (Optional)</label>
                                <textarea class="form-control" name="notes" rows="3">${data.notes || ''}</textarea>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update
                                </button>
                            </div>
                        </form>
                    `;
                    
                    // Populate colleges based on campus
                    const editCampus = document.getElementById('editCampus');
                    const editCollege = document.getElementById('editCollege');
                    const currentCollege = data.college;
                    
                    editCampus.addEventListener('change', function() {
                        const campus = this.value;
                        editCollege.innerHTML = '<option value="" disabled selected>Select College</option>';
                        if (campus && colleges[campus]) {
                            colleges[campus].forEach(function(college) {
                                let option = document.createElement('option');
                                option.value = college;
                                option.textContent = college;
                                if (college === currentCollege) {
                                    option.selected = true;
                                }
                                editCollege.appendChild(option);
                            });
                        }
                    });
                    
                    // Trigger change to populate colleges
                    editCampus.dispatchEvent(new Event('change'));
                    
                    const modal = new bootstrap.Modal(document.getElementById('editModal'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading exam for editing');
                });
        }

        function deleteExam(id) {
            document.getElementById('deleteForm').action = `/faculty/exam/${id}`;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        function viewComments(id) {
            fetch(`/faculty/exam/${id}/comments`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('commentsModalBody').innerHTML = `
                        <div class="alert alert-info">
                            <strong><i class="fas fa-user-shield"></i> Admin Comments:</strong>
                            <p class="mb-0 mt-2">${data.comments}</p>
                        </div>
                    `;
                    const modal = new bootstrap.Modal(document.getElementById('commentsModal'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading comments');
                });
        }

        // Initialize pagination
        function initPagination() {
            const rows = document.querySelectorAll('#examTableBody tr');
            const rowsPerPage = 10;
            const pageCount = Math.ceil(rows.length / rowsPerPage);
            
            if (pageCount <= 1) return;
            
            let currentPage = 1;
            
            function showPage(page) {
                rows.forEach((row, index) => {
                    row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? '' : 'none';
                });
            }
            
            function createPagination() {
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';
                
                // Previous button
                const prevLi = document.createElement('li');
                prevLi.className = 'page-item' + (currentPage === 1 ? ' disabled' : '');
                prevLi.innerHTML = '<a class="page-link" href="#">Previous</a>';
                prevLi.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (currentPage > 1) {
                        currentPage--;
                        showPage(currentPage);
                        createPagination();
                    }
                });
                pagination.appendChild(prevLi);
                
                // Page numbers
                for (let i = 1; i <= pageCount; i++) {
                    const li = document.createElement('li');
                    li.className = 'page-item' + (i === currentPage ? ' active' : '');
                    li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                    li.addEventListener('click', function(e) {
                        e.preventDefault();
                        currentPage = i;
                        showPage(currentPage);
                        createPagination();
                    });
                    pagination.appendChild(li);
                }
                
                // Next button
                const nextLi = document.createElement('li');
                nextLi.className = 'page-item' + (currentPage === pageCount ? ' disabled' : '');
                nextLi.innerHTML = '<a class="page-link" href="#">Next</a>';
                nextLi.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (currentPage < pageCount) {
                        currentPage++;
                        showPage(currentPage);
                        createPagination();
                    }
                });
                pagination.appendChild(nextLi);
            }
            
            showPage(1);
            createPagination();
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initPagination();
            
            // Show submit modal if there are old form errors
            @if($errors->any() && old('submission_type'))
                const submitModal = new bootstrap.Modal(document.getElementById('submitModal'));
                submitModal.show();
                
                // Switch to the correct form based on old submission type
                const submissionType = '{{ old("submission_type") }}';
                document.querySelectorAll('.submission-type-tab').forEach(tab => {
                    if (tab.getAttribute('data-type') === submissionType) {
                        tab.click();
                    }
                });
            @endif
        });
    </script>
</body>
</html>
