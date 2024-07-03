## Dynamic Dashboard KPIS

### FOR APPOINTMENTS

1. created 2 ref variable `const selectedAppointmentsCount = ref(0)` and `const selectedAppointmentSatatus = ref('all')`

2. add `@change` event to select (all, scheduled, confirmed, cancelled). to call __getAppointmentsCount__ to fetch count of appointments

3. add `getAppointmentsCount` for bringing back the count of appointments (all, scheduled, cancelled or confirmd appointments).

4. also call __getAppointmentsCount__ function on `onMounted` so when the component is loaded then the count of all of the components will be displaye.


### FOR USERS

1. first of all creat 2 ref variables `selectedDataRange` & `totalUsersCount` for storing selected date rand and count of users

2. add `@change` event to select of days so that on changing its value should pass to __getUsersCount__ which should call api to fetch users accordingly

3. also __getUsersCount__ in `onMounted` to fetch users for default value 

4. __getUsersCount__ function is defined to be called on change of days selection. This function is used to fetch the count of users according to `date_range` passed to its function.
