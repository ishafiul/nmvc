
<?php
use app\components\form\BasicForm;
?>
<div class="mt-1 flex rounded-md shadow-sm">
</div>
<?php
echo $dfsdf;
?>
<div class="w-full max-w-xs">
    <?php BasicForm::start('post',["class"=>"bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"]);?>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Username
            </label>
            <?php BasicForm::input($model,'submit','border border-red-500',["class"=>"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"]);?>
            <p class="text-red-500 text-xs "><?php BasicForm::error($model,'submit');?></p>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <?php BasicForm::input($model,'submit2','border border-red-500',["class"=>"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"],'password');?>

            <p class="text-red-500 text-xs "><?php BasicForm::error($model,'submit2');?></p>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Sign In
            </button>
        </div>
        <?php
        BasicForm::end();?>
</div>


