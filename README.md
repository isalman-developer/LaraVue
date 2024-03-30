## Now editing the exisitng record
1. Open the same modal with edit button and onClick at edit button call a function and pass the user as argument to that function

2. in editUser function show open modal and create a ref __formValues__ and set the user values to that __formValues__. it can be used later to fill inputs and also pass in update api call.

3. updating editUser validation schema, by default password input will have no validation but if user enters something then password field will be required and password length must be equal and greater than 8 characters


4. ## Template-refernce
    * It allows us to obtain a direct reference to a specific DOM element or child component instance after it's mounted
    * first declare a ref `const form = ref(null)`
    * inside Form tag add a reference(attribute) to the form `ref="form"`
    * in editUser function use code `form.value.resetForm()` to make the form inputs nullable(to reset form).

5. add a new schema for edit names as __editUserSchema__ where we will make the password by default nullable but when the user enter someting in password inputs then we will validate it.

6. __@submit="createUser" in Form__ should be replaced by __handleSubmit__, this new function will decide whether to call createUser or updateUser function.
