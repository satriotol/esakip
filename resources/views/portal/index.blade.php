<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal E-SAKIP Kota Semarang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
      body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
      }
      
      body::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: moveBackground 20s linear infinite;
      }
      
      @keyframes moveBackground {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
      }
      
      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      @keyframes pulse {
        0%, 100% {
          transform: scale(1);
        }
        50% {
          transform: scale(1.05);
        }
      }
      
      .portal-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: none;
        animation: fadeInUp 0.6s ease-out;
        position: relative;
        z-index: 1;
      }
      
      .portal-title {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
      }
      
      .portal-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 2rem;
      }
      
      .btn-portal {
        padding: 15px 25px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: none;
        position: relative;
        overflow: hidden;
      }
      
      .btn-portal::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
      }
      
      .btn-portal:hover::before {
        width: 300px;
        height: 300px;
      }
      
      .btn-portal-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
      }
      
      .btn-portal-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
        color: white;
      }
      
      .btn-portal-secondary {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }
      
      .btn-portal-secondary:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
      }
      
      .icon-wrapper {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      
      .logo-container {
        text-align: center;
        margin-bottom: 2rem;
        animation: fadeInUp 0.8s ease-out;
      }
      
      .logo-circle {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        animation: pulse 2s ease-in-out infinite;
      }
      
      .logo-circle i {
        font-size: 2.5rem;
        color: white;
      }
      
      .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
        color: #9ca3af;
        font-size: 0.875rem;
      }
      
      .divider::before,
      .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #e5e7eb;
      }
      
      .divider span {
        padding: 0 1rem;
      }
    </style>
  </head>
  <body>
    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center py-5">
      <div class="card portal-card shadow-lg p-5" style="max-width: 480px; width: 100%;">
        <div class="logo-container">
          <div class="logo-circle">
            <i class="bi bi-speedometer2"></i>
          </div>
        </div>
        
        <h1 class="portal-title text-center">Portal E-SAKIP</h1>
        <p class="portal-subtitle text-center">Sistem Akuntabilitas Kinerja Instansi Pemerintah<br>Kota Semarang</p>
        
        <div class="d-grid gap-3">
          <a href="https://e-sakipv2.semarangkota.go.id" class="btn-portal btn-portal-primary" target="_blank" rel="noopener">
            <span class="icon-wrapper">
              <i class="bi bi-link-45deg"></i>
            </span>
            <span>E-SAKIP Versi 2</span>
          </a>
          
          <div class="divider">
            <span>atau tetap di versi ini</span>
          </div>
          
          <a href="{{ route('login') }}" class="btn-portal btn-portal-secondary">
            <span class="icon-wrapper">
              <i class="bi bi-box-arrow-in-right"></i>
            </span>
            <span>Login Versi Lama</span>
          </a>
        </div>
        
        <div class="text-center mt-4">
          <small class="text-muted">
            <i class="bi bi-shield-check"></i> Sistem Terlindungi
          </small>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>