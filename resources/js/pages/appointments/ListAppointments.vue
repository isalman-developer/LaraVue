<script setup>
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';

const appointments = ref([]);
const selectedStatus = ref();
const appointmentStatuses = ref([]);


// getting appointments
const getAppointments = (status) => {
    const params = {};
    params.status = status ? status : null;
    selectedStatus.value = status;

    axios('/api/appointments', {
        params: params
    })
        .then(response => {
            appointments.value = response.data;
        });
}

//const getting appointments status
const getAppointmentStatus = () => {
    axios.get('/api/appointments/status')
        .then(response => {
            appointmentStatuses.value = response.data;
        })
}

// calculating total count of all appointments
const appointmentsCount = computed(() => {
    return appointmentStatuses.value.map(($status) => { return $status.count }).reduce((acc, value) => acc + value, 0);
});

onMounted(() => {
    getAppointmentStatus();
    getAppointments();
})
</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <a href="">
                                <button class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>
                                    Add New Appointment
                                </button>
                            </a>
                        </div>
                        <div class="btn-group">
                            <button @click="getAppointments()" type="button" class="btn"
                                :class="[typeof selectedStatus == 'undefined' ? 'btn-secondary' : 'btn-default']">
                                <span class="mr-1">All</span>
                                <span class="badge badge-pill badge-info">{{ appointmentsCount }}</span>
                            </button>

                            <button v-for="appointmentStatus in appointmentStatuses"
                                @click="getAppointments(appointmentStatus.value)" type="button" class="btn"
                                :class="[appointmentStatus.value === selectedStatus ? `btn-secondary` : `btn-default`]">
                                <span class="mr-1">{{ appointmentStatus.name }}</span>
                                <span class="badge badge-pill" :class="`badge-${appointmentStatus.color}`">{{
                                    appointmentStatus.count }}</span>
                            </button>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(appointment, index) in appointments.data" :key="appointment.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ appointment.client.first_name }} {{ appointment.client.last_name }}</td>
                                        <td> {{ appointment.start_time }}</td>
                                        <td> {{ appointment.end_time }}</td>
                                        <td>
                                            <span class="badge" :class="`badge-${appointment.status.color}`">
                                                {{ appointment.status.name }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
