## Click on Tabs to show related data 
* Showing multiple tabs and showing related data in table
    1. All appointments
    2. Scheduled
    3. Confirmed
    4. Cancelled

* These tabs are get from an array that is returned by an api.
* __getStatusWithCount__ Function defined in AppointmentController to iterate over the cases of AppointmentStatus
* in this function we have returned a collection and each object of a collection contains 
    1. name
    2. value (1,2,3)
    3. count
    4. color

* Then dynamically we have assigned classes to the tabs to be shown as active

* showing the count of appointments on each of the associated tab

## 1)computed 2)filter and 3)reduce function is used to count total of the appointments to be shown on `All` tab



