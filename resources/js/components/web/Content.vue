<template>
  <div>
    <div class="container">
      <md-card>
        <div class="md-layout">
          <div class="md-layout-item">
            <router-view :key="$route.fullPath"></router-view>
          </div>
          <div class="md-layout-item md-size-25 md-xsmall-size-100 md-small-size-100">
            <Sidebar />
          </div>
        </div>
      </md-card>
    </div>
  </div>
</template>
<script>
import Sidebar from "./sidebar/Sidebar";
export default {
  name: "Content",
  components: {
    Sidebar,
  }
};
</script>
<style scoped>
.md-card {
  padding: 20px;
  margin-top: -20px;
}
</style>