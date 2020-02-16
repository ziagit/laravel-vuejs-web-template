<template>
  <div class="container">
    <md-card>
        <img :src="config.imagePath + project.image">
        <md-card-header>
          <h1 class="md-title">{{project.title}}</h1>
        </md-card-header>
        <md-card-content v-html="project.body"></md-card-content>
    </md-card>
  </div>
</template>
<script>
import Axios from 'axios';
import CONFIG from '../../../config';
export default {
  name: "Project",
  props: ['projectId'],
  data: ()=>{
    return {
      title: 'Monkey Class',
      config: CONFIG,
      project: []
    }
  },
  methods:{
    getProject(){              
      Axios.get(this.config.baseUrl + 'projects/'+ this.projectId).then(res=>{
        this.project = res.data;
        document.title = this.project.title;
      }).catch(err=>{
        console.log("Faild to load data", err)
      })
    }
  },

  created(){
    this.getProject();
  }
};
</script>
<style lang="scss" scoped>
/* on mobile browsers, I set a width of 100% */
@media (min-width: 300px) {
  .md-card-content{
    width: 260px;
  }
}
@media (min-width: 375px) {
  .md-card-content{
    width: 276px;
  }
}
@media (min-width: 530px) {
  .md-card-content{
    width: 440px;
  }
}
@media (min-width: 601px) {
  .md-card-content{
    width: 440px;
  }
}
@media (min-width: 768px) {
  .md-card-content{
    width: 619px;
  }
}
@media (min-width: 992px) {
  .md-card-content{
    width: 631px;
  }
}
@media (min-width: 1200px) {
  .md-card-content{
    width: 759px;
  }
}

.md-card {
  color: #35495e;
  text-align: left;
  box-shadow: none;
  .md-title {
    font-size: 22px;
    font-weight: 600;
  }
  .md-card-content {
    font-size: 16px;
  }
}
.language-php{
  width: 200px !important;
}

</style>