<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syllabus FUP — Iniciar Sesión</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #BA1B1B 0%, #7a1010 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo img {
            height: 70px;
            object-fit: contain;
        }

        .logo h1 {
            font-size: 22px;
            font-weight: 700;
            color: #BA1B1B;
            margin-top: 12px;
        }

        .logo p {
            font-size: 13px;
            color: #888;
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
            outline: none;
        }

        input:focus {
            border-color: #BA1B1B;
        }

        .error {
            color: #BA1B1B;
            font-size: 12px;
            margin-top: 6px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .remember input {
            width: auto;
        }

        .remember label {
            margin: 0;
            font-weight: 400;
            color: #666;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #BA1B1B;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #9a1515;
        }

        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <img src="{{ asset('images/logo_fup.jpg') }}" alt="FUP Logo">
            <h1>Syllabus FUP</h1>
            <p>Sistema de Gestión de Microcurrículos</p>
        </div>

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label>Correo institucional</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="usuario@fup.edu.co"
                    required
                    autofocus
                >
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input 
                    type="password" 
                    name="password"
                    placeholder="••••••••"
                    required
                >
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Recordarme</label>
            </div>

            <button type="submit">Iniciar sesión</button>
        </form>

        <div class="footer">
            Fundación Universitaria de Popayán © 2026
        </div>
    </div>
</body>
</html>