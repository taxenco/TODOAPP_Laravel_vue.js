<template>
<div class="w-50">
    <updateModal-component :updateId="updateId" :updateToggle="updateToggle" :taskNameUpdate='taskNameUpdate' @closeUpdateModal='closeUpdateModal'></updateModal-component>
    <deleteModal-component :deleteId="deleteId" :deleteToggle="deleteToggle" :taskNameDelete='taskNameDelete' @closeDeleteModal='closeDeleteModal'></deleteModal-component>
    <form-component @newRecord='newRecord'></form-component>
    <table-component :deleteToggle="deleteToggle" :updateToggle="updateToggle" :newRecordAdded='newRecordAdded' @openDeleteModal="openDeleteModal" @openEditModal="openEditModal"></table-component>
</div>
</template>

<script>
export default {
    data() {
        return {
            deleteId: '',
            updateId: '',
            taskNameDelete: '',
            taskNameUpdate: '',
            deleteToggle: '',
            updateToggle: '',
            newRecordAdded:'',

        };
    },
    methods: {
        openEditModal(object) {
            this.updateToggle = object.toggleUpdateModal;
            this.updateId = object.id;
            this.taskNameUpdate = object.task;
        },
        openDeleteModal(object) {
            this.deleteToggle = object.toggleDeleteModal;
            this.deleteId = object.id;
            this.taskNameDelete = object.task;
        },
        closeUpdateModal(object) {
            this.updateToggle = object.toggleUpdateModal;
        },
        closeDeleteModal(object) {
            this.deleteToggle = object.closeDeleteModal;
        },
        newRecord(object) {
            this.newRecordAdded = object.recordAdded;
        },
    },
};
</script>
