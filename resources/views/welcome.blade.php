<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario - Inicio</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --card-border: #334155;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-blue: #38bdf8;
            --accent-green: #22c55e;
            --accent-amber: #f59e0b;
            --accent-red: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            max-width: 900px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #38bdf8 0%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s, border-color 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            border-color: var(--accent-blue);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .status-badge.success {
            background-color: rgba(34, 197, 94, 0.15);
            color: var(--accent-green);
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-badge.error {
            background-color: rgba(239, 68, 68, 0.15);
            color: var(--accent-red);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .dot.success { background-color: var(--accent-green); }
        .dot.error { background-color: var(--accent-red); }

        .code-block {
            background-color: #090d16;
            border: 1px solid #1e293b;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-family: monospace;
            font-size: 0.875rem;
            color: #e2e8f0;
            overflow-x: auto;
            margin-top: 0.5rem;
        }

        .step-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .step-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }

        .step-number {
            background-color: rgba(56, 189, 248, 0.15);
            color: var(--accent-blue);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .step-content h4 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .step-content p {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.4;
        }

        footer {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Sistema de Inventario</h1>
            <p>Bienvenido a tu aplicación en PHP y Laravel</p>
        </div>

        <div class="grid">
            <!-- Card 1: Estado de la Base de Datos -->
            <div class="card">
                <div class="card-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--accent-blue);"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                    Conexión MySQL Workbench
                </div>

                @if($dbStatus['connected'])
                    <div class="status-badge success">
                        <span class="dot success"></span>
                        ¡Conectado exitosamente a MySQL!
                    </div>
                    <p style="margin-top: 1rem; color: var(--text-muted); font-size: 0.9rem;">
                        Base de datos actual: <strong style="color: var(--text-main);">{{ $dbStatus['database'] }}</strong>
                    </p>
                @else
                    <div class="status-badge error">
                        <span class="dot error"></span>
                        Sin conexión a la Base de Datos
                    </div>
                    <p style="margin-top: 1rem; color: var(--text-muted); font-size: 0.875rem;">
                        Configura tu archivo <code>.env</code> para conectar MySQL Workbench.
                    </p>
                    @if($dbStatus['error'])
                        <div class="code-block" style="color: #f87171;">
                            {{ $dbStatus['error'] }}
                        </div>
                    @endif
                @endif
            </div>

            <!-- Card 2: Información del Proyecto -->
            <div class="card">
                <div class="card-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--accent-blue);"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path></svg>
                    Entorno de Trabajo
                </div>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem; color: var(--text-muted); font-size: 0.9rem;">
                    <li>⚡ <strong>Laravel Version:</strong> {{ app()->version() }}</li>
                    <li>🐘 <strong>PHP Version:</strong> {{ PHP_VERSION }}</li>
                    <li>📂 <strong>Ubicación:</strong> <code>c:\laragon\www\sistema-inventario</code></li>
                </ul>
            </div>
        </div>

        <!-- Guía de Configuración -->
        <div class="card" style="margin-bottom: 2rem;">
            <div class="card-title" style="margin-bottom: 1.5rem;">
                🚀 Pasos para conectar MySQL Workbench y crear tu pantalla inicial
            </div>

            <ul class="step-list">
                <li class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4>Crear la Base de Datos en MySQL Workbench</h4>
                        <p>Abre MySQL Workbench y ejecuta la siguiente instrucción SQL para crear la base de datos:</p>
                        <div class="code-block">CREATE DATABASE sistema_inventario;</div>
                    </div>
                </li>

                <li class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4>Configurar el archivo .env en Laravel</h4>
                        <p>Abre el archivo <code>.env</code> en la raíz de tu proyecto y reemplaza la configuración de BD por:</p>
                        <div class="code-block">
DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=sistema_inventario<br>
DB_USERNAME=root<br>
DB_PASSWORD=
                        </div>
                    </div>
                </li>

                <li class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4>Ejecutar Migraciones</h4>
                        <p>Abre tu terminal en la carpeta del proyecto y ejecuta:</p>
                        <div class="code-block">php artisan migrate</div>
                    </div>
                </li>

                <li class="step-item">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4>Crear tu primer Modelo y Controlador</h4>
                        <p>Para gestionar tu inventario (productos, categorías, etc.), puedes usar Artisan:</p>
                        <div class="code-block">php artisan make:model Producto -mcr</div>
                        <p style="margin-top: 0.25rem;">(Crea el modelo, la migración en MySQL y un controlador con métodos CRUD).</p>
                    </div>
                </li>
            </ul>
        </div>

        <footer>
            <p>Sistema de Inventario Laravel &bull; Desarrollado con PHP y MySQL Workbench</p>
        </footer>
    </div>

</body>
</html>
