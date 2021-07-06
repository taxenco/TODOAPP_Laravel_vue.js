<template>
<nav aria-label="Page navigation">
    <p class="text-white d-flex justify-content-center"> Page - {{currentPage}} -</p>
    <ul class="pagination justify-content-center">
        <li>
            <a class="page-link" @click="prevPage" tabindex="-1">Previous</a>
        </li>
        <li v-for="page in currentPageList">
            <a class="page-link" @click="current(page)" tabindex="-1">{{page}}</a>
        </li>
        <li class="page-item">
            <a class="page-link" @click="nextPage">Next</a>
        </li>
    </ul>
</nav>
</template>

<script>
export default {
    props: ['tasks'],
    data() {
        return {
            currentPage: '',
            currentPageList: [],
        };
    },
    methods: {
        prevPage() {
            if (this.currentPage > 1) {
                this.$emit('prevPage', {
                    page: this.currentPage - 1,
                })
            }
        },
        nextPage() {
            if (this.currentPage < this.lastPage) {
                this.$emit('nextPage', {
                    page: this.currentPage + 1,
                })
            }
        },
        current(page) {
            this.$emit('currPage', {
                page: page,
            })
        }
    },
    watch: {
        tasks() {
            this.currentPage = this.tasks.current_page;
            this.lastPage = this.tasks.last_page;
            this.currentPageList= [];
            for (let i = 1; i < this.lastPage+1; i++) {
                this.currentPageList.push(i);          
            }
        }
    },
};
</script>
