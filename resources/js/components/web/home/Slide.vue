<template>
  <div class="md-layout">
    <div class="md-layout-item md-size-20 md-xsmall-size-100">
      <img :src="config.imagePath + slides.slide" class="image-thumbnail">
    </div>
<!--     <div class="md-layout-item">
      <h3 class="md-body-2">
        {{slides.slogan}}
      </h3>
    </div> -->
  </div>
</template>
<script>
import Axios from 'axios';
import MenuIcon from 'vue-material-design-icons/Menu.vue';
import HomeIcon from 'vue-material-design-icons/Home.vue';
import CONFIG from '../../../config';
export default {
  name: "HomeSlide",
    data: () => ({
      slides: '',
      config: CONFIG
  }),
  methods:{
      getData(){
      Axios.get(this.config.baseUrl + 'company').then(res=>{
        this.slides = res.data[0];
      }).catch(err=>{
        console.log("Error: ", err);
      })
    },
  },
  created(){
    this.getData();
  },
  components: {
    MenuIcon,
    HomeIcon
  }
};
</script>
<style lang="scss" scoped>
.md-layout {
  display: flex;
  padding: 40px;
  background-image:url('../../../../../public/images/brand/slider.png');
  background-size: cover;
  background-repeat: no-repeat;
  box-shadow: inset 0 7px 9px -7px rgba(0, 0, 0, 0.4);
  color: #35495e;
  .md-body-2 {
    font-size: 16px;
  }
}
</style>
