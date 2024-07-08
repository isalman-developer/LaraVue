## Profile Update
1. create `ProfileController` and api for getting profile data.

2. in `index` function `return reqeust()->user()->only(['name', 'email', 'role']);`

3. From api store the data in `const form = ref();` and populate the form using `v-model`;

4. add another api for update profile api and also the function for it.

5. add toastr on successfully updated and errors if there is any. 
