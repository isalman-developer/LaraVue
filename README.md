##  Editing appointment in exisitng AppointmentForm(which is also used for creating an appointment)

01. Edit the edit button on appointments listing 
1. First we all add a flag in __onMounted__ to check route name if its for edit then we will mark the flag __true__. 
    and will replace "Create" word by "Edit"

2. Then we will call the function __getAppointment__ get the appointment of that id in url using `route.param.id`
3. We will receive the appointment and set its title and other field to the keys of the object __form__

4. We will create edit appointment route and function in AppointmentController
5. We will append `formatted_start_time` and `formatted_end_time` and which will be attributed defined __Appointment__ Model. 

6. Update handleSubmit function, check the flag `editMode` if it is true call __editAppointment__ function otherwise __createAppointment__ function
7. Create update function and route for it, define update function with validation similar to store
