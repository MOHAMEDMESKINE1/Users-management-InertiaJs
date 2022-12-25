<template>
    <!-- Head -->
    
    <Head title="Users"/>
    <meta name="description" content="Users data">
    
    <!-- Head -->
    <AppLayout>
        <div class="mb-4">
            <Link v-if="permissions.users_manage" :href="route('users.create')"  class=" ml-3 text-white py-2 px-2  rounded bg-blue-700" >Create New User</Link>
        </div>
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow-md">
           <!-- search -->
            <input type="text" v-model="search" id="search" name="search" placeholder="Your Name " class="bg-gray-50 border mb-4 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
           
            <table class="min-w-full border text-center rounded-md overflow-hidden ">
              <thead class="bg-white border-b ">
                <tr>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 ">
                    #
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 ">
                   Name
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 ">
                    Email
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 ">
                    Created_at
                  </th>
                
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 ">
                    Action
                  </th>
                
                </tr>
              </thead>
              <tbody>
                <tr class="bg-gray-100 border-b" v-for="(user,index) in users.data" :key="index">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" 
                  v-text="user.id"></td>
    
                  <td
                   class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center"
                   v-text="user.name"
                   >
                  </td>
                  <td
                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center"
                   v-text="user.email"
                   >
                  </td>
                  <td
                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center"
                   v-text="user.created_at"
                   >
                  </td>
                 
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex space-x-2 justify-center">
                      <button  v-if="permissions.users_manage" type="button" @click="destroy(user.id)" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Delete</button>
                      <Link v-if="permissions.users_manage" :href="route('users.edit',user.id)" class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Edit</Link>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <Pagination :links="users.links"  class="flex text-white justify-center"/>

    </AppLayout>
    </template>
    
<script setup>
import AppLayout from './App.vue';
import Pagination from '../Pagination.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from '@vue/reactivity';
import { watch } from '@vue/runtime-core';
import debounce from 'lodash/debounce';
let props = defineProps({
  users:Object,
  filters:Object,
  permissions:Object
})
const form = useForm();
// methods 
let search = ref(props.filters.search);

watch(search,debounce( function(value) {
    Inertia.get('users',{search:value},{
      preserveState:true,
      replace:true
    });

  },500));


let destroy = (id) => {
  if(confirm('Are You Sure !')){
    //  Inertia.delete(route('users.destroy',id))
    //  or
    form.delete(route('users.destroy',id))
  }
}


</script>

<style>

</style>