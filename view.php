<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>جامعة الرفاق</title>

    <!-- Tailwind Css -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-right">
<nav class="bg-green-700 text-white py-4 px-5 md:px-20 lg:px-40 text-lg font-semibold">
    محمد أبو غرارة - قسم علوم الحاسب
</nav>
<main class="px-5 md:px-20 lg:px-40 mt-5">
    <div class="alert bg-green-200 border border-green-500 text-green-700 p-3 rounded">
        قم بمعرفة المواد المسموح لك دراستها طبقا لشجرة المواد، بطريقة بسيطة وسريعة
    </div>
    <div class="grid grid-cols-12 gap-10 mt-5">
        <div class="col-span-4">
            <div class="flex flex-col rounded">
                <div class="p-2 bg-blue-500 text-white rounded rounded-b-none">
                    قداش
                </div>
                <div class="flex flex-col gap-7 p-5 shadow-md rounded rounded-t-none">
                    <div class="flex flex-col gap-2 border-b border-gray-300 pb-3">
                        <span class="text-sm">: عدد المواد الكلي</span>
                        <span id="subjectsTotalCount" class="text-4xl font-semibold">
                            <?php /*echo $subjectsContainer->getTotalSubjectsCount() */?>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 border-b border-gray-300 pb-3">
                        <span class="text-sm">: عدد المواد التي تم اجتيازها بنجاح</span>
                        <span id="subjectsCompletedCount" class="text-4xl font-semibold">
                            <?php /*echo $subjectsContainer->getCompletedSubjectsCount() */?>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 border-b border-gray-300 pb-3">
                        <span class="text-sm">: عدد المواد الباقي</span>
                        <span id="subjectsRemainingCount" class="text-4xl font-semibold">
                            <?php /*echo $subjectsContainer->getRemainingSubjectsCount() */?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-8">
            <div class="flex flex-col rounded">
                <div class="p-2 bg-blue-500 text-white rounded rounded-b-none">قم بالضغط على المواد التي اجتزتها بنجاح</div>
                <div class="p-5 shadow-md rounded rounded-t-none">
                    <div id="subjectContainer" class="flex flex-row-reverse justify-start flex-wrap gap-3 text-sm">
                        <?php /*foreach ($subjectsContainer->getSubjects() as $subject) : */?>
                        <button type="submit" class="subject flex-grow text-center border border-gray-400 rounded p-1.5
                                       disabled:bg-gray-200 disabled:text-black
                                       <?php /*echo $subject->status ? 'bg-green-600 text-white' : null */?>"
                                data-code="<?php /*echo $subject->code */?>"
                                data-status="<?php /*echo (int) $subject->status */?>"
                            <?php /*echo $subject->allowed ? null : 'disabled' */?>
                        >
                            <?php /*echo $subject->name */?>
                        </button>

                        <?php /*endforeach; */?>
                    </div>
                </div>
            </div>
            <div class="flex flex-row-reverse gap-2 mt-5">
                <div class="flex flex-grow flex-col rounded">
                    <div class="p-2 bg-blue-500 text-right text-white rounded rounded-b-none">عدد الوحدات الكلي</div>
                    <div class="p-5 shadow-md rounded rounded-t-none">
                        <span id="unitsTotalCount" class="font-semibold text-xl">
                            <?php /*echo $subjectsContainer->getTotalUnitsCount() */?>
                        </span>
                    </div>
                </div>
                <div class="flex flex-grow flex-col rounded">
                    <div class="p-2 bg-blue-500 text-right text-white rounded rounded-b-none">عدد الوحدات المنجزة</div>
                    <div class="p-5 shadow-md rounded rounded-t-none">
                        <span id="unitsCompletedCount" class="font-semibold text-xl">
                            <?php /*echo $subjectsContainer->getCompletedUnits() */?>
                        </span>
                    </div>
                </div>
                <div class="flex flex-grow flex-col rounded">
                    <div class="p-2 bg-blue-500 text-right text-white rounded rounded-b-none">عدد الوحدات الباقية</div>
                    <div class="p-5 shadow-md rounded rounded-t-none">
                        <span id="unitsRemainingCount" class="font-semibold text-xl">
                            <?php /*echo $subjectsContainer->getRemainingUnitsCount() */?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>

    document.querySelectorAll('.subject').forEach(function (item) {
        item.addEventListener('click', function (e) {
            //Change the data set
            const status = e.target.dataset['status'];

            if(status === '0') {
                e.target.dataset['status'] = '1'
            } else {
                e.target.dataset['status'] = '0'

            }

            //Get all dataset
            let buttonsDataset = [];

            document.querySelectorAll('.subject').forEach(function (item) {
                buttonsDataset.push(item.dataset)
            })

            buttonsDataset = buttonsDataset.filter(function (item) {
                return item.status == 1
            })

            buttonsDataset = buttonsDataset.map(function (item) {
                return {
                    'code': item.code,
                    'status': item.status
                }
            });

            buttonsDataset = buttonsDataset.reduce(function (result, item) {
                console.log(item)
                result[item.code] = item.status;
                return result;
            }, {});

            //Build url
            const baseUrl = 'http://localhost:63342/refaq-php/index.php';
            const params = new URLSearchParams(buttonsDataset);
            const url = `${baseUrl}?${params}`;


            //Redirect
            window.location.href = url;
        })
    })
</script>
</body>
</html>