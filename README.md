## Application Settings (Dynamic properties of app)
1. How to create some dynamic properties of an application (app_name, date_formate, pagination_limit etc).

2. We will create a table for it, to store it and also update them if needed. (Model, Migration).

3. Create a seeder for it, to store default values to these columns.

4. In __UpdateSetting.vue__ create a function `getSettings`to fetch settings values from databse. also call `getSettings` on `onMounted`;

5. Create a `const settings = ref([]);` to store the value of the response and also populate the form inputs. 

6. Create a __route__ and a controller __SettingController__ for this functionality.

7. Now we have to update settings so create a new function `updateSettings` with __put axios request__ & create an `api` for this function.

8. Add __toastr__ for update success function.

## Add validation for this in Controller and display them on vue also

1. validate the settings values, if there is any error store them in `const errors = ref()` and then display them conditionally under each field like i.e
    ```
      <span class="text-danger text-sm" v-if="errors && errros.app_name" >{{ errors.app_name[0] }}</span>
    ```
2. on calling `updateSettings` clear the errors so they they will be disappeared from errors.value and new value will be inserted.
