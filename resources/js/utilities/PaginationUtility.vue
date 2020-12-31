<template>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item" v-bind:class="{ 'disabled': pagination.current_page == 1 }">
                <a class="page-link" href="#" @click.prevent="$emit('changePage', pagination.current_page - 1)">
                    <span>Previous</span>
                </a>
            </li>
            <li
                v-for="page in pagesNumber"
                v-bind:class="{ 'active': page == isActive }"
                :key="page"
                class="page-item"
            >
                <a class="page-link" href="#" @click.prevent="$emit('changePage', page)">{{page}}</a>
            </li>
            <li
                class="page-item"
                v-bind:class="{ 'disabled': pagination.current_page == pagination.last_page }"
            >
                <a class="page-link" href="#" @click.prevent="$emit('changePage', pagination.current_page + 1)">
                    <span>Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['pagination', 'offset'],
    computed: {
        isActive: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) return [];
            var from = this.pagination.current_page - this.offset;
            if (from < 1) from = 1;
            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) to = this.pagination.last_page;
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }

            return pagesArray;
        }
    }
}
</script>