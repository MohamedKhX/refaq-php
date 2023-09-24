<?php

use entities\SubjectEntity;
use entities\UserEntity;
use entities\UserSubjectsEntity;

if(! $_SESSION['user']) {
    App::redirectTo('auth');
}


if (isset($_POST['subjectCode']) && isset($_POST['subjectStatus'])) {
    $subjectCode = $_POST['subjectCode'];
    $subjectStatus = (bool) $_POST['subjectStatus'];

    $user = UserEntity::findByKey('name', $_SESSION['user']);

    $existingRecord = UserSubjectsEntity::findByKeys([
        'user_id' => $user->id,
        'subject_code' => $subjectCode
    ]);

    if ($existingRecord) {
         UserSubjectsEntity::delete($existingRecord->id);

         //Delete the nested Subjects

        $nestedSubjects = SubjectEntity::findByKey('code',$existingRecord->subject_code);
        $nestedSubjects = $nestedSubjects->getNestedSubjectFromDatabase();


        foreach ($nestedSubjects as $nestedSubject) {
            if ($nestedSubject->getStatusFromDatabase(false) === true) {
                $nestedRecord = UserSubjectsEntity::findByKeys([
                    'user_id' => $user->id,
                    'subject_code' => $nestedSubject->code
                ]);

                if ($nestedRecord) {
                    UserSubjectsEntity::delete($nestedRecord->id);
                }
            }
        }

    } else {
        UserSubjectsEntity::create([
            'id' => UserSubjectsEntity::getLastId() + 1,
            'user_id' => $user->id,
            'subject_code' => $subjectCode
        ]);
    }

}


$subjects = SubjectEntity::all();
$subjectsContainer = new \Logic\SubjectsLogic($subjects);
$subjectsContainer->enableFirstSubjects();
$subjectsContainer->getSubjectsStatusFromDatabase();

?>
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
<nav class="bg-green-700 flex justify-between text-white py-4 px-5 md:px-20 lg:px-40 text-lg font-semibold">
    <div>
        <span>مرحبا</span>
        <span><?php echo $_SESSION['user'] ?></span>
    </div>
    <span>
        قسم علوم الحاسب
    </span>
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
                            <?php echo $subjectsContainer->getTotalSubjectsCount() ?>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 border-b border-gray-300 pb-3">
                        <span class="text-sm">: عدد المواد التي تم اجتيازها بنجاح</span>
                        <span id="subjectsCompletedCount" class="text-4xl font-semibold">
                            <?php echo $subjectsContainer->getCompletedSubjectsCount() ?>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 border-b border-gray-300 pb-3">
                        <span class="text-sm">: عدد المواد الباقي</span>
                        <span id="subjectsRemainingCount" class="text-4xl font-semibold">
                            <?php echo $subjectsContainer->getRemainingSubjectsCount() ?>
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
                        <?php foreach ($subjectsContainer->getSubjects() as $subject) : ?>
                            <form class="flex-grow" method="post">
                                <input name="subjectCode" value="<?php echo $subject->code ?>" type="text" hidden>
                                <input name="subjectStatus" value="<?php echo (int) $subject->status ?>" type="text" hidden>

                                <button type="submit" class="subject w-full text-center border border-gray-400 rounded p-1.5
                                       disabled:bg-gray-200 disabled:text-black
                                       <?php echo $subject->status ? 'bg-green-600 text-white' : null ?>"
                                        data-code="<?php echo $subject->code ?>"
                                        data-status="<?php echo (int) $subject->status ?>"
                                    <?php echo $subject->allowed ? null : 'disabled' ?>
                                >
                                    <?php echo $subject->name ?>
                                </button>

                            </form>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="flex flex-row-reverse gap-2 mt-5">
                <div class="flex flex-grow flex-col rounded">
                    <div class="p-2 bg-blue-500 text-right text-white rounded rounded-b-none">عدد الوحدات الكلي</div>
                    <div class="p-5 shadow-md rounded rounded-t-none">
                        <span id="unitsTotalCount" class="font-semibold text-xl">
                            <?php echo $subjectsContainer->getTotalUnitsCount() ?>
                        </span>
                    </div>
                </div>
                <div class="flex flex-grow flex-col rounded">
                    <div class="p-2 bg-blue-500 text-right text-white rounded rounded-b-none">عدد الوحدات المنجزة</div>
                    <div class="p-5 shadow-md rounded rounded-t-none">
                        <span id="unitsCompletedCount" class="font-semibold text-xl">
                            <?php echo $subjectsContainer->getCompletedUnits() ?>
                        </span>
                    </div>
                </div>
                <div class="flex flex-grow flex-col rounded">
                    <div class="p-2 bg-blue-500 text-right text-white rounded rounded-b-none">عدد الوحدات الباقية</div>
                    <div class="p-5 shadow-md rounded rounded-t-none">
                        <span id="unitsRemainingCount" class="font-semibold text-xl">
                            <?php echo $subjectsContainer->getRemainingUnitsCount() ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>