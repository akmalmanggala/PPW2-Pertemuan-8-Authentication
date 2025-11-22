<!DOCTYPE html>
<html>
    <head>
        <title>Pemberitahuan Status Lamaran</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white; padding: 30px 20px; border-radius: 10px 10px 0 0; text-align: center; }
            .header h1 { margin: 0; font-size: 28px; }
            .content { background: #f9fafb; padding: 30px; }
            .info-icon { font-size: 60px; text-align: center; margin: 20px 0; }
            .info-box { background: white; padding: 20px; border-left: 4px solid #6366f1; margin: 20px 0; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
            .info-box h3 { margin-top: 0; color: #4f46e5; }
            .info-item { margin: 10px 0; }
            .info-item strong { color: #4f46e5; }
            .encouragement { background: #eef2ff; padding: 20px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #818cf8; }
            .encouragement h3 { color: #4f46e5; margin-top: 0; }
            .encouragement ul { padding-left: 20px; }
            .encouragement li { margin: 8px 0; }
            .footer { text-align: center; padding: 20px; background: white; border-radius: 0 0 10px 10px; color: #6b7280; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>📧 Pemberitahuan Status Lamaran</h1>
                <p style="margin: 10px 0 0 0; font-size: 16px;">Update Terkait Lamaran Anda</p>
            </div>
            <div class="content">
                <div class="info-icon">📋</div>

                <p>Terima kasih, <strong>{{ $application->user->name }}</strong>,</p>

                <p>Terima kasih atas waktu dan minat Anda untuk melamar posisi <strong>{{ $application->jobVacancy->title }}</strong> di <strong>{{ $application->jobVacancy->company }}</strong>.</p>

                <p>Setelah melalui proses seleksi yang ketat dan mempertimbangkan berbagai aspek, dengan berat hati kami informasikan bahwa saat ini kami memutuskan untuk <strong>tidak melanjutkan</strong> proses lamaran Anda untuk posisi tersebut.</p>

                <div class="info-box">
                    <h3>📋 Detail Lamaran</h3>
                    <div class="info-item"><strong>Posisi:</strong> {{ $application->jobVacancy->title }}</div>
                    <div class="info-item"><strong>Perusahaan:</strong> {{ $application->jobVacancy->company }}</div>
                    <div class="info-item"><strong>Lokasi:</strong> {{ $application->jobVacancy->location }}</div>
                    <div class="info-item"><strong>Tanggal Melamar:</strong> {{ $application->created_at->format('d F Y') }}</div>
                    <div class="info-item"><strong>Status:</strong> <span style="color: #6b7280; font-weight: bold;">Tidak Dilanjutkan</span></div>
                </div>

                <p>Keputusan ini tidak mengurangi apresiasi kami terhadap kualifikasi dan pengalaman Anda. Proses seleksi kami sangat kompetitif, dan kami harus membuat keputusan yang sulit berdasarkan kebutuhan spesifik posisi saat ini.</p>

                <div class="encouragement">
                    <h3>💪 Jangan Berkecil Hati!</h3>
                    <ul>
                        <li>Terus kembangkan skill dan pengalaman Anda</li>
                        <li>CV dan profil Anda tetap tersimpan di database kami untuk kesempatan di masa depan</li>
                        <li>Kami akan menghubungi Anda jika ada posisi lain yang sesuai</li>
                        <li>Anda sangat welcome untuk melamar posisi lain yang tersedia di Job Portal</li>
                        <li>Jangan menyerah! Setiap penolakan adalah langkah menuju kesuksesan</li>
                    </ul>
                </div>

                <p style="margin-top: 25px;">Kami berharap Anda segera menemukan peluang karir yang sesuai dengan kualifikasi dan aspirasi Anda. Terima kasih sekali lagi atas minat Anda terhadap {{ $application->jobVacancy->company }}.</p>

                <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 25px 0;">
                <p style="margin-bottom: 5px;">Salam hormat,</p>
                <p style="margin-top: 5px; font-weight: bold; color: #4f46e5;">Tim HR {{ $application->jobVacancy->company }}</p>
                <p style="margin-top: 5px; font-size: 14px; color: #6b7280;">Job Portal - Connecting Talents with Opportunities</p>
            </div>
            <div class="footer">
                <p style="font-size: 12px; margin: 5px 0;">Email ini dikirim secara otomatis, mohon untuk tidak membalas.</p>
                <p style="font-size: 12px; margin: 5px 0;">&copy; {{ date('Y') }} Job Portal. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
