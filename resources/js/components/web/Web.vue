<template>
  <div>
    <md-tabs id="navigation" md-sync-route>
      <md-tab class="tab" id="tab-home" md-label="Home" to="/" exact></md-tab>
      <md-tab
        class="tab"
        id="tab-posts"
        md-label="Posts"
        to="/posts"
      ></md-tab>
      <md-tab class="tab" id="tab-about" md-label="About" to="/about"></md-tab>
      <md-tab class="tab" id="tab-contact" md-label="Contact" to="/contact"></md-tab>
    </md-tabs>
    <div class="md-layout md-alignment-center margin-botom">
      <div class="md-layout-item md-medium-size-100 md-small-size-100 md-xsmall-size-100">
        <Slide />
      </div>
    </div>

    <div class="main-container">
      <router-view></router-view>
    </div>
    <Footer />
  </div>
</template>
<script>
import Footer from "./Footer";
import Slide from "./home/Slide";

export default {
  name: "Web",
  data: () => ({
    newPosts: 0,
  }),
  components: {
    Footer,
    Slide
  }
};
</script>
<style lang="scss" scoped>
.md-tabs {
  border-top: 1px solid #fff0;
  .tab{
    color: #41b883 !important;
  }
}
.main-container {
  height: calc(100vh - 100%);
  min-height: calc(100vh - 125px);
  text-align: center;
}

</style>