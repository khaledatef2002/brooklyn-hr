<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول :attribute.',
'accepted_if' => 'يجب قبول :attribute عندما يكون :other بقيمة :value.',
'active_url' => 'يجب أن يكون :attribute رابطًا صحيحًا.',
'after' => 'يجب أن يكون :attribute تاريخًا بعد :date.',
'after_or_equal' => 'يجب أن يكون :attribute تاريخًا بعد أو يساوي :date.',
'alpha' => 'يجب أن يحتوي :attribute على حروف فقط.',
'alpha_dash' => 'يجب أن يحتوي :attribute على حروف، أرقام، شرطات، وشرطات سفلية فقط.',
'alpha_num' => 'يجب أن يحتوي :attribute على حروف وأرقام فقط.',
'array' => 'يجب أن يكون :attribute مصفوفة.',
'ascii' => 'يجب أن يحتوي :attribute على رموز وأحرف أبجدية رقمية من البايت الواحد فقط.',
'before' => 'يجب أن يكون :attribute تاريخًا قبل :date.',
'before_or_equal' => 'يجب أن يكون :attribute تاريخًا قبل أو يساوي :date.',
'between' => [
    'array' => 'يجب أن يحتوي :attribute على عدد عناصر بين :min و :max.',
    'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
    'string' => 'يجب أن يحتوي :attribute على عدد حروف بين :min و :max.',
],
'boolean' => 'يجب أن تكون قيمة :attribute صحيحة أو خاطئة.',
'can' => 'يحتوي :attribute على قيمة غير مسموح بها.',
'confirmed' => 'تأكيد :attribute غير متطابق.',
'contains' => 'يجب أن يحتوي :attribute على قيمة مطلوبة.',
'current_password' => 'كلمة المرور غير صحيحة.',
'date' => 'يجب أن يكون :attribute تاريخًا صحيحًا.',
'date_equals' => 'يجب أن يكون :attribute تاريخًا مساويًا لـ :date.',
'date_format' => 'يجب أن يكون :attribute مطابقًا للتنسيق :format.',
'decimal' => 'يجب أن يحتوي :attribute على :decimal منازل عشرية.',
'declined' => 'يجب رفض :attribute.',
'declined_if' => 'يجب رفض :attribute عندما يكون :other بقيمة :value.',
'different' => 'يجب أن يكون :attribute و :other مختلفين.',
'digits' => 'يجب أن يحتوي :attribute على :digits أرقام.',
'digits_between' => 'يجب أن يحتوي :attribute على عدد أرقام بين :min و :max.',
'dimensions' => 'أبعاد الصورة :attribute غير صالحة.',
'distinct' => 'يحتوي :attribute على قيمة مكررة.',
'doesnt_end_with' => 'يجب ألا ينتهي :attribute بأحد القيم التالية: :values.',
'doesnt_start_with' => 'يجب ألا يبدأ :attribute بأحد القيم التالية: :values.',
'email' => 'يجب أن يكون :attribute بريدًا إلكترونيًا صحيحًا.',
'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
'enum' => ':attribute المحدد غير صالح.',
'exists' => ':attribute المحدد غير صالح.',
'extensions' => 'يجب أن يكون :attribute بأحد الامتدادات التالية: :values.',
'file' => 'يجب أن يكون :attribute ملفًا.',
'filled' => 'يجب أن يحتوي :attribute على قيمة.',
'gt' => [
    'array' => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
    'file' => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
    'string' => 'يجب أن يحتوي :attribute على أكثر من :value حرفًا.',
],
'gte' => [
    'array' => 'يجب أن يحتوي :attribute على :value عناصر أو أكثر.',
    'file' => 'يجب أن يكون حجم الملف :attribute أكبر من أو يساوي :value كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute أكبر من أو تساوي :value.',
    'string' => 'يجب أن يحتوي :attribute على :value حروف أو أكثر.',
],
'hex_color' => 'يجب أن يكون :attribute لونًا سداسي عشريًا صحيحًا.',
'image' => 'يجب أن يكون :attribute صورة.',
'in' => ':attribute المحدد غير صالح.',
'in_array' => 'يجب أن يكون :attribute موجودًا في :other.',
'integer' => 'يجب أن يكون :attribute عددًا صحيحًا.',
'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
'json' => 'يجب أن يكون :attribute نص JSON صالحًا.',
'list' => 'يجب أن يكون :attribute قائمة.',
'lowercase' => 'يجب أن يكون :attribute بحروف صغيرة.',
'lt' => [
    'array' => 'يجب أن يحتوي :attribute على أقل من :value عناصر.',
    'file' => 'يجب أن يكون حجم الملف :attribute أقل من :value كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute أقل من :value.',
    'string' => 'يجب أن يحتوي :attribute على أقل من :value حروف.',
],
'lte' => [
    'array' => 'يجب ألا يحتوي :attribute على أكثر من :value عناصر.',
    'file' => 'يجب أن يكون حجم الملف :attribute أقل من أو يساوي :value كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute أقل من أو تساوي :value.',
    'string' => 'يجب أن يحتوي :attribute على :value حروف كحد أقصى.',
],
'mac_address' => 'يجب أن يكون :attribute عنوان MAC صحيحًا.',
'max' => [
    'array' => 'يجب ألا يحتوي :attribute على أكثر من :max عناصر.',
    'file' => 'يجب ألا يتجاوز حجم الملف :attribute :max كيلوبايت.',
    'numeric' => 'يجب ألا تكون قيمة :attribute أكبر من :max.',
    'string' => 'يجب ألا يتجاوز :attribute :max حروف.',
],
'max_digits' => 'يجب ألا يحتوي :attribute على أكثر من :max أرقام.',
'mimes' => 'يجب أن يكون :attribute ملفًا من النوع: :values.',
'mimetypes' => 'يجب أن يكون :attribute ملفًا من النوع: :values.',
'min' => [
    'array' => 'يجب أن يحتوي :attribute على الأقل :min عناصر.',
    'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
    'string' => 'يجب أن يحتوي :attribute على الأقل :min حروف.',
],
'min_digits' => 'يجب أن يحتوي :attribute على الأقل :min أرقام.',
'missing' => 'يجب أن يكون :attribute مفقودًا.',
'not_in' => ':attribute المحدد غير صالح.',
'numeric' => 'يجب أن يكون :attribute رقمًا.',
'regex' => 'تنسيق :attribute غير صالح.',
'required' => 'حقل :attribute مطلوب.',
'size' => [
    'array' => 'يجب أن يحتوي :attribute على :size عناصر.',
    'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
    'numeric' => 'يجب أن تكون قيمة :attribute :size.',
    'string' => 'يجب أن يحتوي :attribute على :size حروف.',
],
'url' => 'يجب أن يكون :attribute رابطًا صحيحًا.',
'unique' => 'تم استخدام :attribute مسبقًا.',
'uploaded' => 'فشل تحميل :attribute.',  


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة مخصصة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'الاسم',
        'date_of_birth' => 'تاريخ الميلاد',
        'phone_number' => 'رقم الهاتف',
        'nationality' => 'الجنسية',
        'address' => 'العنوان',
        'military_service' => 'الخدمة العسكرية',
        'religion' => 'الديانة',
        'social_status' => 'الحالة الاجتماعية',
        'no_of_childs' => 'عدد الأطفال',
        'position' => 'المسمى الوظيفي',
        'expected_salary' => 'الراتب المتوقع',
        'do_you_have_health_certificate' => 'هل لديك شهادة صحية؟',
        'ready_to_start' => 'هل أنت مستعد للبدء؟',
        'any_crime' => 'هل لديك أي سجل جنائي؟',
        'work_in_any_place' => 'هل توفق على العمل في أي مكان؟',
        'any_health_problems' => 'هل لديك أي مشاكل صحية؟',
        'cv' => 'السيرة الذاتية',
        'english_spoken' => 'مستوى تحدث اللغة الانجليزي',
        'english_written' => 'مستوى كتابة اللغة الانجليزي',
        'english_reading' => 'مستوى قراءة اللغة الانجليزي',
        'english_comprehension' => 'مستوى فهم اللغة الانجليزي',
        'arabic_spoken' => 'مستوى تحدث اللغة العربية',
        'arabic_written' => 'مستوى كتابة اللغة العربية',
        'arabic_reading' => 'مستوى قراءة اللغة العربية',
        'arabic_comprehension' => 'مستوى فهم اللغة العربية',
        'education.*.name' => 'اسماء المدارس والكليات والجامعات',
        'education.*.qualifications' => 'المؤهلات العلمية',
        'education.*.date_of_completion' => 'تاريخ الحصول على المؤهل',
        'work_experience.*.company_name' => 'اسم الشركة',
        'work_experience.*.joining_date' => 'تاريخ الانضمام',
        'work_experience.*.monthly_salary' => 'الراتب الشهري',
        'work_experience.*.position' => 'المسمى الوظيفي',
        'work_experience.*.job_type' => 'نوع الوظيفة',
        'work_experience.*.reason_for_leaving' => 'سبب ترك العمل',
    ],

];