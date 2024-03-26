## installing vue router by running
`npm install vue-router`

1. Created a global router in web.php, so if we enter any url by default the welcome.blade.php view will be loaded.
2. While defining a router we also pass the condition that this url can be of any character like string, numeric or special charcter just to load the landing page.
3. This view is landing page or we can say the home page. it will load if we enter any kind of url.

## ApplicationController
1. we used the ApplicationController to load the default landing page.
2. we also did the documentation for that to show that this function returns view.


## Using vue-router
1. We have to add router-view in welcome.blade.php to use vue-router functionality to load components. 

## router-view
It is acutally used to load the views without reloading the whole page. it is used to acheived single page application concept. <br>
Only first time the view will be reloaded and all of the required component. After that vue-router will help to load vue components rather than refreshing the whole page.

### to user router-view
1. checkout resources/js/app.js

2. after creating vue app and using routes you will get an error <br> `install @vitejs/plugin-vue `

### @vitejs/plugin-vue
1. It speeds up the front-end development experience of an application. Vite allows you to create Vue. js single-file components without having to bundle them. <br>

@vitejs/plugin-vue allows Vite to handle Vue.js components and related JavaScript files similarly to how Vite handles asset bundling in other frameworks like Laravel.

2. After installing you have to add some code configuration for vue into vite.config.js to allows us to use @vitejs/plugin-vue. <br>

3. How to add the above configuration, look at comments in vite.config.js file.

4. After step 3 you will get another error in console to change the way of importing __createApp__ from __vue__ to __vue/dist/vue.esm-bundler.js__
