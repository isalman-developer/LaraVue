<script setup>
import { ref } from 'vue';
import { formateDate } from '../../helper.js';
import useToastr from '../../toastr.js';

const userIdToBeDeleted = ref();
const toastr = useToastr();
const emit = defineEmits(['userDeleted', 'editUser'])
defineProps(['user', 'index']);

//delet user code
const confirmUserDeletion = (user) => {
    $("#deleteUserModal").modal('show');
    userIdToBeDeleted.value = user.id;
}

const deleteUser = () => {
    axios.delete(`/api/users/${userIdToBeDeleted.value}`)
        .then(() => {
            $("#deleteUserModal").modal('hide');
            emit('userDeleted', userIdToBeDeleted.value);
            toastr.error("User deleted!!!");
        })
}

// edit user emit code
const editUser = (user) => {
    emit('editUser', user);
}

// user roles code
const roles = ref([
    {
        name: 'ADMIN',
        value: 1
    }, {
        name: 'USER',
        value: 2
    }
]);

const changeRole = (user, role) => {
    axios.patch(`api/users/${user.id}/change-role`, {
        role: role
    }).then(() => toastr.success("User role changed successfully."));
}
</script>

<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ formateDate(user.created_at) }}</td>
        <td>
            <select class="form-control" :select="changeRole(user, $event.target.value)">
                <option v-for="role in roles" value="{{ role.value }}">
                    {{ role.name }}
                </option>
            </select>
        </td>
        <td>
            <a @click="editUser(user)" href="#" class="fa fa-edit"></a>
            <a @click="confirmUserDeletion(user)" href="#" class="fa fa-trash text-danger ml-2"></a>
        </td>
    </tr>

    <!-- Delete User Modal -->
    <div class="modal fade" id="deleteUserModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span>Delete User</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button @click.prevent="deleteUser" type="button" class="btn btn-primary">Delete User</button>
                </div>
            </div>
        </div>
    </div>
</template>
