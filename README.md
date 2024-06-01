## Deleting Bulk Users 
* add checkbox in each row of users list in UserListsItem
* add an emit for each checkbox so that the selected User is send to parent UserList component
* on clicking each checbkox 
    * an emit will be done to parent component where we will add a function to that event so the selected user will be added to an array. 
    * we will add selected __user id__ to array __`const selectedUsers = ref([])`__
    * a button will appear on which we will call api to delete those selected users (v-if="selectedUsers.length > 0
    ")

* while checking or unchecking checkobox we will also check if the user is already exist in __selectUsers__ array, we will remove it if it exists otherwise add it to array. (so there should be no duplicate user ids)

* on success from api 
    * we will show a toast 
    * set the selectedUsers array empty 
    * the button will disappear 
    * filter out the selectedUsers from users ref, so that users should disappear from list also
