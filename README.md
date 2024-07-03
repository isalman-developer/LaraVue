##  Authentication using laravel fortify

1. Install fortify

2. add __foritfyserviceprovider__ class in __app__ and add __login view__ in fortifyserviceprovider
 
3. create auth.login view

4. in __Login.blade.php__ we created a div with id __#app__ so when app is created then it will be mounted to that div. and we have add router-view and enclosed Login component in it.

5. __router-view__ will work as a dynamic route locater, when login route is hit then it will load the login component which we will add globally in app.

6. add a route for login which will load the login component when it is hit.

7. in __Login.blade.php__ add __login.vue__ component. and you have to register this component globally in __app.js__ file so that it is available through out the app.

8. in Login.vue, add `const form = reactive({ email : '', password: '' })` & bind them to inputs. __@submit.prevent="handleSubmit"__ where you call axios post with '/login' api and on success redirect it to admin/dashboard.
