<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axon – Phone Numbers</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --axon-blue:   #1B9BDF;
            --axon-dark:   #0D2B55;
            --ok-green:    #16A34A;
            --nok-red:     #DC2626;
            --bg:          #F4F7FA;
            --surface:     #FFFFFF;
            --border:      #DDE3EC;
            --text:        #1E293B;
            --muted:       #64748B;
            --radius:      8px;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── Header ── */
        header {
            background: var(--axon-dark);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            height: 60px;
            gap: 12px;
        }
        .logo-mark {
            width: 36px; height: 36px;
            background: var(--axon-blue);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .logo-mark svg { width: 22px; height: 22px; fill: white; }
        .logo-text { color: white; font-size: 1.15rem; font-weight: 700; letter-spacing: .03em; }
        .logo-sub  { color: #93C5FD; font-size: 0.7rem; font-weight: 400; display: block; }

        /* ── Main ── */
        main { max-width: 1100px; margin: 2.5rem auto; padding: 0 1.5rem; }

        h1 { font-size: 1.75rem; font-weight: 700; color: var(--axon-dark); margin-bottom: 1.5rem; }

        /* ── Filters ── */
        .filters {
            display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }
        .filters label { font-size: .8rem; font-weight: 600; color: var(--muted); margin-right: .3rem; }
        .filters select {
            padding: .45rem .9rem; border: 1px solid var(--border);
            border-radius: 6px; font-size: .9rem; background: var(--bg);
            color: var(--text); cursor: pointer;
        }
        .filters select:focus { outline: 2px solid var(--axon-blue); outline-offset: 2px; }
        .btn {
            padding: .45rem 1.1rem; border-radius: 6px; font-size: .9rem;
            font-weight: 600; cursor: pointer; border: none;
        }
        .btn-primary { background: var(--axon-blue); color: white; }
        .btn-primary:hover { background: #1587c4; }
        .btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--bg); }

        /* ── Table ── */
        .card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead { background: var(--axon-dark); }
        thead th {
            padding: .75rem 1rem; text-align: left; color: white;
            font-size: .8rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase;
        }
        tbody tr { border-bottom: 1px solid var(--border); }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #F8FAFC; }
        tbody td { padding: .8rem 1rem; font-size: .9rem; }

        .badge {
            display: inline-block; padding: .2rem .55rem;
            border-radius: 999px; font-size: .75rem; font-weight: 700;
        }
        .badge-ok  { background: #DCFCE7; color: var(--ok-green); }
        .badge-nok { background: #FEE2E2; color: var(--nok-red); }

        .country-code { color: var(--muted); font-size: .82rem; }

        /* ── Pagination ── */
        .pagination {
            display: flex; gap: .5rem; align-items: center; justify-content: flex-end;
            padding: 1rem 1.25rem; border-top: 1px solid var(--border);
            background: var(--surface);
        }
        .pagination a, .pagination span {
            display: inline-block; padding: .35rem .75rem;
            border-radius: 6px; font-size: .85rem; text-decoration: none;
            border: 1px solid var(--border); color: var(--text);
        }
        .pagination a:hover { background: var(--axon-blue); color: white; border-color: var(--axon-blue); }
        .pagination .active { background: var(--axon-blue); color: white; border-color: var(--axon-blue); font-weight: 700; }
        .pagination .disabled { color: var(--muted); pointer-events: none; background: var(--bg); }

        .summary { color: var(--muted); font-size: .83rem; margin-right: auto; }

        /* ── Empty ── */
        .empty { padding: 3rem; text-align: center; color: var(--muted); }
    </style>
</head>
<body>

<header>
    <div class="logo-mark">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 4a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm3 12H9v-1l1-1v-4l-1-1V10h4v7l1 1v1z"/>
        </svg>
    </div>
    <div>
        <span class="logo-text">AXON</span>
        <span class="logo-sub">Ensuring Health for All</span>
    </div>
</header>

<main>
    @yield('content')
</main>

</body>
</html>
