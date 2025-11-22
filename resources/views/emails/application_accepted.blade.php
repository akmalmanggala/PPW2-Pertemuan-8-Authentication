<!DOCTYPE html>
<html>
    <head>
        <title>Lamaran Diterima</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 30px 20px; border-radius: 10px 10px 0 0; text-align: center; }
            .header h1 { margin: 0; font-size: 28px; }
            .content { background: #f9fafb; padding: 30px; }
            .success-icon { font-size: 60px; text-align: center; margin: 20px 0; }
            .info-box { background: white; padding: 20px; border-left: 4px solid #10b981; margin: 20px 0; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
            .info-box h3 { margin-top: 0; color: #10b981; }
            .info-item { margin: 10px 0; }
            .info-item strong { color: #059669; }
            .next-steps { background: #ecfdf5; padding: 20px; border-radius: 5px; margin: 20px 0; }
            .next-steps h3 { color: #059669; margin-top: 0; }
            .next-steps ul { padding-left: 20px; }
            .next-steps li { margin: 8px 0; }
            .footer { text-align: center; padding: 20px; background: white; border-radius: 0 0 10px 10px; color: #6b7280; }
            .congrats { font-size: 18px; font-weight: bold; color: #059669; text-align: center; margin: 20px 0; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>🎉 SELAMAT!</h1>
                <p style="margin: 10px 0 0 0; font-size: 16px;">Lamaran Anda Telah Diterima</p>
            </div>
            <div class="content">
                <div class="success-icon">✅</div>

                <p class="congrats">Selamat, {{ $application->user->name }}!</p>

                <p>Kami dengan senang hati menginformasikan bahwa lamaran Anda untuk posisi <strong>{{ $application->jobVacancy->title }}</strong> di <strong>{{ $application->jobVacancy->company }}</strong> telah <strong style="color: #10b981;">DITERIMA</strong>.</p>

                <div class="info-box">
                    <h3>📋 Detail Lamaran</h3>
                    <div class="info-item"><strong>Posisi:</strong> {{ $application->jobVacancy->title }}</div>
                    <div class="info-item"><strong>Perusahaan:</strong> {{ $application->jobVacancy->company }}</div>
                    <div class="info-item"><strong>Lokasi:</strong> {{ $application->jobVacancy->location }}</div>
                    <div class="info-item"><strong>Tipe Pekerjaan:</strong>
                        @if($application->jobVacancy->job_type == 'full-time') Full Time
                        @elseif($application->jobVacancy->job_type == 'part-time') Part Time
                        @elseif($application->jobVacancy->job_type == 'contract') Contract
                        @elseif($application->jobVacancy->job_type == 'internship') Internship
                        @elseif($application->jobVacancy->job_type == 'freelance') Freelance
                        @endif
                    </div>
                    @if($application->jobVacancy->salary)
                    <div class="info-item"><strong>Gaji:</strong> Rp {{ number_format($application->jobVacancy->salary, 0, ',', '.') }}</div>
                    @endif
                    <div class="info-item"><strong>Status:</strong> <span style="color: #10b981; font-weight: bold;">DITERIMA</span></div>
                </div>

                <div class="next-steps">
                    <h3>📌 Langkah Selanjutnya</h3>
                    <ul>
                        <li>Tim HR kami akan menghubungi Anda dalam <strong>1-3 hari kerja</strong> untuk membahas detail lebih lanjut</li>
                        <li>Harap pastikan email dan nomor telepon Anda tetap aktif</li>
                        <li>Persiapkan dokumen-dokumen yang diperlukan untuk proses onboarding</li>
                        <li>Jika ada pertanyaan, jangan ragu untuk menghubungi kami</li>
                    </ul>
                </div>

                <p style="margin-top: 25px;">Sekali lagi, selamat atas pencapaian ini! Kami sangat menantikan untuk bekerja sama dengan Anda.</p>

                <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 25px 0;">
                <p style="margin-bottom: 5px;">Salam hormat,</p>
                <p style="margin-top: 5px; font-weight: bold; color: #10b981;">Tim {{ $application->jobVacancy->company }}</p>
                <p style="margin-top: 5px; font-size: 14px; color: #6b7280;">Job Portal - Connecting Talents with Opportunities</p>
            </div>
            <div class="footer">
                <p style="font-size: 12px; margin: 5px 0;">Email ini dikirim secara otomatis, mohon untuk tidak membalas.</p>
                <p style="font-size: 12px; margin: 5px 0;">&copy; {{ date('Y') }} Job Portal. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
