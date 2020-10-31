<template>
  <div>

    <admin-nav :auth_admin="auth_admin"></admin-nav>

    <nav aria-label="パンくずリスト">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <inertia-link :href="$route('home')">
            ホーム
          </inertia-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">
          <inertia-link :href="$route('admin.article.list')">
            記事一覧
          </inertia-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          記事編集
        </li>
      </ol>
    </nav>

    <main class="py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">記事編集</div>

              <div class="card-body">
                <div class="alert alert-success" role="alert" v-if="status">
                  {{ status }}
                </div>

                <form :action="actionUrl" method="POST" @submit.prevent="$inertia.post(actionUrl, formInput)">
                  <!--                  @csrf-->

                  <div class="form-group">
                    <label>
                      タイトル
                    </label>
                    <input type="text" class="form-control" name="title" v-model="formInput.title">
                    <p class="text-danger" role="alert" v-if="errors.title">
                      <strong>{{ errors.title }}</strong>
                    </p>
                  </div>

                  <div class="form-group">
                    <div class=" form-check form-check-inline" v-for="category in categories">
                      <label>
                        <input type="radio" name="category_id" :value="category.id" class="form-check-input" v-model="formInput.category_id">
                        {{ category.title }}
                      </label>
                    </div>
                    <p class="text-danger" role="alert" v-if="errors.category_id">
                      <strong>{{ errors.category_id }}</strong>
                    </p>
                  </div>

                  <div class="form-group">
                    <label>
                      記事日付
                    </label>
                    <input type="text" class="form-control" name="date" v-model="formInput.date">
                    <p class="text-danger" role="alert" v-if="errors.date">
                      <strong>{{ errors.date }}</strong>
                    </p>
                  </div>

                  <div class="form-group">
                    <label>
                      本文
                    </label>
                    <textarea name="body" class="form-control" rows="10" v-model="formInput.body"></textarea>
                    <p class="text-danger" role="alert" v-if="errors.body">
                      <strong>{{ errors.body }}</strong>
                    </p>
                  </div>

                  <div class="form-group">
                    <div class=" form-check form-check-inline">
                      <label>
                        <input type="radio" name="is_publish" value="0" class="form-check-input" v-model="formInput.is_publish">
                        下書き
                      </label>
                    </div>
                    <div class=" form-check form-check-inline">
                      <label>
                        <input type="radio" name="is_publish" value="1" class="form-check-input" v-model="formInput.is_publish">
                        公開
                      </label>
                    </div>
                    <p class="text-danger" role="alert" v-if="errors.is_publish">
                      <strong>{{ errors.is_publish }}</strong>
                    </p>
                  </div>

                  <div class="form-group">
                    <button class="btn-primary form-control">
                      保存する
                    </button>
                  </div>

                </form>

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
  name: "Form",
  props: {
    status: String,
    errors: Object,
    values: Object,
    categories: Array,
    actionUrl: String,
    auth_admin: Object
  },
  data() {
    return {
      formInput: {}
    }
  },
  mounted() {
    if (this.values) {
      this.formInput = this.values;
    }
  }
}
</script>

<style scoped>

</style>