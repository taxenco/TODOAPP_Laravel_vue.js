<template>
<div v-if="updateToggle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update task {{taskNameUpdate}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" @click="closeUpdateModal">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input v-model="taskName" type="text" class="form-control form-control-lg" placeholder="Update the task" aria-label="todo List" aria-describedby="button-addon2" required />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" @click="updateTask">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeUpdateModal">Close</button>
            </div>
        </div>
    </div>

</div>
</template>

<script>
export default {
    props: ['updateId', 'updateToggle', 'taskNameUpdate'],
    data() {
        return {
            taskName: '',
        };
    },
    methods: {
        updateTask() {

            let vm = this;
            axios.put('/api/todo', {
                    params: {
                        id: this.updateId,
                        newTask: this.taskName
                    }
                })
                .then(function (response) {
                    vm.$emit('closeUpdateModal', {
                        closeUpdateModal: false
                    })
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        closeUpdateModal() {
            this.$emit('closeUpdateModal', {
                closeUpdateModal: false
            })
        }
    },
};
</script>
