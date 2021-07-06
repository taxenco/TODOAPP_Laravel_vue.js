<template>
<form @submit.prevent="saveData">
    <div class="input-group mb-3 mt-5 w-100">
        <input v-model="form.task" type="text" class="form-control form-control-lg" placeholder="Add a task" aria-label="todo List" aria-describedby="button-addon2" required />
        <div class="input-group-append">
            <button class="btn btn-success" type="submit" id="button-addon2">
                Add a a task
            </button>
        </div>
    </div>
    <span class="active text-danger mb-3" v-model="errorMessage">{{
                errorMessage
            }}</span>
</form>
</template>

<script>
export default {
    props: ['updateId', 'updateToggle', 'taskNameUpdate'],
    data() {
        return {
            errorMessage: "",
            form: {
                task: ""
            }
        };
    },
    methods: {
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
                    .then(function (response) {
                        vm.form.task = "";
                        vm.errorMessage = "";
                        vm.$emit('newRecord', {
                            recordAdded: true
                        })

                    })
                    .catch(function (error) {
                        vm.errorMessage = error.response.data.errors.task[0];
                    });
            }
        },
    },
};
</script>
