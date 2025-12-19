<section class="min-vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Robot Arm Holding 404 -->
                <div class="position-relative mb-5" style="height: 300px;">
                    <!-- Robot Arm Base -->
                    <div class="position-absolute bottom-0 start-50 translate-middle-x">
                        <svg width="200" height="100">
                            <rect x="70" y="40" width="60" height="40" fill="#333" rx="5" />
                            <rect x="80" y="20" width="40" height="20" fill="#444" rx="3" />
                            <circle cx="100" cy="20" r="8" fill="#f39c12" />
                        </svg>
                    </div>

                    <!-- Robot Arm Segments -->
                    <div class="position-absolute" style="bottom: 80px; left: 50%; transform: translateX(-50%) rotate(-45deg);">
                        <svg width="150" height="20">
                            <rect width="150" height="20" fill="#555" rx="10" />
                            <circle cx="10" cy="10" r="8" fill="#f39c12" />
                            <circle cx="140" cy="10" r="8" fill="#f39c12" />
                        </svg>
                    </div>

                    <!-- Robot Arm Second Segment -->
                    <div class="position-absolute" style="bottom: 140px; left: calc(50% + 40px); transform: rotate(-20deg);">
                        <svg width="100" height="15">
                            <rect width="100" height="15" fill="#666" rx="7.5" />
                            <circle cx="10" cy="7.5" r="6" fill="#d35400" />
                            <circle cx="90" cy="7.5" r="6" fill="#d35400" />
                        </svg>
                    </div>

                    <!-- Gripper Holding Broken Plate -->
                    <div class="position-absolute" style="bottom: 180px; left: calc(50% + 120px);">
                        <!-- Gripper -->
                        <svg width="60" height="40">
                            <rect x="0" y="10" width="20" height="20" fill="#777" rx="3" />
                            <rect x="40" y="10" width="20" height="20" fill="#777" rx="3" />
                            <rect x="15" y="5" width="30" height="30" fill="#888" rx="3" />
                        </svg>

                        <!-- Broken Plate with 404 -->
                        <div class="position-absolute" style="top: -60px; left: -100px;">
                            <div class="card border-0" style="
                                background: linear-gradient(135deg, #333 0%, #222 100%);
                                border: 2px solid #f39c12 !important;
                                border-radius: 10px;
                                transform: rotate(-10deg);
                                box-shadow: 0 10px 30px rgba(243, 156, 18, 0.2);
                                width: 200px;
                                height: 100px;
                                position: relative;
                                overflow: hidden;
                            ">
                                <!-- Crack Effect -->
                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(45deg); width: 3px; height: 100%; background: linear-gradient(transparent, #d35400, transparent);"></div>
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-45deg); width: 3px; height: 100%; background: linear-gradient(transparent, #d35400, transparent);"></div>
                                </div>

                                <!-- 404 Text on Plate -->
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <h1 class="display-4 fw-bold mb-0" style="
                                        background: linear-gradient(45deg, #f39c12, #fff);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                        background-clip: text;
                                    ">
                                        404
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sparks -->
                    <div class="position-absolute" style="top: 120px; right: 30%;">
                        <svg width="50" height="50">
                            {for $i in 1..5}
                            <circle cx="{random(10,40)}" cy="{random(10,40)}" r="{random(1,3)}" fill="#f39c12" opacity="{random(3,7)/10}">
                                <animate attributeName="opacity" values="0.7;0;0.7" dur="{random(5,15)/10}s" repeatCount="indefinite" />
                                <animate attributeName="cy" values="{random(10,40)};{random(10,40)-10}" dur="{random(5,15)/10}s" repeatCount="indefinite" />
                            </circle>
                            {/for}
                        </svg>
                    </div>
                </div>

                <!-- Error Message -->
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold text-uppercase mb-3" style="
                        color: #f39c12;
                        letter-spacing: 3px;
                        text-shadow: 0 0 10px rgba(243, 156, 18, 0.5);
                    ">
                        <i class="fas fa-exclamation-triangle me-3"></i>
                        Komponen Hilang
                        <i class="fas fa-exclamation-triangle ms-3"></i>
                    </h2>

                    <p class="lead mb-4" style="max-width: 600px; margin: 0 auto;">
                        Sistem mekanikal kami tidak dapat menemukan komponen yang Anda minta.
                        Mungkin telah terlepas dari rantai produksi atau belum terpasang.
                    </p>
                </div>

                <!-- Action Panel -->
                <div class="text-center">
                    <div class="btn-group" role="group" aria-label="404 Actions">
                        <a href="/" class="btn btn-lg btn-warning px-4 rounded-start">
                            <i class="fas fa-industry me-2"></i>Kembali ke Awal
                        </a>
                        <a href="javascript:history.back()" class="btn btn-lg btn-success px-4 border-start-0">
                            <i class="fas fa-chevron-left me-2"></i>Kembali ke sebelumnya
                        </a>
                        <button onclick="location.reload()" class="btn btn-lg btn-primary px-4 rounded-end border-start-0">
                            <i class="fas fa-sync-alt me-2"></i>Refresh Halaman
                        </button>
                    </div>
                </div>

                <!-- Status Bar -->
                <div class="mt-5 pt-4 border-top border-secondary">
                    <div class="row align-items-center">
                        <div class="col-md-12 text-md-end">
                            <small class="text-muted">
                                <i class="fas fa-microchip me-1"></i>
                                Industrial Error System v2.4
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add some animation -->
<style>
    @keyframes armMove {

        0%,
        100% {
            transform: translateX(-50%) rotate(-45deg);
        }

        50% {
            transform: translateX(-50%) rotate(-50deg);
        }
    }

    @keyframes gripperMove {

        0%,
        100% {
            transform: rotate(-20deg);
        }

        50% {
            transform: rotate(-15deg);
        }
    }

    @keyframes plateShake {

        0%,
        100% {
            transform: rotate(-10deg);
        }

        25% {
            transform: rotate(-12deg) translateX(2px);
        }

        75% {
            transform: rotate(-8deg) translateX(-2px);
        }
    }

    .position-absolute[style*="bottom: 80px"] svg {
        animation: armMove 3s ease-in-out infinite;
    }

    .position-absolute[style*="bottom: 140px"] svg {
        animation: gripperMove 2s ease-in-out infinite;
    }

    .position-absolute[style*="top: -60px"] .card {
        animation: plateShake 4s ease-in-out infinite;
    }

    /* Glitch effect for error text */
    .glitch-text {
        position: relative;
        display: inline-block;
    }

    .glitch-text::before,
    .glitch-text::after {
        content: attr(data-text);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .glitch-text::before {
        left: 2px;
        text-shadow: -2px 0 #ff00ff;
        clip: rect(44px, 450px, 56px, 0);
        animation: glitch-anim 5s infinite linear alternate-reverse;
    }

    .glitch-text::after {
        left: -2px;
        text-shadow: -2px 0 #00ffff;
        clip: rect(44px, 450px, 56px, 0);
        animation: glitch-anim2 5s infinite linear alternate-reverse;
    }

    @keyframes glitch-anim {
        0% {
            clip: rect(31px, 9999px, 94px, 0);
        }

        5% {
            clip: rect(112px, 9999px, 76px, 0);
        }

        10% {
            clip: rect(85px, 9999px, 77px, 0);
        }

        15% {
            clip: rect(27px, 9999px, 97px, 0);
        }

        20% {
            clip: rect(64px, 9999px, 98px, 0);
        }

        25% {
            clip: rect(111px, 9999px, 73px, 0);
        }

        30% {
            clip: rect(25px, 9999px, 99px, 0);
        }

        35% {
            clip: rect(87px, 9999px, 82px, 0);
        }

        40% {
            clip: rect(11px, 9999px, 18px, 0);
        }

        45% {
            clip: rect(58px, 9999px, 71px, 0);
        }

        50% {
            clip: rect(115px, 9999px, 88px, 0);
        }

        55% {
            clip: rect(7px, 9999px, 29px, 0);
        }

        60% {
            clip: rect(101px, 9999px, 53px, 0);
        }

        65% {
            clip: rect(42px, 9999px, 87px, 0);
        }

        70% {
            clip: rect(79px, 9999px, 24px, 0);
        }

        75% {
            clip: rect(33px, 9999px, 46px, 0);
        }

        80% {
            clip: rect(116px, 9999px, 12px, 0);
        }

        85% {
            clip: rect(63px, 9999px, 59px, 0);
        }

        90% {
            clip: rect(20px, 9999px, 100px, 0);
        }

        95% {
            clip: rect(95px, 9999px, 66px, 0);
        }

        100% {
            clip: rect(48px, 9999px, 33px, 0);
        }
    }
</style>