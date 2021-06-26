<template>
    <div class="w-50">
        <deleteModal-component :deleteId="deleteId" :deleteToggle="deleteToggle" :taskName='taskName' @closeDeleteModal='closeDeleteModal'></deleteModal-component>
        <form @submit.prevent="saveData">
            <div class="input-group mb-3 w-100">
                <input
                    v-model="form.task"
                    type="text"
                    class="form-control form-control-lg"
                    placeholder="Add a task"
                    aria-label="todo List"
                    aria-describedby="button-addon2"
                    required
                />
                <div class="input-group-append">
                    <button
                        class="btn btn-success"
                        type="submit"
                        id="button-addon2"
                    >
                        Add a a task
                    </button>
                </div>
            </div>
            <span class="active text-danger" v-model="errorMessage">{{
                errorMessage
            }}</span>
        </form>
        <table-component @openDeleteModal="openDeleteModal"></table-component>
    </div>
</template>

<script>

export default {
    data() {
        return {
            errorMessage: "",
            deleteId:'',
            taskName:'',
            deleteToggle: '',
            form: {
                task: ""
            }
        };
    },
    methods: {
        openDeleteModal(object) {
           this.deleteToggle = object.toggleDeleteModal;
           this.deleteId = object.id;
           this.taskName = object.task;


        },
        closeDeleteModal(object){
            this.deleteToggle = object.closeDeleteModal;
        },
        saveData() {
            let vm = this;
            if (vm.form.task.length < 3) {
                vm.errorMessage = "The task must be at least 3 characters";
            } else if (vm.form.task.length > 25) {
                vm.errorMessage =
                    "The task must not be greater than 25 characters.";
            } else {
                axios
                    .post("/api/todo", {
                        task: vm.form.task
                    })
                    .then(function(response) {
                        vm.form.task = "";
                        vm.errorMessage = "";
                        // vm.getData();
                    })
                    .catch(function(error) {
                        vm.errorMessage = error.response.data.errors.task[0];
                    });
            }
        },
        // deleteData() {
        //     let vm = this;
        // },
        // openDeleteModal() {
        //     let vm = this;
        // }
    },
};
</script>
