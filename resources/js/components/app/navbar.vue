<template>
    <div>
  <b-navbar toggleable="lg" class="px-1 text-sm" type="dark" variant="success" >
    <b-navbar-brand href="/" class="text-sm">
        {{name}}
    </b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto" :small="true" :fill="true">
        <b-nav-item href="/cart" class="text-uppercase">
                <b-icon-cart4></b-icon-cart4>
                Cart
            </b-nav-item>
        <b-nav-item href="/login" v-if="!auth" class="text-uppercase">
            <b-icon-lock></b-icon-lock>
            Login
        </b-nav-item>
        <b-nav-item href="/register" v-if="!auth" class="text-uppercase">
            <b-icon-person></b-icon-person>
            Sign Up
        </b-nav-item>
        <b-nav-item href="#"  v-b-toggle.main-menu v-if="auth" class="text-uppercase">
            <b-icon-menu-app></b-icon-menu-app>
            Menu
        </b-nav-item>
        <b-nav-item-dropdown right v-if="auth">
          <!-- Using 'button-content' slot -->
          <template #button-content>
            <span>
                <b-icon-person></b-icon-person>
                User
            </span>
          </template>
          <b-dropdown-item href="#">Profile</b-dropdown-item>
          <b-dropdown-item href="/logout">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
  <b-sidebar id="main-menu" title="Menu" shadow right backdrop-variant="dark"
      backdrop>
      <template #default="{ hide }">
        <div class="p-3">
          <nav class="mb-3">
            <b-nav vertical>
              <b-nav-item active @click="hide">Active</b-nav-item>
              <b-nav-item href="#link-1" @click="hide">Link</b-nav-item>
              <b-nav-item href="#link-2" @click="hide">Another Link</b-nav-item>
            </b-nav>
          </nav>
          <!-- <b-button variant="close" block @click="hide">C</b-button> -->
        </div>
      </template>
    </b-sidebar>
</div>
</template>

<script>
export default {
    props: ['name', 'auth'],
}
</script>
