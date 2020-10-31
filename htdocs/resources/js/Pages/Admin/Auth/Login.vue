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
              <div class="card-header">Login</div>

              <div class="card-body">

<!--                <form method="POST" :action="$route('login.post')">-->
                <form method="POST" @submit.prevent="$inertia.post($route('login.post'), formInput)">

                  <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control" name="email" v-model="formInput.email" required autocomplete="email" autofocus>

                      <span class="text-danger" role="alert" v-if="errors.email">
                        <strong>{{ errors.email }}</strong>
                      </span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="formInput.password">

                      <span class="text-danger" role="alert" v-if="errors.password">
                        <strong>{{ errors.password }}</strong>
                      </span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" v-model="formInput.remember">

                        <label class="form-check-label" for="remember">
                          Remember Me
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                        Login
                      </button>

<!--                      @if (Route::has('password.request'))-->
<!--                      <a class="btn btn-link" href="{{ route('password.request') }}">-->
<!--                        {{ __('Forgot Your Password?') }}-->
<!--                      </a>-->
<!--                      @endif-->
                    </div>
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
  name: "Login",
  props: {
    status: String,
    errors: Object,
    auth_admin: Object
  },
  data(){
    return {
      formInput: {}
    }
  },
  mounted(){
  }
}
</script>

<style scoped>

</style>