<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation | Amateur2Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Space+Grotesk:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: #020617;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .wrap { width: 100%; max-width: 420px; }
        .logo {
            text-align: center;
            margin-bottom: 40px;
            font-family: 'Rajdhani', sans-serif;
            font-size: 36px;
            font-weight: 700;
            font-style: italic;
            letter-spacing: 4px;
            color: #fff;
            text-decoration: none;
            display: block;
        }
        .logo span { color: #a855f7; }
        .card {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 48px 40px;
            text-align: center;
        }
        .icon {
            width: 64px;
            height: 64px;
            background: rgba(168,85,247,0.1);
            border: 1px solid rgba(168,85,247,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 28px;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            color: #a855f7;
        }
        .subtitle {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #64748b;
            margin-bottom: 8px;
        }
        .team-name {
            font-family: 'Rajdhani', sans-serif;
            font-size: 42px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #fff;
            margin-bottom: 32px;
        }
        .divider {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 32px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .btn-primary {
            display: block;
            width: 100%;
            padding: 16px;
            background: #9333ea;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-decoration: none;
            transition: background .2s;
        }
        .btn-primary:hover { background: #a855f7; }
        .btn-secondary {
            display: block;
            width: 100%;
            padding: 16px;
            border: 1px solid rgba(255,255,255,0.1);
            color: #94a3b8;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-secondary:hover { border-color: #fff; color: #fff; }
        .footer {
            text-align: center;
            color: #1e293b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 24px;
        }
    </style>
</head>
<body>

    <div class="wrap">

        <a href="/" class="logo">A2<span>P</span></a>

        <div class="card">

            <div class="icon">
                {{ strtoupper(substr($invitation->team->name, 0, 1)) }}
            </div>

            <p class="subtitle">Tu as été invité à rejoindre</p>

            <h1 class="team-name">{{ $invitation->team->name }}</h1>

            <div class="divider">
                <a href="{{ route('teams.accept', $invitation->token) }}" class="btn-primary">
                    Rejoindre l'équipe
                </a>
                <a href="{{ route('tournois') }}" class="btn-secondary">
                    Refuser
                </a>
            </div>

        </div>

        <p class="footer">Amateur2Pro — {{ date('Y') }}</p>

    </div>

</body>
</html>