## Password change with validation

1. create a reactive variable 
    ```
        const changePasswordForm = reactive({
            'currentPassword' : '',
            'password' : '',
            'passwordConfirmation': ''
        });
    ```
    and vmodel these fields to inputs.

2. handle form submit event. at `@submit.prevent="handleChangePassword()"` and also define this function. and hit an api to change the password.

3. create the api and route it to __ProfileController__ where `changePassword` function has to be defined.

4. on success reset the value to  be empty and also show errors if there are any.

