## Extracting code into new components 
### *edit and delete user is performed by this functionality*
* it will be like code isolation, moving a code related to some functionlity into a new components
* like userListItem is a new component which has the code user edit & delete
* each user will be represetnt in a row
* each user will have its functionalities like edit & deleting
* so why not we move this code in a component and iterate that component.


## Props
1. it is used to send data from parent component to child component
2. when we isolate the code into components then we need to props to send data from one component to another.

## Emits
1. with the help of emits we can create custom events to send data from child component to parent component.
2. props are used to send data from parent to child and emits can be used to send data from child to parent components.
3. it can be used to affect some data in parent component if an action is performed in child component
4. i.e like in UserListItem when i delete the record, then the __const users = ref([])__ should also be updated and remove that record from list.
5. __@emit = kabab-case-emit-name-defined-in-child-component__ syntax is used inside the child component tag in the parent component(where we have defined it).
