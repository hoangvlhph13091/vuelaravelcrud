<template>
  <div class="container">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/" class="nav-link">Posts</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{name: 'prodIndex'}" class="nav-link">Products</router-link>
        </li>
      </ul>
    </nav><br/>
      <router-view></router-view>
  </div>
</template>

<script>

export default {
  setup() {},
};
</script>
