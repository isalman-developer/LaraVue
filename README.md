## Inline table editing, Calling api on change of the input 
### *calling an api when an option is changed and then performing some changes in datbase*

* suppose we have a select input, where a list of roles are shows in options
* when we change the role, then an api will be called, which will change the role of that use in database


#### When the role in database and in loop are matched, then that option will be selected automatically.
` <option :selected="role.value === user.role"> Role Name </option> ` 
