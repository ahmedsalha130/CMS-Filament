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

    'accepted' => 'يجب قبول الحقل :attribute.',
    'accepted_if' => 'يجب قبول الحقل :attribute عندما تكون :other بقيمة :value.',
    'active_url' => 'الحقل :attribute يجب أن يكون رابطاً صحيحاً.',
    'after' => 'الحقل :attribute يجب أن يكون تاريخاً بعد :date.',
    'after_or_equal' => 'الحقل :attribute يجب أن يكون تاريخاً مساوياً أو بعد :date.',
    'alpha' => 'الحقل :attribute يجب أن يحتوي على أحرف فقط.',
    'alpha_dash' => 'الحقل :attribute يجب أن يحتوي فقط على أحرف، أرقام، شرطات وشرطات سفلية.',
    'alpha_num' => 'الحقل :attribute يجب أن يحتوي فقط على أحرف وأرقام.',
    'any_of' => ':attribute غير صالح.',
    'array' => 'الحقل :attribute يجب أن يكون مصفوفة.',
    'ascii' => 'الحقل :attribute يجب أن يحتوي فقط على رموز وحروف أبجدية رقمية أحادية البايت.',
    'before' => 'الحقل :attribute يجب أن يكون تاريخاً قبل :date.',
    'before_or_equal' => 'الحقل :attribute يجب أن يكون تاريخاً مساوياً أو قبل :date.',
    'between' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على عناصر بين :min و :max.',
        'file' => 'الحقل :attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون بين :min و :max.',
        'string' => 'الحقل :attribute يجب أن يكون بين :min و :max حرفاً.',
    ],
    'boolean' => 'الحقل :attribute يجب أن يكون صحيحاً أو خطأ.',
    'can' => 'الحقل :attribute يحتوي على قيمة غير مصرح بها.',
    'confirmed' => 'تأكيد الحقل :attribute غير متطابق.',
    'contains' => 'الحقل :attribute يفتقد قيمة مطلوبة.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'الحقل :attribute يجب أن يكون تاريخاً صالحاً.',
    'date_equals' => 'الحقل :attribute يجب أن يكون تاريخاً مساوياً لـ :date.',
    'date_format' => 'الحقل :attribute يجب أن يطابق التنسيق :format.',
    'decimal' => 'الحقل :attribute يجب أن يحتوي على :decimal خانات عشرية.',
    'declined' => 'يجب رفض الحقل :attribute.',
    'declined_if' => 'يجب رفض الحقل :attribute عندما تكون :other بقيمة :value.',
    'different' => 'الحقل :attribute و :other يجب أن يكونا مختلفين.',
    'digits' => 'الحقل :attribute يجب أن يحتوي على :digits رقم.',
    'digits_between' => 'الحقل :attribute يجب أن يكون بين :min و :max رقم.',
    'dimensions' => 'الحقل :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'الحقل :attribute يحتوي على قيمة مكررة.',
    'doesnt_end_with' => 'الحقل :attribute يجب ألا ينتهي بأي من القيم التالية: :values.',
    'doesnt_start_with' => 'الحقل :attribute يجب ألا يبدأ بأي من القيم التالية: :values.',
    'email' => 'الحقل :attribute يجب أن يكون بريداً إلكترونياً صالحاً.',
    'ends_with' => 'الحقل :attribute يجب أن ينتهي بأحد القيم التالية: :values.',
    'enum' => 'القيمة المختارة لـ :attribute غير صالحة.',
    'exists' => 'القيمة المختارة لـ :attribute غير صالحة.',
    'extensions' => 'الحقل :attribute يجب أن يكون أحد الأنواع التالية: :values.',
    'file' => 'الحقل :attribute يجب أن يكون ملفاً.',
    'filled' => 'الحقل :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على أكثر من :value عنصر.',
        'file' => 'الحقل :attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون أكبر من :value.',
        'string' => 'الحقل :attribute يجب أن يكون أكبر من :value حرفاً.',
    ],
    'gte' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على :value عنصر أو أكثر.',
        'file' => 'الحقل :attribute يجب أن يكون أكبر من أو مساوياً لـ :value كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون أكبر من أو مساوياً لـ :value.',
        'string' => 'الحقل :attribute يجب أن يكون أكبر من أو مساوياً لـ :value حرفاً.',
    ],
    'hex_color' => 'الحقل :attribute يجب أن يكون لوناً بصيغة هكساديسيمال.',
    'image' => 'الحقل :attribute يجب أن يكون صورة.',
    'in' => 'القيمة المختارة لـ :attribute غير صالحة.',
    'in_array' => 'الحقل :attribute يجب أن يكون موجوداً في :other.',
    'integer' => 'الحقل :attribute يجب أن يكون عدداً صحيحاً.',
    'ip' => 'الحقل :attribute يجب أن يكون عنوان IP صالحاً.',
    'ipv4' => 'الحقل :attribute يجب أن يكون عنوان IPv4 صالحاً.',
    'ipv6' => 'الحقل :attribute يجب أن يكون عنوان IPv6 صالحاً.',
    'json' => 'الحقل :attribute يجب أن يكون سلسلة JSON صالحة.',
    'list' => 'الحقل :attribute يجب أن يكون قائمة.',
    'lowercase' => 'الحقل :attribute يجب أن يكون بحروف صغيرة.',
    'lt' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على أقل من :value عناصر.',
        'file' => 'الحقل :attribute يجب أن يكون أقل من :value كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون أقل من :value.',
        'string' => 'الحقل :attribute يجب أن يكون أقل من :value حرفاً.',
    ],
    'lte' => [
        'array' => 'الحقل :attribute يجب ألا يحتوي على أكثر من :value عناصر.',
        'file' => 'الحقل :attribute يجب أن يكون أقل من أو مساوياً لـ :value كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون أقل من أو مساوياً لـ :value.',
        'string' => 'الحقل :attribute يجب أن يكون أقل من أو مساوياً لـ :value حرفاً.',
    ],
    'mac_address' => 'الحقل :attribute يجب أن يكون عنوان MAC صالحاً.',
    'max' => [
        'array' => 'الحقل :attribute يجب ألا يحتوي على أكثر من :max عناصر.',
        'file' => 'الحقل :attribute يجب ألا يكون أكبر من :max كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب ألا يكون أكبر من :max.',
        'string' => 'الحقل :attribute يجب ألا يكون أكبر من :max حرفاً.',
    ],
    'max_digits' => 'الحقل :attribute يجب ألا يحتوي على أكثر من :max أرقام.',
    'mimes' => 'الحقل :attribute يجب أن يكون ملفاً من نوع: :values.',
    'mimetypes' => 'الحقل :attribute يجب أن يكون ملفاً من نوع: :values.',
    'min' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على :min عنصر على الأقل.',
        'file' => 'الحقل :attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون على الأقل :min.',
        'string' => 'الحقل :attribute يجب أن يكون على الأقل :min حرفاً.',
    ],
    'min_digits' => 'الحقل :attribute يجب أن يحتوي على :min أرقام على الأقل.',
    'missing' => 'الحقل :attribute يجب أن يكون مفقوداً.',
    'missing_if' => 'الحقل :attribute يجب أن يكون مفقوداً عندما تكون :other بقيمة :value.',
    'missing_unless' => 'الحقل :attribute يجب أن يكون مفقوداً ما لم تكن :other بقيمة :value.',
    'missing_with' => 'الحقل :attribute يجب أن يكون مفقوداً عند وجود :values.',
    'missing_with_all' => 'الحقل :attribute يجب أن يكون مفقوداً عند وجود :values.',
    'multiple_of' => 'الحقل :attribute يجب أن يكون مضاعفاً لـ :value.',
    'not_in' => 'القيمة المختارة لـ :attribute غير صالحة.',
    'not_regex' => 'تنسيق الحقل :attribute غير صالح.',
    'numeric' => 'الحقل :attribute يجب أن يكون رقماً.',
    'password' => [
        'letters' => 'الحقل :attribute يجب أن يحتوي على حرف واحد على الأقل.',
        'mixed' => 'الحقل :attribute يجب أن يحتوي على حرف كبير وصغير على الأقل.',
        'numbers' => 'الحقل :attribute يجب أن يحتوي على رقم واحد على الأقل.',
        'symbols' => 'الحقل :attribute يجب أن يحتوي على رمز واحد على الأقل.',
        'uncompromised' => 'القيمة :attribute تم الكشف عنها في تسريب بيانات. يرجى اختيار قيمة أخرى.',
    ],
    'present' => 'الحقل :attribute يجب أن يكون موجوداً.',
    'present_if' => 'الحقل :attribute يجب أن يكون موجوداً عندما تكون :other بقيمة :value.',
    'present_unless' => 'الحقل :attribute يجب أن يكون موجوداً ما لم تكن :other بقيمة :value.',
    'present_with' => 'الحقل :attribute يجب أن يكون موجوداً عند وجود :values.',
    'present_with_all' => 'الحقل :attribute يجب أن يكون موجوداً عند وجود :values.',
    'prohibited' => 'الحقل :attribute محظور.',
    'prohibited_if' => 'الحقل :attribute محظور عندما تكون :other بقيمة :value.',
    'prohibited_if_accepted' => 'الحقل :attribute محظور عندما يتم قبول :other.',
    'prohibited_if_declined' => 'الحقل :attribute محظور عندما يتم رفض :other.',
    'prohibited_unless' => 'الحقل :attribute محظور ما لم تكن :other من بين :values.',
    'prohibits' => 'الحقل :attribute يمنع :other من أن يكون موجوداً.',
    'regex' => 'تنسيق الحقل :attribute غير صالح.',
    'required' => 'الحقل :attribute مطلوب.',
    'required_array_keys' => 'الحقل :attribute يجب أن يحتوي على مدخلات لـ: :values.',
    'required_if' => 'الحقل :attribute مطلوب عندما تكون :other بقيمة :value.',
    'required_if_accepted' => 'الحقل :attribute مطلوب عندما يتم قبول :other.',
    'required_if_declined' => 'الحقل :attribute مطلوب عندما يتم رفض :other.',
    'required_unless' => 'الحقل :attribute مطلوب ما لم تكن :other من بين :values.',
    'required_with' => 'الحقل :attribute مطلوب عند وجود :values.',
    'required_with_all' => 'الحقل :attribute مطلوب عند وجود :values.',
    'required_without' => 'الحقل :attribute مطلوب عند غياب :values.',
    'required_without_all' => 'الحقل :attribute مطلوب عند غياب جميع :values.',
    'same' => 'الحقل :attribute و :other يجب أن يتطابقا.',
    'size' => [
        'array' => 'الحقل :attribute يجب أن يحتوي على :size عناصر.',
        'file' => 'الحقل :attribute يجب أن يكون :size كيلوبايت.',
        'numeric' => 'الحقل :attribute يجب أن يكون :size.',
        'string' => 'الحقل :attribute يجب أن يكون :size حرفاً.',
    ],
    'starts_with' => 'الحقل :attribute يجب أن يبدأ بأحد القيم التالية: :values.',
    'string' => 'الحقل :attribute يجب أن يكون نصاً.',
    'timezone' => 'الحقل :attribute يجب أن يكون توقيتاً صالحاً.',
    'unique' => 'القيمة :attribute موجودة مسبقاً.',
    'uploaded' => 'فشل في رفع الحقل :attribute.',
    'uppercase' => 'الحقل :attribute يجب أن يكون بحروف كبيرة.',
    'url' => 'الحقل :attribute يجب أن يكون رابطاً صالحاً.',
    'ulid' => ':attribute يجب أن يكون ULID صالحاً.',
    'uuid' => ':attribute يجب أن يكون UUID صالحاً.',

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
            'rule-name' => 'رسالة مخصصة.',
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

    'attributes' => [],

];
