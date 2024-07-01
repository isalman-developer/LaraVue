export default [
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: () => import('../js/components/Dashboard.vue'),
    }, {
        path: '/admin/appointments',
        name: 'admin.appointments',
        component: () => import('./pages/appointments/ListAppointments.vue')
    }, {
        path: '/admin/appointments/create',
        name: 'admin.appointments.create',
        component: () => import('./pages/appointments/AppointmentForm.vue')
    }, {
        path: '/admin/appointments/:id/edit',
        name: 'admin.appointments.edit',
        component: () => import('./pages/appointments/AppointmentForm.vue')
    }, {
        path: '/admin/users',
        name: 'admin.users',
        component: () => import('./pages/users/UsersList.vue'),
    }, {
        path: '/admin/settings',
        name: 'admin.settings',
        component: () => import('./pages/settings/UpdateSetting.vue'),
    }, {
        path: '/admin/profile',
        name: 'admin.profile',
        component: () => import('./pages/profile/UpdateProfile.vue'),
    }
]
