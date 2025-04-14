<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>Job Application</title>
    <link href="{{ asset('front') }}/libs/bootstrap/css/bootstrap.rtl.min.css" rel="stylesheet" type="text/css" />
    <style>
        @page {
            margin: 30px;
            border-width: 4px;
            border-color: black;
            border-style: double solid double solid;
        }
        body {
            font-family: sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 5px;
        }
        .section-title {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 5px;
            margin-top: 15px;
        }
        .info-table td {
            border: none;
            padding: 3px 5px;
        }
        header
        {
            border-bottom: 4px solid black;
        }
    </style>
</head>
<body>
    <header class="d-flex justify-content-between align-items-center px-4">
        <div>
            <h1 class="fs-4 fw-bold">نموذج طلب وظيفه بشركه بروكلين لاداره المطاعم</h1>
            <p class="mb-0 fw-bold fs-6">
                التاريخ: {{ $job_application->created_at->format('Y/m/d') }} : Date
            </p>
        </div>
        <img src="{{ asset('storage/' . $settings->logo) }}" height="90px">
    </header>

    <table>
        <tr>
            <td colspan="2" rowspan="5" width="20%" class="text-center fw-bold">
                <span class="d-block">معلومات شخصية</span>
                <span class="d-block">Personal Information</span>
            </td>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">تاريخ الميلاد:</span>
                    <span>{{ $job_application->date_of_birth }}</span>
                    <span class="fw-bold" dir="ltr">Date of birth:</span>
                </div>
            </td>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">الاسم:</span>
                    <span>{{ $job_application->name }}</span>
                    <span class="fw-bold" dir="ltr">Name:</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">الجنسية:</span>
                    <span>{{ $job_application->nationality }}</span>
                    <span class="fw-bold" dir="ltr">Nationality:</span>
                </div>
            </td>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">العنوان:</span>
                    <span class="text-center px-1">{{ $job_application->address }}</span>
                    <span class="fw-bold" dir="ltr">Address:</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">الديانة:</span>
                    <span>{{ $job_application->religion }}</span>
                    <span class="fw-bold" dir="ltr">Religion:</span>
                </div>
            </td>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">هل لديك شهادة صحية سارية:</span>
                    <span>{{ $job_application->do_you_have_health_certificate ? 'نعم' : 'لا' }}</span>
                    <span class="fw-bold" dir="ltr">Health certificate:</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">الحالة الاجتماعية:</span>
                    <span>{{ $job_application->social_status }}</span>
                    <span class="fw-bold" dir="ltr">Social status:</span>
                </div>
            </td>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">رقم الهاتف:</span>
                    <span>{{ $job_application->phone_number }}</span>
                    <span class="fw-bold" dir="ltr">Home Tel. #.:</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">عدد الأطفال:</span>
                    <span>{{ $job_application->no_of_childs }}</span>
                    <span class="fw-bold" dir="ltr">No. of Children:</span>
                </div>
            </td>
            <td colspan="2" width="40%">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">الموقف من الخدمة العسكريه:</span>
                    <span>{{ $job_application->military_service }}</span>
                    <span class="fw-bold" dir="ltr">Military service:</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="border-0"></td>
            <td colspan="4">
                <div class="d-flex justify-content-center gap-5 fw-bold ps-3">
                    <span>التعليم</span>
                    <span>Education</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="fw-bold text-center">
                <span class="d-block">المؤهلات وتاريخ حصولك عليها</span>
                <span class="d-block">Qualifications obtained & date of certification</span>
            </td>
            <td colspan="2" class="fw-bold text-center">
                <span class="d-block">أسماء المدارس والكليات والجامعات</span>
                <span class="d-block">Name of School / College / University</span>
            </td>
            @foreach ($job_application->educations as $education)
                <tr>
                    <td colspan="4" class="text-center">{{ $education->qualifications }} - {{ $education->date_of_completion }}</td>
                    <td colspan="2" class="text-center">{{ $education->name }}</td>
                </tr>
            @endforeach
            @for ($i = 2 - $job_application->educations()->count(); $i > 0; $i--)
                <tr>
                    <td colspan="4" class="text-center py-2"></td>
                    <td colspan="2" class="text-center py-2"></td>
                </tr>
            @endfor
        </tr>
    </table>
    
    <div class="section-title">Personal Information</div>
    <table class="info-table">
        <tr><td><strong>Full Name:</strong> </td><td><strong>Email:</strong> </td></tr>
        <tr><td><strong>Phone:</strong> </td><td><strong>Date of Birth:</strong> </td></tr>
        <tr><td><strong>Gender:</strong> </td><td><strong>Marital Status:</strong> </td></tr>
        <tr><td colspan="2"><strong>Address:</strong> </td></tr>
    </table>

    <div class="section-title">Education</div>
    <table>
        <thead>
            <tr>
                <th>Degree</th>
                <th>Institution</th>
                <th>Year</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="section-title">Languages</div>
    <table>
        <thead>
            <tr>
                <th>Language</th>
                <th>Proficiency</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

    <div class="section-title">Experience</div>
    <p></p>

    <div class="section-title">Additional Information</div>
    <p></p>

    <br><br>
    <p>Signature: __________________________</p>

</body>
</html>
