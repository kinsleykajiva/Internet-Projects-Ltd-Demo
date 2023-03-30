<template>
  <header class="header">
    <h2 class="title">Fruits Test Task</h2>
    <ul>
      <li>
        <nuxt-link to="/">Home</nuxt-link>
      </li>
      <li>
        <nuxt-link to="/listing">All fruits</nuxt-link>
      </li>
      <li>
        <nuxt-link to="/aboutfav"> All Favorite </nuxt-link>
      </li>
    </ul>
  </header>
</template>

<script>
export default {
  name: "AppHeader"
};
</script>

<style>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  padding-bottom: 1rem;
  border-bottom: 1px dotted #ccc;
}

.header .title {
  font-size: 3rem;
  color: #528859;
}

.header ul {
  display: flex;
}

.header a {
  display: inline-block;
  background: rgb(82, 136, 89);
  color: #fff;
  padding: 0.3rem 1rem;
  margin-right: 0.5rem;
}
</style>
