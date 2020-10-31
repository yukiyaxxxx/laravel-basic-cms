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
              <div class="card-header">Dashboard</div>

              <div class="card-body">
                <div class="alert alert-success" role="alert" v-if="status">
                  {{ status }}
                </div>

                You are logged in!
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
  name: "Index",
  props: {
    status: String,
    errors: Object,
    auth_admin: Object
  },
  mounted(){
  }
}
</script>

<style scoped>

</style>