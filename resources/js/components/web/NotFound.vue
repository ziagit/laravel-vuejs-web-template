<template>
    <div class="container">
      <md-card class="md-layout">
        <md-empty-state
        class="md-layout-item"
        md-rounded
        md-icon="access_time"
        md-label="Data not available yet"
        md-description="Anything you search will go here until it's time to be provided.">
        </md-empty-state>
        </md-card>
    </div>
</template>

<script>
  export default {
    name: 'NotFound'
  }
</script>
<style scoped>
.md-card {
  color: #35495e !important;
  padding: 20px;
  margin-top: -20px;
}
</style>