<template>

    <Head title="Create User"/>
      <meta name="description" content="Users data">
    <AppLayout>
            <section class=" dark:bg-gray-900">
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Create New  User
                            </h1>
                            <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                                    <input type="text" v-model="form.name" id="name" name="name" placeholder="Your Name " class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <!-- display errors -->
                                    <small class="text-red-400 my-4" v-if="errors.name">{{ errors.name }}</small>
                                </div>
                                
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                    <input type="email" v-model="form.email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                                    <!-- display errors -->
                                    <small class="text-red-400 my-4 " v-if="errors.email">{{ errors.email }}</small>

                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password" v-model="form.password" id="password" name="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <!-- display errors -->
                                    <small class="text-red-400 my-4" v-if="errors.password">{{ errors.password }}</small>

                                </div>
                               
                                <button type="submit" :disabled="form.processing" class="w-full hover:border border-blue-100 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create User</button>
                            
                               
                                <div class=" hover:border w-full border-blue-100 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" >
                                    <Link :href="route('users.index')" >Cancel</Link>
                                </div>

                           
                            </form>
                        </div>
                    </div>
                </div>
            </section>
    </AppLayout>
 
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    errors:Object
})
const form = useForm({
    name: '',
    email: '',
    password: '',
 
    terms: false,
});

let submit = ()=>{
    form.post(route('users.store'))
}

</script>

<style>

</style>