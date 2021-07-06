<template>
<div class="w-100">
    <table class="table mt-5">
        <tbody>
            <tr v-for="todo in todoList" :key="todo.id">
                <td class="text-white">{{todo.task}}</td>
                <td class="text-white">{{todo.created_at}}</td>
                <td><img :src="editIcon" @click="openEditModal(todo.id, todo.task)" /></td>
                <td><img :src="deleteIcon" @click="openDeleteModal(todo.id, todo.task)" /></td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    props: ['deleteToggle', 'updateToggle', 'newRecordAdded'],
    data() {
        return {
            todoList: [],
            editIcon: "/images/pencil.svg",
            deleteIcon: "/images/trash.svg",
            toggle: '',
        };
    },
    methods: {
        getData() {
            let vm = this;
            axios.get('/api/todo')
                .then(function (response) {
                    vm.todoList = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        openDeleteModal(recordId, task) {
            this.$emit('openDeleteModal', {
                id: recordId,
                toggleDeleteModal: true,
                task: task
            })
        },
        openEditModal(recordId, task) {
            this.$emit('openEditModal', {
                id: recordId,
                toggleUpdateModal: true,
                task: task
            })
        },
    },
    mounted() {
        this.getData();
    },
    watch: {
        deleteToggle(val) {
            this.getData();
        },
        updateToggle(val) {
            this.getData();
        },
        newRecordAdded(val) {
            this.getData();

        }
    }
};
</script>
