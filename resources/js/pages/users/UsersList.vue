<script setup>
import { onMounted, ref, watch } from 'vue';
import { Form, Field } from 'vee-validate';
import * as yup from 'yup';
import useToastr from '../../toastr.js';
import axios from 'axios';
import UserListItem from './UserListItem.vue';
import { debounce } from 'loadsh';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';


// constant declaration
const users = ref({ 'data': [] });
const editing = ref(false);
const form = ref();
const toastr = useToastr();
const selectedUsers = ref([]);
const formValues = ref({
    id: null,
    name: null,
    email: null
});


/* here we are getting 2 parameters values(input fields) & actions (resetForm, setFieldErrors). Actions are action that are associated with the vee-validate form. we have to pass actions to edit and create function for resetForm and setValidateErrors
*/
const handleSubmit = (values, actions) => {
    if (editing.value) {
        updateUser(values, actions);
    } else {
        createUser(values, actions);
    }
}

//Schemas
const createUserSchema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().required().min(8)
});

const editUserSchema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().when((password, schema) => {
        if (password[0] == undefined || password[0] == "") {
            return schema;
        } else {
            return schema.required().min(8);
        }
    }),
});

// insert user code
const addUser = () => {
    editing.value = false;
    form.value.resetForm();
    $("#userModal").modal('show');
}

const createUser = (values, { resetForm, setErrors, setFieldError }) => {
    axios.post('/api/users', values)
        .then((response) => {
            users.value.unshift(response.data);
            resetForm();
            $("#userModal").modal('hide');
            toastr.success("User added successfully.");
        }).catch((errors) => {
            if (errors.response?.data?.errors) {
                // to set sepecific error for specific Field
                // setFieldError('email', errors.response.data.errors.email);

                // to set all errors for all Field
                setErrors(errors.response.data.errors);
            } else {
                console.log(errors);
            }
        })
}

// edit user code
const editUser = (user) => {
    editing.value = true;
    $("#userModal").modal('show');
    formValues.value = {
        id: user.id,
        name: user.name,
        email: user.email
    };
}

const updateUser = (values, { setErrors }) => {
    axios.put('/api/users/' + formValues.value.id, values)
        .then((response) => {
            let index = users.value.findIndex(user => user.id === response.data.id);
            users.value[index] = response.data;
            $("#userModal").modal('hide');
            form.value.resetForm();
            toastr.success("User updated successfully.");
        }).catch((errors) => {
            if (errors.response.data.errors) {
                setErrors(errors.response.data.errors);
            }
        })
}

// deleting user code
const deleteUser = (userId) => {
    users.value = users.value.filter(user => user.id !== userId);
}

// getting users
const getUsers = (page = 1) => {
    axios.get(`/api/users?page=${page}`).then((response) => {
        users.value = response.data;
    });
};

// search functionality
const searchQuery = ref(null);
const search = () => {
    axios.get('/api/users/search', {
        params: {
            query: searchQuery.value
        }
    }).then((response) => {
        users.value = response.data;
    }).catch((error) => {
        console.log(error);
    });
}

watch(searchQuery, debounce(() => {
    search();
}, 300));


// deleting bulk users
const toggleSelection = (user) => {
    const index = selectedUsers.value.indexOf(user.id);
    if (index === -1) {
        selectedUsers.value.push(user.id)
    } else {
        selectedUsers.value.splice(index, 1)
    }
}

const bulkDelete = () => {
    axios.delete('/api/users/', {
        data: {
            ids: selectedUsers.value
        }
    }).then(response => {
        users.value.data = users.value.data.filter(user => !selectedUsers.value.includes(user.id));
        selectedUsers.value = [];
        toastr.success(response.data.success);
    })
}


onMounted(() => {
    getUsers();
});
</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">

            <div class="d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-primary mb-2" @click="addUser">
                        Add New User
                    </button>
                    <button v-if="selectedUsers.length > 0" type="button" class="btn btn-danger ml-2 mb-2"
                        @click="bulkDelete">
                        Deleted Selected
                    </button>
                </div>

                <div>
                    <input type="text" class="form-control" v-model="searchQuery">
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered Date</th>
                                <th>Role</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody v-if="users.data.length > 0">
                            <UserListItem v-for="(user, index) in users.data" :user="user" :index="index" :key="user.id"
                                @user-deleted="deleteUser" @edit-user="editUser" @toggle-selection="toggleSelection" />
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="6" class="text-center">
                                    No Users Found!!!
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <Bootstrap4Pagination :data="users" @pagination-change-page="getUsers" />
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span v-if="editing">Update User</span>
                        <span v-else>Add New User</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form ref="form" @submit="handleSubmit" :validation-schema="editing ? editUserSchema : createUserSchema"
                    v-slot="{ errors }">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <Field v-model="formValues.name" name="name" type="text" class="form-control " id="name"
                                aria-describedby="nameHelp" placeholder="Enter full name"
                                :class="{ 'is-invalid': errors.name }" />
                            <span class="invalid-feedback">{{ errors.name }}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <Field v-model="formValues.email" name="email" type="email" class="form-control " id="email"
                                aria-describedby="nameHelp" placeholder="Enter full name"
                                :class="{ 'is-invalid': errors.email }" />
                            <span class="invalid-feedback">{{ errors.email }}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Password</label>
                            <Field name="password" type="password" class="form-control " id="password"
                                aria-describedby="nameHelp" placeholder="Enter password"
                                :class="{ 'is-invalid': errors.password }" />
                            <span class="invalid-feedback">{{ errors.password }}</span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>


</template>
