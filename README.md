##  merge search function into index funtion

1. remove api for search and function defined in controller

2. remove `const search()` function

3. inside `watch` call `getUsers` function

4. merge 
    ```
    params: {
        query: searchQuery.value
    }
    ``` 
    into `getUsers` function

5. also made some changes inside `index` function in UserController
