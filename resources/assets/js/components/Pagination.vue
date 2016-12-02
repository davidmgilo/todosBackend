<template>
    <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#" @click.prevent="pageChanged(1)" aria-label="Previous">&laquo;</a></li>
        <li><a href="#" @click.prevent="pageChanged(page-1)">&lt;</a></li>
        <li v-for="n in paginationRange" >
            <a href="#" @click.prevent="pageChanged(n)">{{n}}</a>
        </li>
        <li><a href="#" @click.prevent="pageChanged(page+1)">&gt;</a></li>
        <li><a href="#" @click.prevent="pageChanged(lastPage)">&raquo;</a></li>
    </ul>
</template>
<style>

</style>
<script>
export default {
    data () {
        return {
            page : 1,
        }
    },
    props : {
        // Current Page
        currentPage: {
            type: Number,
            required: true
        },
        visiblePages: {
          type: Number,
          default: 5,
          coerce: (val) => parseInt(val)
        },
        totalPages: Number,
        // Items per page
        itemsPerPage: Number,
        // Total items
        totalItems: Number,
    },
    methods: {
        lowerBound (num, limit) {
            return num >= limit ? num : limit
        },
        pageChanged (pageNum) {
            this.page = pageNum;
            this.$emit('page-changed',pageNum)
        },
    },
    computed: {
         lastPage () {
              if (this.totalPages) {
                return this.totalPages
              } else {
                return this.totalItems % this.itemsPerPage === 0
                  ? this.totalItems / this.itemsPerPage
                  : Math.floor(this.totalItems / this.itemsPerPage) + 1
              }
         },
         paginationRange () {
            let start = this.currentPage - this.visiblePages / 2 <= 0
                    ? 1 : this.currentPage + this.visiblePages / 2 > this.lastPage
                    ? this.lowerBound(this.lastPage - this.visiblePages + 1, 1)
                    : Math.ceil(this.currentPage - this.visiblePages / 2)
            let range = []
            for (let i = 0; i < this.visiblePages && i < this.lastPage; i++) {
                range.push(start + i)
            }
            return range
        },
    },
    created (){
        this.page = this.currentPage
    }
}

</script>
