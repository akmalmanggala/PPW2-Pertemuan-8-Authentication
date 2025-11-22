<!DOCTYPE html>
<html>
    <head>
    <title>Lamaran Diterima</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px 10px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
        .btn { display: inline-block; padding: 12px 24px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 10px 0; }
        .btn:hover { background: #5568d3; }
        .info-box { background: white; padding: 15px; border-left: 4px solid #667eea; margin: 15px 0; }
    </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2 style="margin: 0;">Konfirmasi Lamaran Pekerjaan</h2>
            </div>
            <div class="content">
                <h3>Halo {{ $user->name }},</h3>
                <p>Terima kasih telah melamar pekerjaan <b>{{ $jobVacancy->title }}</b> di <b>{{ $jobVacancy->company }}</b>.</p>
                <p>Lamaran Anda telah kami terima dan sedang diproses oleh tim HR kami.</p>
                
                <div class="info-box">
                    <h4 style="margin-top: 0;">Detail Lamaran:</h4>
                    <p><strong>Posisi:</strong> {{ $jobVacancy->title }}</p>
                    <p><strong>Perusahaan:</strong> {{ $jobVacancy->company }}</p>
                    <p><strong>Lokasi:</strong> {{ $jobVacancy->location }}</p>
                    <p><strong>Tanggal Melamar:</strong> {{ now()->format('d F Y') }}</p>
                </div>

                @if($cvPath)
                <p>Anda dapat mengunduh salinan CV yang telah Anda kirimkan:</p>
                <a href="{{ url('storage/' . $cvPath) }}" class="btn">📄 Download CV Saya</a>
                @endif

                <p style="margin-top: 20px;">Kami akan menghubungi Anda melalui email ini jika ada perkembangan terkait lamaran Anda.</p>
                
                <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
                <p style="margin-bottom: 5px;">Salam hormat,</p>
                <p style="margin-top: 5px;"><b>Tim Job Portal</b></p>
            </div>
        </div>
    </body>
</html>

