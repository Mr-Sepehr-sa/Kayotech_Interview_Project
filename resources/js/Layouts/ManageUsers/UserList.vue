<template>
    <table class="styled-table">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Verify-email</th>
                <th>created at</th>
                <th v-if="checkUserRole('Admin')">Operation</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item) in users" v-bind:class="item.status === 0 ? 'red': 'white'">
                <td>{{item.id}}</td>
                <td>{{item.name}}</td>
                <td>{{item.email}}</td>
                <td>{{item.status == 1 ? 'Active' : 'Inactive'}}</td>
                <td>{{item.email_verified_at != null ? 'Yes' : 'No'}}</td>
                <td>{{item.created_at}}</td>
                <td v-if="checkUserRole('Admin')">
                    <danger-button
                        class="w-full justify-center" v-if="item.status == 1" @click="changeStatus(item.id,0)">Deactivate</danger-button>
                    <primary-button
                        class="w-full justify-center" style="background-color: green" v-if="item.status == 0" @click="changeStatus(item.id,1)">Activate</primary-button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import axios from "axios";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";


export default {
    components: {
        PrimaryButton,
        SecondaryButton,
        DangerButton,
    },
    data(){
        return{
            users : [],
            id : '',
            status : '',
            hasRole : false,
        }
    },
    created(){
        axios.get(route('getUsersList'))
            .then(response => this.users = response.data);
    },
    methods:{
        changeStatus(id,status){
            let data = new FormData();
            data.append('id', id);
            data.append('status',status);

            axios.post(route('changeUserStatus'), data)
                .then((response) => {
                    console.info(response)
                    window.location.href = route('manageUsers')
                })
                .catch((error) => {
                    alert('WARNING : \nUSER DOES NOT HAVE THE RIGHT ROLES FOR THIS OPERATION.')
                });
        },

        checkUserRole(role){
            let data = new FormData();
            data.append('role', role);
            axios.post(route('userHasRole'),data)
                .then(response => this.hasRole = response.data);
            console.log(this.hasRole)
            return this.hasRole
        }
    }
}
</script>

<style scoped>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
.red{
    background-color: #ff968a;
}
.white{
    background-color: #f3f3f3;
}
</style>
