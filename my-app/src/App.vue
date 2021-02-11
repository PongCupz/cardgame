<template>
  <div id="app">
    <div id="main-wrapper">
      <div class="page-wrapper">
        <router-view />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'App',
  mounted () {
  }
}
</script>

<style>
.topbar {
  font-weight: bold;
  color: #fff;
}
.navbar-brand {
  color: #fff !important;
}
.my-lg-0 {
  position: absolute;
  right: 10px;
}
.navbar-header {
  padding-left: 5px;
}
.ti-close {
  display: none !important;
}
.ti-menu {
  display: inline !important;
}
</style>
