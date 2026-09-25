<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>
    <style>
        :root {
            --bg: #bbccdd;
            --panel: rgba(255,255,255,0.9);
            --panel-strong: #ffffff;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #dbeafe;
            --muted: #4b6b9b;
            --text: #0f172a;
            --border: #230674;
            --border-strong: #160a7e;
            --success-bg: #dbeafe;
            --success-text: #1d4ed8;
                --warning-bg: #dbeafe;
                --warning-text: #1e3a8a;
                --danger: #ef4444;
            --shadow: 0 20px 50px rgba(37, 99, 235, 0.14);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #9bc1ec;
            color: var(--text);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 24px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            padding: 8px 4px;
        }

        .page-header h1, .page-header h2, .page-header h3 {
            margin: 0;
            font-size: clamp(2rem, 3vw, 2.6rem);
            letter-spacing: -0.04em;
        }

        .card {
            background: var(--panel);
            border: 2px solid var(--border-strong);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 28px;
            margin-bottom: 24px;
            backdrop-filter: blur(6px);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border: none;
            border-radius: 12px;
            padding: 11px 18px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            color: white;
            box-shadow: 0 12px 22px rgba(79, 70, 229, 0.28);
        }

        .btn-secondary {
            background: var(--secondary);
            color: var(--text);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .alert-success {
            background: var(--success-bg);
            color: var(--success-text);
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .summary-box {
            background: var(--panel-strong);
            border: 2px solid var(--border);
            border-radius: 18px;
            padding: 18px 20px;
            box-shadow: 0 8px 18px rgba(59, 130, 246, 0.08);
        }

        .summary-box h3 {
            margin: 0 0 8px;
            font-size: 0.9rem;
            color: var(--muted);
            font-weight: 600;
        }

        .summary-box strong {
            font-size: 1.8rem;
            letter-spacing: -0.04em;
        }

        .summary-box.total strong { color: var(--primary); }
        .summary-box.pending strong { color: #f59e0b; }
        .summary-box.completed strong { color: #22c55e; }

        .section-title {
            margin: 0 0 18px;
            font-size: 1.5rem;
            letter-spacing: -0.03em;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .field label {
            font-weight: 600;
            color: var(--text);
        }

        .field input,
        .field textarea,
        .field select {
            width: 100%;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .field input:focus,
        .field textarea:focus,
        .field select:focus {
            border-color: rgba(79, 70, 229, 0.6);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .field textarea {
            min-height: 140px;
            resize: vertical;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 22px;
            flex-wrap: wrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            background: rgba(255,255,255,0.4);
            border: 2px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
        }

        th, td {
            padding: 16px 14px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            vertical-align: top;
        }

        th {
            background: rgba(248, 250, 252, 0.9);
            color: var(--muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        tbody tr:hover {
            background: rgba(79, 70, 229, 0.03);
        }

        .task-name {
            font-weight: 700;
            color: var(--text);
        }

        .task-desc {
            color: var(--muted);
            line-height: 1.5;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .badge-pending {
            background: var(--warning-bg);
            color: var(--warning-text);
        }

        .badge-completed {
            background: var(--success-bg);
            color: var(--success-text);
        }

        .table-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .status-select {
            min-width: 120px;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: white;
            color: var(--text);
        }

        .empty-state {
            text-align: center;
            padding: 42px 20px;
            color: var(--muted);
            font-size: 1.05rem;
        }

        form { margin: 0; }

        @media (max-width: 720px) {
            .container {
                padding: 16px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .card {
                padding: 20px 16px;
            }

            th, td {
                padding: 12px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
