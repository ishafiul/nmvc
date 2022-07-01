<?php

use app\components\form\BasicForm;

use app\models\Test;

/** @var $model Test */
?>
<div class="flex justify-between items-center">
    <h2 class="my-6 text-center text-3xl font-extrabold text-gray-900">Test User List</h2>
    <div>
        <a href="/test/create" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create Test User</a>
    </div>
</div>
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            First Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Last Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    if (empty($data)) {
                        echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No Data!</td>';
                    }
                    foreach ($data as $user) {
                        ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="<?php echo 'test/'. $user->id?>"><?php echo $user->firstname ?></a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $user->lastname ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $user->email ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3 flex">
                                <a href="<?php echo 'test/edit/'. $user->id?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <?php
                                BasicForm::end(); ?>
                                <?php BasicForm::start('post', ["class" => ""], 'test/delete/' . $user->id); ?>
                                <button class="text-red-600 hover:text-indigo-900" type="submit">
                                    Delete
                                </button>
                                <?php
                                BasicForm::end(); ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <!-- More people... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



