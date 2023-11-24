<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UserList from "@/Layouts/ManageUsers/UserList.vue";
</script>

<template>
    <Head title="Manage Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Users</h2>
        </template>

        <div class="py-12">
            <div class="w-auto mx-auto sm:px-6 lg:px-8 p-2 justify-center flex">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <UserList class="text-gray-900"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
