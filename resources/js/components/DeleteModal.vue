<template>
<div v-if="deleteToggle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete task ID {{deleteId}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" @click="closeDeleteModal">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the task "{{taskNameDelete}}" ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" @click="deleteTask">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeDeleteModal">Close</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['deleteId', 'deleteToggle', 'taskNameDelete'],
    data() {
        return {};
    },
    methods: {
        deleteTask() {
            let $vm = this;
            axios.delete('/api/todo', {
                    params: {
                        id: this.deleteId
                    }
                })
                .then(function (response) {
                    $vm.$emit('closeDeleteModal', {
                        toggleDeleteModal: false,
                    })
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        closeDeleteModal() {
            this.$emit('closeDeleteModal', {
                toggleDeleteModal: false
            })
        }
    },
};
</script>
