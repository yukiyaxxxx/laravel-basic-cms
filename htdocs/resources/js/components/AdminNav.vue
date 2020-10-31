<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/">
        Laravel
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          <li class="nav-item" v-if="null == auth_admin">
            <inertia-link class="nav-link" :href="$route('login')">Login</inertia-link>
          </li>

          <li class="nav-item dropdown" v-if="null != auth_admin">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ auth_admin.name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <inertia-link class="dropdown-item" :href="$route('admin.article.list')">
                記事管理
              </inertia-link>
              <a class="dropdown-item" :href="$route('logout')">
                Logout
              </a>
<!--              <a class="dropdown-item" :href="$route('logout')"-->
<!--                 onclick="event.preventDefault();-->
<!--                                                     document.getElementById('logout-form').submit();">-->
<!--                Logout-->
<!--              </a>-->

<!--              <form id="logout-form" @submit.prevent="$inertia.visit($route('logout'))" method="GET" style="display: none;">-->
<!--              </form>-->
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "AdminNav",
  props: {
    auth_admin: Object
  }
}
</script>

<style scoped>

</style>