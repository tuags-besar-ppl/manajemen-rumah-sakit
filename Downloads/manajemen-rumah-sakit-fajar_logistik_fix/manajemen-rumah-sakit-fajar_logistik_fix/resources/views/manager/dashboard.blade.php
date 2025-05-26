<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Manager Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/DashboardManager.css') }}">
</head>
<body>
    <div class="app-container">
        <header class="header">
            
            <nav class="nav">
                <a href="#" class="nav-item active">Dashboard</a>
                <a href="#" class="nav-item">List Peralatan</a>
                <a href="#" class="nav-item">Rekapitulasi Peralatan</a>
                <a href="#" class="nav-item">Laporan Alat Rusak</a>
                <a href="#" class="nav-item">Kategori Alat</a>
            </nav>
            
            <div class="user-actions">
                <button class="icon-button">
                    <i class="fas fa-search"></i>
                </button>
                <button class="icon-button">
                    <i class="fas fa-envelope"></i>
                </button>
                <button class="icon-button">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="user-avatar">AR</div>
            </div>
        </header>
        
        <main class="main-content">
            <div class="container">
                <h1>Dashboard Rekapitulasi</h1>
                
                <div class="status-cards">
                    <div class="status-card">
                        <div class="status-number">142</div>
                        <div class="status-label">Jumlah Alat</div>
                        <div class="status-icon tools-icon"><i class="fas fa-tools"></i></div>
                    </div>
                    
                    <div class="status-card">
                        <div class="status-number">36</div>
                        <div class="status-label">Sedang digunakan</div>
                        <div class="status-icon in-use-icon"><i class="fas fa-sync-alt"></i></div>
                    </div>
                    
                    <div class="status-card">
                        <div class="status-number">7</div>
                        <div class="status-label">Alat Rusat</div>
                        <div class="status-icon damaged-icon"><i class="fas fa-exclamation-circle"></i></div>
                    </div>
                </div>
                
                <div class="filter-section">
                    <div class="filters">
                        <h3>Filters</h3>
                        
                        <div class="filter-group">
                            <h4>Equipment Status</h4>
                            <div class="checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" checked>
                                    <span class="checkbox-custom"></span>
                                    Tersedia
                                </label>
                                
                                <label class="checkbox-label">
                                    <input type="checkbox" checked>
                                    <span class="checkbox-custom"></span>
                                    Sedang Digunakan
                                </label>
                                
                                <label class="checkbox-label">
                                    <input type="checkbox" checked>
                                    <span class="checkbox-custom"></span>
                                    Siap digunakan
                                </label>
                                
                                <label class="checkbox-label">
                                    <input type="checkbox">
                                    <span class="checkbox-custom"></span>
                                    Rusak
                                </label>
                            </div>
                        </div>
                        
                        <div class="filter-group">
                            <h4>Filter By</h4>
                            <div class="radio-group">
                                <label class="radio-label active">
                                    <input type="radio" name="filter-time" checked>
                                    <span class="radio-custom"></span>
                                    <i class="fas fa-clock"></i> Recent Usage
                                </label>
                                
                                <label class="radio-label">
                                    <input type="radio" name="filter-time">
                                    <span class="radio-custom"></span>
                                    <i class="fas fa-hourglass-half"></i> Last Hour
                                </label>
                                
                                <label class="radio-label">
                                    <input type="radio" name="filter-time">
                                    <span class="radio-custom"></span>
                                    <i class="fas fa-calendar-day"></i> Today
                                </label>
                                
                                <label class="radio-label">
                                    <input type="radio" name="filter-time">
                                    <span class="radio-custom"></span>
                                    <i class="fas fa-calendar-alt"></i> Custom Date
                                </label>
                            </div>
                        </div>
                        
                    </div>                        
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        // Basic JavaScript for interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Status filters functionality
            const statusCheckboxes = document.querySelectorAll('.checkbox-group input[type="checkbox"]');
            const equipmentCards = document.querySelectorAll('.equipment-card');
            
            statusCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Simple toggle for demo purposes
                    console.log('Filter changed');
                });
            });
            
            // View mode toggle
            const viewToggle = document.querySelector('.toggle input[type="checkbox"]');
            const equipmentList = document.querySelector('.equipment-list');
            
            if (viewToggle && equipmentList) {
                viewToggle.addEventListener('change', function() {
                    if (this.checked) {
                        equipmentList.classList.add('table-view');
                        equipmentList.classList.remove('card-view');
                    } else {
                        equipmentList.classList.add('card-view');
                        equipmentList.classList.remove('table-view');
                    }
                });
            }
        });
    </script>
</body>
</html>