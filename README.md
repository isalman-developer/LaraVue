## Deleting Bulk Users 
* when we click on checkbox in header then all of the following checkboxes will be auto checked
* we will create a new property called __`cont selectAll = ref(false);`__ 
* this property will be used to for checking all checkboxes, and filling __selectedUsers__ array with all of the id of the current page
* as well as the array that contains the selected users id will also be filled with the id of all users
* we will pass the __selectAll__ prop as boolean to child component(that is a single row which is iterating), if __selectAll__ is true then all of the checkboxes in the child component will be checked otherwise not
* when the delete functionality is perfomed we will also set the __selectAll__ to false
