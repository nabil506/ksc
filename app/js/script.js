const hiddenElements =
    document.querySelectorAll(".hidden");

const observer =
    new IntersectionObserver((entries) => {

        entries.forEach((entry) => {

            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }

        });

    });

hiddenElements.forEach((el) => {
    observer.observe(el);
});

const countdown =
    document.getElementById("countdown");

if (countdown) {

    const targetDate =
        new Date("June 30, 2026 08:00:00").getTime();

    setInterval(() => {

        const now = new Date().getTime();

        const distance =
            targetDate - now;

        const days =
            Math.floor(distance / (1000 * 60 * 60 * 24));

        countdown.innerHTML =
            "⏳ " + days + " Hari Lagi";

    }, 1000);

}

function filterGallery(category) {

    const items =
        document.querySelectorAll(".gallery-item");

    items.forEach(item => {

        if (category === "all") {

            item.style.display = "block";

        } else {

            if (item.classList.contains(category)) {

                item.style.display = "block";

            } else {

                item.style.display = "none";

            }

        }

    });

}

const galleryImages =
    document.querySelectorAll(".gallery-item img");

const lightbox =
    document.getElementById("lightbox");

const lightboxImg =
    document.getElementById("lightbox-img");

galleryImages.forEach(img => {

    img.addEventListener("click", () => {

        lightbox.style.display = "flex";

        lightboxImg.src = img.src;

    });

});

if (lightbox) {

    lightbox.addEventListener("click", () => {

        lightbox.style.display = "none";

    });

}

// /* =========================
//    REGISTER
// ========================= */

// const registerForm =
//     document.getElementById("registerForm");

// if (registerForm) {

//     registerForm.addEventListener("submit", function (e) {

//         const password =
//             document.getElementById("password").value;

//         const confirmPassword =
//             document.getElementById("confirmPassword").value;

//         // Validasi kecocokan tetap dilakukan di sisi client (JS) sebelum dikirim
//         if (password !== confirmPassword) {

//             e.preventDefault(); // Menahan form hanya jika password tidak cocok

//             alert("Password tidak cocok!");

//             return;
//         }

//         // Catatan: e.preventDefault() sengaja dilepas jika sukses agar form beralih 
//         // mengirimkan datanya ke action="/proses-daftar" di Controller PHP.

//     });

// }

// /* =========================
//    LOGIN (DISESUAIKAN UNTUK BACKEND PHP)
// ========================= */

// const loginForm =
//     document.getElementById("loginForm");

// if (loginForm) {

//     loginForm.addEventListener("submit", function (e) {

//         // Ambil data nilai input email dan password
//         const email =
//             document.getElementById("loginEmail").value;

//         const password =
//             document.getElementById("loginPassword").value;

//         // Validasi dasar client-side jika kolom kosong sebelum dikirim ke PHP
//         if (email.trim() === "" || password.trim() === "") {
            
//             e.preventDefault(); // Tahan form jika ada yang kosong
            
//             alert("Email dan Password wajib diisi!");
            
//             return;
//         }

//         // Catatan: e.preventDefault() sengaja dilepas jika input valid,
//         // sehingga form otomatis mengirim data ke action="/proses-login" di Controller.

//     });

// }

/* =========================
   DASHBOARD
========================= */

const welcomeText =
    document.getElementById("welcomeText");

if (welcomeText) {

    const user =
        JSON.parse(
            localStorage.getItem("kscUser")
        );

    const isLogin =
        localStorage.getItem("isLogin");

    if (isLogin !== "true") {

        window.location.href =
            "login.html";

    }

    if (user) {

        welcomeText.innerHTML =
            "Selamat Datang, " +
            user.nama +
            " 👋";

    }

}

/* =========================
   LOGOUT
========================= */

function logout() {

    localStorage.removeItem("isLogin");

    window.location.href =
        "login.html";

}

/* =========================
   MEMBER PROFILE
========================= */

const memberName =
    document.getElementById("memberName");

const memberEmail =
    document.getElementById("memberEmail");

if (memberName && memberEmail) {

    const user =
        JSON.parse(
            localStorage.getItem("kscUser")
        );

    if (user) {

        memberName.innerHTML =
            "<strong>Nama:</strong> " +
            user.nama;

        memberEmail.innerHTML =
            "<strong>Email:</strong> " +
            user.email;
    }

}

/* =========================
   MOBILE MENU
========================= */

const menuToggle =
    document.querySelector(".menu-toggle");

const navLinks =
    document.querySelector(".nav-links");

if (menuToggle) {

    menuToggle.addEventListener("click", () => {

        navLinks.classList.toggle("active");

    });

}

/* =========================
   DARK MODE
========================= */

const darkModeToggle =
    document.getElementById("darkModeToggle");

if (localStorage.getItem("theme") === "dark") {

    document.body.classList.add("dark-mode");

    if (darkModeToggle) {

        darkModeToggle.innerHTML = "☀️";

    }

}

if (darkModeToggle) {

    darkModeToggle.addEventListener("click", () => {

        document.body.classList.toggle("dark-mode");

        if (
            document.body.classList.contains(
                "dark-mode"
            )
        ) {

            localStorage.setItem(
                "theme",
                "dark"
            );

            darkModeToggle.innerHTML =
                "☀️";

        }

        else {

            localStorage.setItem(
                "theme",
                "light"
            );

            darkModeToggle.innerHTML =
                "🌙";

        }

    });

}

/* =========================
   COUNTER ANIMATION
========================= */

const counters =
    document.querySelectorAll(".counter");

counters.forEach(counter => {

    const updateCounter = () => {

        const target =
            +counter.getAttribute(
                "data-target"
            );

        const current =
            +counter.innerText;

        const increment =
            target / 100;

        if (current < target) {

            counter.innerText =
                Math.ceil(
                    current + increment
                );

            setTimeout(
                updateCounter,
                20
            );

        }

        else {

            counter.innerText =
                target;

        }

    };

    updateCounter();

});

/* =========================
   CONTACT FORM
========================= */

const contactForm =
    document.getElementById("contactForm");

if (contactForm) {

    contactForm.addEventListener("submit", (e) => {

        e.preventDefault();

        alert(
            "Pesan berhasil dikirim! Kami akan menghubungi Anda segera."
        );

        contactForm.reset();

    });

}

/* =========================
   EVENT REGISTRATION
========================= */

function openEventForm() {

    const modal =
        document.getElementById(
            "eventModal"
        );

    if (modal) {

        modal.style.display =
            "flex";

    }

}

function closeEventForm() {

    const modal =
        document.getElementById(
            "eventModal"
        );

    if (modal) {

        modal.style.display =
            "none";

    }

}

const eventForm =
    document.getElementById(
        "eventForm"
    );

if (eventForm) {

    eventForm.addEventListener(
        "submit",
        function (e) {

            e.preventDefault();

            const registrations =
                JSON.parse(
                    localStorage.getItem(
                        "eventRegistrations"
                    )
                ) || [];

            registrations.push({

                nomorPeserta:
                    "KSC" +
                    String(
                        registrations.length + 1
                    ).padStart(3, "0"),

                nama:
                    document.getElementById(
                        "namaAtlet"
                    ).value,

                umur:
                    document.getElementById(
                        "umurAtlet"
                    ).value,

                wa:
                    document.getElementById(
                        "waAtlet"
                    ).value,

                kategori:
                    document.getElementById(
                        "kategori"
                    ).value

            });

            localStorage.setItem(

                "eventRegistrations",

                JSON.stringify(
                    registrations
                )

            );

            alert(
                "Pendaftaran berhasil!"
            );

            eventForm.reset();

            closeEventForm();

        }

    );

}

const registrationTable =
    document.querySelector(
        "#registrationTable tbody"
    );

if (registrationTable) {

    const registrations =
        JSON.parse(
            localStorage.getItem(
                "eventRegistrations"
            )
        ) || [];

    registrations.forEach((data, index) => {

        const row =
            document.createElement("tr");

        row.innerHTML = `

            <td>${data.nomorPeserta}</td>

            <td>${data.nama}</td>       

            <td>${data.umur}</td>

            <td>${data.wa}</td>

            <td>${data.kategori}</td>

            <td>

                <button
                    class="print-btn"
                    onclick="printCard(${index})">

                    Cetak

                </button>

                <button
                    class="delete-btn"
                    onclick="deleteRegistration(${index})">

                    Hapus

                </button>

            </td>

        `;

        registrationTable.appendChild(row);

    });

}

function deleteRegistration(index) {

    const registrations =
        JSON.parse(
            localStorage.getItem(
                "eventRegistrations"
            )
        ) || [];

    registrations.splice(index, 1);

    localStorage.setItem(

        "eventRegistrations",

        JSON.stringify(
            registrations
        )

    );

    location.reload();

}

// Registration table logic end

function printCard(index) {

    const registrations =
        JSON.parse(
            localStorage.getItem(
                "eventRegistrations"
            )
        ) || [];

    const atlet =
        registrations[index];

    const kartu =
        window.open(
            "",
            "",
            "width=600,height=700"
        );

    kartu.document.write(`

    <html>

    <head>

    <title>
    Kartu Peserta
    </title>

    <style>

        body{

            font-family:Arial;

            padding:40px;

            text-align:center;
        }

        .card{

            border:3px solid #0A4D8C;

            border-radius:20px;

            padding:30px;
        }

        h1{

            color:#0A4D8C;
        }

    </style>

    </head>

    <body>

        <div class="card">

            <h1>
                Krian Swimming Club
            </h1>

            <hr>

            <h3>

                Nomor Peserta

                <br>

                ${atlet.nomorPeserta}

            </h3>

            <p>

                Nama :

                ${atlet.nama}

            </p>

            <p>

                Umur :

                ${atlet.umur}

            </p>

            <p>

                Kategori :

                ${atlet.kategori}

            </p>

        </div>

    </body>

    </html>

    `);

    kartu.print();

}

/* =========================
   EVENT CHART
========================= */

const chartCanvas =
    document.getElementById("eventChart");

if (chartCanvas) {

    const registrations =
        JSON.parse(
            localStorage.getItem(
                "eventRegistrations"
            )
        ) || [];

    document.getElementById(
        "totalPeserta"
    ).innerText =
        registrations.length;

    let bebas50 = 0;
    let bebas100 = 0;
    let dada200 = 0;
    let relay = 0;

    registrations.forEach(item => {

        if (item.kategori ===
            "50m Gaya Bebas")
            bebas50++;

        else if (item.kategori ===
            "100m Gaya Bebas")
            bebas100++;

        else if (item.kategori ===
            "200m Gaya Dada")
            dada200++;

        else
            relay++;

    });

    new Chart(chartCanvas, {

        type: "bar",

        data: {

            labels: [

                "50m Bebas",
                "100m Bebas",
                "200m Dada",
                "Relay"

            ],

            datasets: [{

                label:
                    "Jumlah Peserta",

                data: [

                    bebas50,
                    bebas100,
                    dada200,
                    relay

                ]

            }]

        }

    });

}

// End of script