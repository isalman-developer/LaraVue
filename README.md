## inserting data using bootstrap modal
1. Axios is a promise-based HTTP library that lets developers make requests to either their own or a third-party server to fetch data. It offers different ways of making requests such as GET , POST , PUT/PATCH , and DELETE .


## reactive
1. reactive() only takes objects, NOT JS primitives (String, Boolean, Number, BigInt, Symbol, null, undefined)

2. ref() is calling reactive() behind the scenes

3. Since reactive() works for objects and ref() calls reactive(), objects work for both BUT, ref() has a .value property for reassigning, reactive() does not have this and therefore __CANNOT be reassigned__

## Using reactive object to send data be inserted
1. Here we are using reactive as v-model to form inputs that we want to insert into users table. 

2. We can also use v-model with variables but it would make the axios request so messy like defining each variable along with its value to sent in request. 

3. So we create an object, put all values in it and just passed this object as request body.

4. clearing the object value that also set the inputs to be null and closing modal on success.

5. when the record is inserted we will return that record back in response and __unshift users.value__ which means we will add the new record to the top.

## installing jQuery through npm
1. `npm install jquery`

2. we will use it throughout the project by adding it in __bootstrap.js__

3. remove jquery import from the __app.js__
