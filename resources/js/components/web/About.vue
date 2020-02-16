<template>
  <div class="container">
    <md-card>
      <div class="md-layout">
        <div class="md-layout-item">
          <md-card-header>
            <md-card-header-text>
              <h3 class="md-title">About MonkeyClass.org</h3>
            </md-card-header-text>
          </md-card-header>
          <md-card-content>
            <md-content>
              {{company.details}}<br>
            </md-content>
          </md-card-content>
        </div>
        <div class="md-layout-item md-xsmall-size-100 md-small-size-25 md-large-size-25 md-xlarge-size-25">
            <md-card-content>
            <md-content class="md-layout">
                <img :src="config.imagePath + company.teams[0].image">
                <p>{{company.teams[0].details}}</p>
            </md-content>
          </md-card-content>
        </div>
      </div>
    </md-card>
  </div>
</template>
<script>
import Axios from 'axios';
import CONFIG from '../../config';
export default {
  name: "About",
  data: ()=>{
    return {
      title: 'About Monkey Class',
      company: '',
      config: CONFIG
    }
  },
  methods:{
    getData(){
      Axios.get(this.config.baseUrl + 'company').then(res=>{
        this.company = res.data[0];
        console.log(">>> ", this.company.teams[0])
      }).catch(err=>{
        console.log("Couldn't get data", err);
      })
    }
  },
  created(){
    document.title = this.title;
    this.getData();
  }
};
</script>
<style lang="scss" scoped>
  .md-card {
    text-align: left;
    color: #35495e !important;
    margin-top: -20px;
    padding: 20px;
    .md-content{
      color: #35495e !important;
    }
  }
</style>