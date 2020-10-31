<template>
  <div>

    <pagination :data="paginate" @pagination-change-page="paginationChangePage">
      <span slot="prev-nav">&lt; Previous</span>
      <span slot="next-nav">Next &gt;</span>
    </pagination>

  </div>
</template>

<script>
import pagination from 'laravel-vue-pagination';

export default {
  name: "Links",
  components: {
    pagination: pagination
  },
  props: {
    paginate: Object
  },
  methods:{
    paginationChangePage(page){
      this.$inertia.visit(this.paginate.path + '?page=' + page);
    }
  }
}
</script>

<style scoped>

</style>