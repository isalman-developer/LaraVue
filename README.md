## Creating new appointment and also adding validation

* create a new route and a new component. to ne opened when we click on __Add New Appointment__

* make the nav item dynamic also (Appointments, Users, Setting, Profile etc)
    1. we will use a route functionality __$router.path.startsWith()__ i.e 
    `<router-link to="" :active="$router.path.startsWtih('/admin/appointments') ? 'active' : '' " />`

* now create a reactive constant for form and bind the form objectives

* also import form from vee-validate

* on submit create a function handleSubmit and through axios submit the form. also create the route for it.

* on successful insertion, redirect the page to appointments listing using useRouter

* import toastr and use its functionality on successful submission

