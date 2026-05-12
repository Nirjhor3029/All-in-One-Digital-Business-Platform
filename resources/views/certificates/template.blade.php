<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; padding: 0; }
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            background: #f8f6f0;
        }
        .certificate-wrapper {
            width: 100%;
            height: 100%;
            position: relative;
            padding: 40px;
            box-sizing: border-box;
        }
        .certificate-border {
            border: 3px solid #6366F1;
            padding: 30px;
            min-height: 500px;
            position: relative;
            background: white;
        }
        .certificate-border::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 1px solid #6366F1;
            pointer-events: none;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 36px;
            color: #0F172A;
            margin: 0;
            letter-spacing: 2px;
        }
        .header .subtitle {
            font-size: 14px;
            color: #6366F1;
            margin-top: 5px;
            letter-spacing: 4px;
            text-transform: uppercase;
        }
        .ribbon {
            text-align: center;
            margin: 30px 0;
        }
        .ribbon span {
            display: inline-block;
            background: #6366F1;
            color: white;
            padding: 8px 40px;
            font-size: 14px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .content {
            text-align: center;
            margin: 30px 0;
        }
        .content .label {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }
        .content .name {
            font-size: 32px;
            font-weight: bold;
            color: #0F172A;
            margin: 10px 0;
        }
        .content .course-label {
            font-size: 14px;
            color: #666;
            margin-top: 20px;
        }
        .content .course-name {
            font-size: 22px;
            font-weight: 600;
            color: #6366F1;
            margin: 5px 0;
        }
        .content .date {
            font-size: 13px;
            color: #999;
            margin-top: 20px;
        }
        .content .cert-number {
            font-size: 11px;
            color: #bbb;
            margin-top: 5px;
        }
        .footer {
            position: absolute;
            bottom: 40px;
            left: 40px;
            right: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 0 40px;
        }
        .footer .signature {
            text-align: center;
        }
        .footer .signature .line {
            width: 180px;
            border-top: 1px solid #333;
            margin-bottom: 5px;
        }
        .footer .signature .title {
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="certificate-wrapper">
        <div class="certificate-border">
            <div class="header">
                <h1>{{ config('app.name') }}</h1>
                <div class="subtitle">Certificate of Completion</div>
            </div>

            <div class="ribbon">
                <span>Presented To</span>
            </div>

            <div class="content">
                <div class="label">This certifies that</div>
                <div class="name">{{ $certificate->user->name }}</div>
                <div class="course-label">has successfully completed the course</div>
                <div class="course-name">{{ $certificate->course->title }}</div>
                <div class="date">Completed on {{ $certificate->issued_at->format('F d, Y') }}</div>
                <div class="cert-number">Certificate #{{ $certificate->certificate_number }}</div>
            </div>

            <div class="footer">
                <div class="signature">
                    <div class="line"></div>
                    <div class="title">Date</div>
                </div>
                <div class="signature">
                    <div class="line"></div>
                    <div class="title">Authorized Signature</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
