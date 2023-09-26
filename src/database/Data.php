<?php

namespace src\database;
class Data
{
    public static function getData(): array
    {
        return [
            [
                'code' => 'GH203',
                'name' => 'ثقافة إسلامية',
                'root' => '',
                'units' => 2,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => '152',
                'name' => 'مبادئ العلوم السياسية',
                'root' => '',
                'units' => 2,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'GH150',
                'name' => 'اللغة العربية',
                'root' => '',
                'units' => 2,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'GH141',
                'name' => 'اللغة الانجليزية 1',
                'root' => '',
                'units' => 2,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'GH142',
                'name' => 'لغة انجيليزية 2',
                'root' => 'GH141',
                'units' => 2,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'GS100',
                'name' => 'رياضة 1',
                'root' => '',
                'units' => 3,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'GS101',
                'name' => 'رياضة 2',
                'root' => 'GS100',
                'units' => 3,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'GS209',
                'name' => 'جبر خطي والمنطق',
                'root' => 'GS101',
                'units' => 3,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'GS242',
                'name' => 'إحصاء واحتمالات',
                'root' => 'GS100',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS205',
                'name' => 'تراكيب منفصلة',
                'root' => 'GS101',
                'units' => 3,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS200',
                'name' => 'مبادئ حاسب',
                'root' => '',
                'units' => 3,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'GS199',
                'name' => 'مبادئ هندسة كهربائية',
                'root' => '',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS201',
                'name' => 'اساسيات برمجة',
                'root' => '',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS207',
                'name' => 'لغة C',
                'root' => 'CS201',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS211',
                'name' => 'تحليل نظم',
                'root' => 'CS201',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS318',
                'name' => 'هندسة برمجيات',
                'root' => 'CS211',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS322',
                'name' => 'نظم تشغيل',
                'root' => 'CS318',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS313',
                'name' => 'إدارة قواعد بيانات',
                'root' => 'CS211',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS320',
                'name' => 'لغة دلفي',
                'root' => 'CS313',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS210',
                'name' => 'برمجئة مرئية1 (بيسك)',
                'root' => 'CS207',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS417',
                'name' => 'برمجئة مرئية2 (VB)',
                'root' => 'CS210',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS415',
                'name' => 'البرمجة الشيئية باستخدام c++',
                'root' => 'CS207',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS419',
                'name' => 'لغة جافا',
                'root' => 'CS415',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS423',
                'name' => 'تصميم مواقع انترنت',
                'root' => 'CS419',
                'units' => 3,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS414',
                'name' => 'النمذجة والمحاكاة',
                'root' => 'CS210',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS427',
                'name' => 'الرسم بالحاسوب',
                'root' => 'CS414',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS204',
                'name' => 'مقدمة أنظمة رقمية',
                'root' => 'GS199',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS303',
                'name' => 'تنظيم حاسبات',
                'root' => 'CS204',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS319',
                'name' => 'لغة تجميع ASSEMBLY',
                'root' => 'CS303',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS425',
                'name' => 'شبكات حاسوب',
                'root' => 'CS319',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS321',
                'name' => 'معماية الحاسوب',
                'root' => 'CS319',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS416',
                'name' => 'برمجة نطم',
                'root' => 'CS321',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS312',
                'name' => 'تراكيب بيانات 1',
                'root' => 'CS207',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS418',
                'name' => 'تراكيب بيانات 2',
                'root' => 'CS312',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS426',
                'name' => 'ذكاء اصطناعي',
                'root' => 'CS418',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS308',
                'name' => 'طرق عددية',
                'root' => 'CS207',
                'units' => 4,
                'status' => 0,
                'allowed' => 0
            ],
            [
                'code' => 'CS429',
                'name' => 'مواضيع مختارة 1',
                'root' => '115',
                'units' => 4,
                'status' => 0,
                'allowed' => 0,
                'requiredUnits' => 115
            ],
            [
                'code' => 'CS428',
                'name' => 'مواضيع مختارة 2',
                'root' => '115',
                'units' => 4,
                'status' => 0,
                'allowed' => 0,
                'requiredUnits' => 115
            ],
            [
                'code' => 'CS430',
                'name' => 'مناهج البحث والتدريب الميداني',
                'root' => '115',
                'units' => 2,
                'status' => 0,
                'allowed' => 0,
                'requiredUnits' => 115
            ],
            [
                'code' => 'CS999',
                'name' => 'مشروع التخرج',
                'root' => '115',
                'units' => 4,
                'status' => 0,
                'allowed' => 0,
                'requiredUnits' => 115
            ]
        ];
    }
}