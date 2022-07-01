<?php

use app\components\form\BasicForm;

use app\models\Test;
/** @var $model Test */
?>
<div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Test Edit</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <?php BasicForm::start('post', ["class" => "space-y-6"],'/test/'.$data->id); ?>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="username">
                    Email
                </label>
                <div class="mt-1">
                    <?php BasicForm::input($model, 'email', 'border border-red-500', ["class" => "appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"], 'email',$data->email); ?>
                </div>
                <p class="text-red-500 text-xs "><?php BasicForm::error($model, 'email'); ?></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="password">
                    First Name
                </label>
                <div class="mt-1">
                    <?php BasicForm::input($model, 'firstname', 'border border-red-500', ["class" => "appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"], 'text',$data->firstname); ?>
                </div>
                <p class="text-red-500 text-xs "><?php BasicForm::error($model, 'firstname'); ?></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="password">
                    Last Name
                </label>
                <div class="mt-1">
                    <?php BasicForm::input($model, 'lastname', 'border border-red-500', ["class" => "appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"], 'text',$data->lastname); ?>
                </div>
                <p class="text-red-500 text-xs "><?php BasicForm::error($model, 'lastname'); ?></p>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sign up</button>
            </div>
        </div>
