<script setup>
import { ref } from 'vue';
import { formateDate } from '../../helper.js';
import useToastr from '../../toastr.js';
import { boolean } from 'yup';

const toastr = useToastr();
const emit = defineEmits(['editUser', 'toggleSelection', 'confirmUserDeletion']);
const props = defineProps({
    'user': Object,
    'index': Number,
    'selectAll': Boolean
});


// edit user emit code
const editUser = (user) => {
    emit('editUser', user);
}

// user roles code
const roles = ref([
    {
        name: 'USER',
        value: 2
    }, {
        name: 'ADMIN',
        value: 1
    }
]);

const changeRole = (user, role) => {
    axios.patch(`/api/users/${user.id}/change-role`, {
        role: role
    })
        .then(() => {
            toastr.success("Role changed successfully.");
        })
}

//user selection for bulk delete
const toggleSelection = () => {
    emit('toggleSelection', props.user);
}

</script>

<template>
    <tr>
        <td><input type="checkbox" :checked="selectAll" @change="toggleSelection"></td>
        <td>{{ index + 1 }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.formatted_created_at }}</td>
        <td>
            <select class="form-control" @change="changeRole(user, $event.target.value)">
                <option v-for="(role, index) in roles" :value="role.value" :selected="user.role === role.name">
                    {{ role.name }}
                </option>
            </select>
        </td>
        <td>
            <a @click="editUser(user)" href="#" class="fa fa-edit"></a>
            <a @click="$emit('confirmUserDeletion', user.id)" href="#" class="fa fa-trash text-danger ml-2"></a>
        </td>
    </tr>
</template>
