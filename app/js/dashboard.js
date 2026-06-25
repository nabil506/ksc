document.addEventListener('DOMContentLoaded', function () {
    initTabs();
    initCountdown();
    updateLatihanHariIni();
    initEventForm();
    updateAthleteDashboard();
});

function initTabs() {
    document.querySelectorAll('.tab-content').forEach(function (tab) {
        tab.hidden = !tab.classList.contains('active');
    });

    document.querySelectorAll('.sidebar-link[data-tab]').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            switchTab(link.dataset.tab);
        });
    });
}

function switchTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(function (tab) {
        tab.classList.remove('active');
        tab.hidden = true;
    });

    document.querySelectorAll('.sidebar-link[data-tab]').forEach(function (link) {
        link.classList.toggle('active', link.dataset.tab === tabName);
    });

    const target = document.getElementById('tab-' + tabName);
    if (target) {
        target.hidden = false;
        target.classList.add('active');
    }

    if (tabName === 'beranda') {
        setTimeout(function () {
            updateAthleteDashboard();
            updateLatihanHariIni();
        }, 80);
    }
}

function initCountdown() {
    updateCountdown();
    setInterval(updateCountdown, 1000);
}

function updateCountdown() {
    const target = new Date('2026-06-30T08:00:00+07:00');
    const diff = target.getTime() - Date.now();
    const safeDiff = Math.max(diff, 0);
    const days = Math.floor(safeDiff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((safeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((safeDiff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((safeDiff % (1000 * 60)) / 1000);

    setText('hariMundur', days);
    setText('cdHari', String(days).padStart(2, '0'));
    setText('cdJam', String(hours).padStart(2, '0'));
    setText('cdMenit', String(minutes).padStart(2, '0'));
    setText('cdDetik', String(seconds).padStart(2, '0'));
    /* beranda mini-countdown */
    setText('cdHariB',  String(days).padStart(2, '0'));
    setText('cdJamB',   String(hours).padStart(2, '0'));
    setText('cdMenitB', String(minutes).padStart(2, '0'));
    setText('cdDetikB', String(seconds).padStart(2, '0'));
}

function updateLatihanHariIni() {
    const container = document.getElementById('latihanHariIni');
    if (!container) return;

    const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const today = dayNames[new Date().getDay()];
    setText('todayLabel', today + ', ' + new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }));
    const schedules = {
        Senin: [
            { waktu: '06.00 - 08.00', kelompok: 'Pemula', pelatih: 'Coach Andi' },
            { waktu: '15.00 - 17.00', kelompok: 'Prestasi', pelatih: 'Coach Sari' }
        ],
        Selasa: [
            { waktu: '06.00 - 08.00', kelompok: 'Remaja', pelatih: 'Coach Budi' }
        ],
        Rabu: [
            { waktu: '06.00 - 08.00', kelompok: 'Pemula', pelatih: 'Coach Sari' }
        ],
        Kamis: [
            { waktu: '17.00 - 19.00', kelompok: 'Dewasa', pelatih: 'Coach Rina' }
        ],
        Jumat: [
            { waktu: '15.00 - 17.00', kelompok: 'Prestasi', pelatih: 'Coach Sari' }
        ],
        Sabtu: [
            { waktu: '07.00 - 10.00', kelompok: 'Semua Kelompok', pelatih: 'Semua Pelatih' }
        ],
        Minggu: []
    };

    const sessions = schedules[today] || [];
    if (sessions.length === 0) {
        container.innerHTML = '<p class="empty-note">Hari ini libur latihan. Gunakan waktu untuk pemulihan.</p>';
        return;
    }

    container.innerHTML = sessions.map(function (item) {
        return '<div class="training-item"><strong>' + item.waktu + '</strong><span>' +
            item.kelompok + ' bersama ' + item.pelatih + '</span></div>';
    }).join('');
}

function filterJadwal(group, button) {
    document.querySelectorAll('.filter-btn').forEach(function (item) {
        item.classList.remove('active');
    });
    if (button) button.classList.add('active');

    document.querySelectorAll('#jadwalTable tbody tr').forEach(function (row) {
        row.style.display = group === 'semua' || row.dataset.kelompok === group || row.dataset.kelompok === 'semua'
            ? ''
            : 'none';
    });
}

function initEventForm() {
    const modal = document.getElementById('eventModal');
    const form = document.getElementById('eventForm');

    if (modal) {
        modal.addEventListener('click', function (event) {
            if (event.target === modal) closeEventForm();
        });
    }

    if (!form) return;
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const registrations = getRegistrations();
        registrations.push({
            nomorPeserta: 'KSC' + String(registrations.length + 1).padStart(3, '0'),
            nama: document.getElementById('namaAtlet').value.trim(),
            umur: document.getElementById('umurAtlet').value,
            wa: document.getElementById('waAtlet').value.trim(),
            kategori: document.getElementById('kategori').value
        });

        localStorage.setItem('eventRegistrations', JSON.stringify(registrations));
        closeEventForm();
        form.reset();
        updateAthleteDashboard();
        alert('Pendaftaran berhasil! Nomor peserta: ' + registrations[registrations.length - 1].nomorPeserta);
    });
}

function openEventForm() {
    const modal = document.getElementById('eventModal');
    if (modal) modal.classList.add('open');
}

function closeEventForm() {
    const modal = document.getElementById('eventModal');
    if (modal) modal.classList.remove('open');
}

function getRegistrations() {
    try {
        return JSON.parse(localStorage.getItem('eventRegistrations')) || [];
    } catch (error) {
        return [];
    }
}

function updateDashboardTotals() {
    /* kept for backward compat — delegates to athlete dashboard */
    updateAthleteDashboard();
}

function updateAthleteDashboard() {
    var regs = getRegistrations();
    var total = regs.length;

    /* stat cards */
    setText('statEventSaya', total);
    setText('totalDaftar', total);   /* profil tab */

    /* --- My Registrations list on beranda --- */
    var listEl = document.getElementById('myRegList');
    if (listEl) {
        if (total === 0) {
            listEl.innerHTML = '<li class="my-reg-empty">Kamu belum mendaftar event apapun.</li>';
        } else {
            var catColors = {
                '50m Gaya Bebas':  '#4A90D9',
                '100m Gaya Bebas': '#0A4D8C',
                '200m Gaya Dada':  '#1abc9c',
                'Relay 4x50m':     '#f5a300'
            };
            listEl.innerHTML = regs.map(function (item) {
                var color = catColors[item.kategori] || '#0a4d8c';
                var initials = item.nama ? item.nama.substring(0, 2).toUpperCase() : '??';
                return [
                    '<li class="my-reg-item">',
                    '  <span class="reg-avatar" style="background:' + color + '">' + initials + '</span>',
                    '  <span class="my-reg-info">',
                    '    <strong>' + escapeHtml(item.kategori) + '</strong>',
                    '    <small>' + item.nomorPeserta + ' &bull; KSC National Cup 2026</small>',
                    '  </span>',
                    '  <span class="my-reg-status">Terdaftar</span>',
                    '</li>'
                ].join('');
            }).join('');
        }
    }

    /* --- update beranda button label if already registered --- */
    var btnBeranda = document.getElementById('btnDaftarBeranda');
    if (btnBeranda) {
        btnBeranda.textContent = total > 0 ? 'Tambah Kategori' : 'Daftar Sekarang';
    }
}

let miniChartInstance = null;

const REG_CATEGORIES = [
    { key: '50m Gaya Bebas',  label: '50m Bebas',  color: '#4A90D9' },
    { key: '100m Gaya Bebas', label: '100m Bebas', color: '#0A4D8C' },
    { key: '200m Gaya Dada',  label: '200m Dada',  color: '#1abc9c' },
    { key: 'Relay 4x50m',     label: 'Relay',      color: '#f5a300' }
];

function renderMiniChart() {
    const canvas = document.getElementById('miniChart');
    if (!canvas || typeof Chart === 'undefined') return;

    const data       = getRegistrations();
    const total      = data.length;
    const counts     = REG_CATEGORIES.map(function (cat) {
        return data.filter(function (item) { return item.kategori === cat.key; }).length;
    });

    /* --- update total badge --- */
    setText('regTotalBadge', total);

    /* --- category list with progress bars --- */
    const listEl = document.getElementById('regCategoryList');
    if (listEl) {
        if (total === 0) {
            listEl.innerHTML = '<p class="reg-no-data">Belum ada data pendaftaran.</p>';
        } else {
            listEl.innerHTML = REG_CATEGORIES.map(function (cat, i) {
                const count   = counts[i];
                const pct     = total > 0 ? Math.round((count / total) * 100) : 0;
                return [
                    '<div class="reg-cat-item">',
                    '  <div class="reg-cat-top">',
                    '    <span class="reg-cat-dot" style="background:' + cat.color + '"></span>',
                    '    <span class="reg-cat-name">' + cat.label + '</span>',
                    '    <span class="reg-cat-count">' + count + ' peserta</span>',
                    '  </div>',
                    '  <div class="reg-cat-bar-track">',
                    '    <div class="reg-cat-bar-fill" style="width:' + pct + '%;background:' + cat.color + '" data-pct="' + pct + '"></div>',
                    '  </div>',
                    '</div>'
                ].join('');
            }).join('');

            /* animate bars after paint */
            requestAnimationFrame(function () {
                document.querySelectorAll('.reg-cat-bar-fill').forEach(function (el) {
                    el.style.width = el.dataset.pct + '%';
                });
            });
        }
    }

    /* --- recent registrants list --- */
    const recentEl = document.getElementById('regRecentList');
    if (recentEl) {
        if (data.length === 0) {
            recentEl.innerHTML = '<li class="reg-recent-empty">Belum ada pendaftar.</li>';
        } else {
            var recent = data.slice(-5).reverse();
            recentEl.innerHTML = recent.map(function (item) {
                var initials = item.nama ? item.nama.substring(0, 2).toUpperCase() : '??';
                var catColor = '#0a4d8c';
                REG_CATEGORIES.forEach(function (cat) {
                    if (cat.key === item.kategori) catColor = cat.color;
                });
                return [
                    '<li class="reg-recent-item">',
                    '  <span class="reg-avatar" style="background:' + catColor + '">' + initials + '</span>',
                    '  <span class="reg-recent-info">',
                    '    <strong>' + escapeHtml(item.nama) + '</strong>',
                    '    <small>' + escapeHtml(item.kategori) + ' &bull; ' + item.nomorPeserta + '</small>',
                    '  </span>',
                    '</li>'
                ].join('');
            }).join('');
        }
    }

    /* --- donut chart --- */
    const chartData = total === 0 ? [1, 1, 1, 1] : counts;
    const chartColors = total === 0
        ? ['#e6edf5', '#dce7f2', '#d0dff0', '#c8d9ed']
        : REG_CATEGORIES.map(function (c) { return c.color; });

    if (miniChartInstance) miniChartInstance.destroy();
    miniChartInstance = new Chart(canvas.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: REG_CATEGORIES.map(function (c) { return c.label; }),
            datasets: [{
                data: chartData,
                backgroundColor: chartColors,
                borderWidth: total === 0 ? 0 : 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: { enabled: total > 0 }
            }
        }
    });
}

function setText(id, value) {
    const element = document.getElementById(id);
    if (element) element.textContent = value;
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}
