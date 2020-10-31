<template>
  <div>

    <admin-nav :auth_admin="auth_admin"></admin-nav>

    <nav aria-label="パンくずリスト">
      <!--          @yield('breadcrumb')-->
    </nav>

    <main class="py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">記事一覧</div>

              <div class="card-body">
                <div class="alert alert-success" role="alert" v-if="status">
                  {{ status }}
                </div>

                <inertia-link :href="$route('admin.article.create')" class="btn btn-primary mb-4">
                  + 新規作成
                </inertia-link>

                <links :paginate="paginate"></links>

                <table class="table">

                  <tr>
                    <th>タイトル</th>
                    <th>カテゴリ</th>
                    <th>記事日付</th>
                    <th>操作</th>
                  </tr>

                  <tr v-for="article in paginate.data">
                    <td>
                      {{ article.title }}
                    </td>
                    <td>
                      <!--
                                            {{ article.category.title }}
                                            -->
                    </td>
                    <td>
                      {{ article.date }}
                    </td>
                    <td>

                      <div class="btn-group">
                        <inertia-link :href="$route('admin.article.edit', {article: article.id})">
                          <button class="btn btn-primary mr-2">
                            編集
                          </button>
                        </inertia-link>

                        <form method="POST"
                              @submit.prevent="deleteSubmit($route('admin.article.destroy', {article: article.id}))">
                          <button class="btn btn-danger">
                            削除
                          </button>
                        </form>
                      </div>

                    </td>
                  </tr>
                </table>

                <links :paginate="paginate"></links>

              </div>
            </div>
          </div>
        </div>
      </div>
    </main>


  </div>
</template>

<script>

export default {
  name: "List",
  components: {

  },
  props: {
    status: String,
    errors: Object,
    paginate: Object,
    auth_admin: Object
  },
  mounted() {
  },
  methods: {
    deleteSubmit(url) {
      if (!confirm('本当に削除しますか？')) {
        return false;
      }
      this.$inertia.post(url);
    }
  }
}
</script>

<style scoped>

</style>