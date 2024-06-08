## Appointments list
* showing the list of appointments throug pagination
* creating enum for status 
    1. to show name of a status (1 Schedule 2 Confirmed 3 Cancelled)
    2. and also to show associated color for each of the status

### Through
* creating AppointmentController and also using __*through()*__ function with pagination. 
* __*through()*__ is used to iterate and manipulate over each of the item in data get from pagination.
* also using  __*through()*__ to change the value of each of the column of each of appointment like change start_time and end_time to a custom value and also changing status to a custom array of value

### Cast used in Appoint model

### iterating over appointments and also dynamically assigning the class to each of the status
