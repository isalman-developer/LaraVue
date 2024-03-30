<script setup>
import { onMounted, ref } from 'vue';
import { Form, Field } from 'vee-validate';
import * as yup from 'yup';

// constant declaration
const users = ref([]);
const editing = ref(false);
const form = ref();
const formValues = ref({
    id: null,
    name: null,
    email: null
});

const handleSubmit = (values) => {
    if (editing.value) {
        updateUser(values);
    } else {
        createUser(values);
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
        console.log(password[0]);
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

const createUser = (values) => {
    axios.post('/api/users', values)
        .then((response) => {
            users.value.unshift(response.data);
            form.value.resetForm();
            $("#userModal").modal('hide');
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

const updateUser = (values) => {
    axios.put('/api/users/' + formValues.value.id, values)
        .then((response) => {
            let index = users.value.findIndex(user => user.id === response.data.id);
            users.value[index] = response.data;
            $("#userModal").modal('hide');

        }).catch((error) => {
            console.log(error);
        }).finally(() => {
            form.value.resetForm();
        })
}

// getting users
const getUsers = () => {
    axios.get("/api/users").then((response) => {
        users.value = response.data;
    });
};

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

            <button type="button" class="btn btn-primary mb-2" @click="addUser">
                Add New User
            </button>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered Date</th>
                                <th>Role</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in users" :key="user.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.created_at }}</td>
                                <td>{{ user.role }}</td>
                                <td>
                                    <a @click="editUser(user)" href="#" class="fa fa-edit"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
