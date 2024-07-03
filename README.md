## Dynamic Dashboard KPIS

1. created 2 ref variable `const selectedAppointmentsCount = ref(0)` and `const selectedAppointmentSatatus = ref('all')`

2. add `@change` event to select (all, scheduled, confirmed, cancelled). to call __getAppointmentsCount__ to fetch count of appointments

3. add `getAppointmentsCount` for bringing back the count of appointments (all, scheduled, cancelled or confirmd appointments).

4. also call __getAppointmentsCount__ function on `onMounted` so when the component is loaded then the count of all of the components will be displaye.

